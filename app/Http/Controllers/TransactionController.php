<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\GetSwitchData;
use App\Http\Controllers\API\SendCallBackToMerchant;
use App\Imports\MerchantFileImport;
use App\Imports\TransactionsImport;
use App\Models\DrcSendMoneyTransac;
use App\Models\ImportedTransaction;
use App\Models\MerchantFile;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function import(){
        // $rows = ImportedTransaction::limit(5)->orderBy('id','asc')->get();
        $rows = ImportedTransaction::orderBy('id','asc')->get();
        $todayDate = $this->todayDate();
        return view('admin.file.import',compact('rows','todayDate'));
    }

    public function merchantFile(){
        $rows = MerchantFile::orderBy('id','asc')->get();
        $todayDate = $this->todayDate();
        return view('admin.file.merchant',compact('rows','todayDate'));
    }

    public function uploadMerchantFile(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx'
        ]);

        Excel::import(new MerchantFileImport, request()->file('file'));
    }

    public function callbackRequest(){
        return view('admin.callback.index');
    }

    public function sendCallback(Request $request){
        $request->validate([
            "action"=> 'required',
            "switch_reference" =>'required',
            "telco_reference" => 'required',
            "status" => 'required',
            "paydrc_reference" => 'required',
            "telco_status_description" => 'required'
        ]);
        $action = $request->action;
        $switch_reference =$request->switch_reference;
        $telco_reference = $request->telco_reference;
        $status = $request->status;
        $paydrc_reference = $request->paydrc_reference;
        $telco_status_description = $request->telco_status_description;

        $callbackRequest = new SendCallBackToMerchant;
        $callbackRequest->callback($action,$switch_reference,$telco_reference,$status,$paydrc_reference,$telco_status_description);
        // if ($done) {
        //     Alert::success('Done!', 'Callback successfully sent');
        //     return redirect()->back();
        // }
        // else {
        //     Alert::error('Error!', 'Callback failed to send');
        //     return redirect()->back();
        // }
        Alert::success('Done!', 'Callback successfully sent');
        return redirect()->back();
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx'
        ]);

        Excel::import(new TransactionsImport, request()->file('file')->store('temp'));
    }

    public function FailedIds(Request $request){
        $reference = explode(",",$request->ids);
        $sendRequest = new BulkUpadteController;
        $status = "Failed";
        $describ = "Transaction updated manually!";
        $response = $sendRequest->paydrc($reference,$status,$describ);
        if ($response["success"] == true) {
            $responseB = $sendRequest->switch($reference,$status);
            if ($responseB["success"] == true) {
                return response()->json(['status'=>true,'message'=>"Transaction successfully updated."]);
            }
            else {
                return response()->json(['status'=>false,'message'=>$response["message"]]);
            }
        }
        else {
            return response()->json(['status'=>false,'message'=>$response["message"]]);
        }

    }
    public function SuccessfulIds(Request $request){
        $reference = explode(",",$request->ids);
        $sendRequest = new BulkUpadteController;
        $status = "Successful";
        $describ = "Transaction updated manually!";
        $response = $sendRequest->paydrc($reference,$status,$describ);
        if ($response["success"] == true) {
            return response()->json(['status'=>true,'message'=>"Transaction successfully updated."]);
        }
        else {
            return response()->json(['status'=>false,'message'=>"Failed to update from switch db."]);
        }

    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('Y-m-d H:i:s');
        return $todayDate;
    }

    public function SuccessSingle($id){

        $paydrc = DrcSendMoneyTransac::select('status')->where('id',$id)->first();
        if ($paydrc->status == "Failed" || $paydrc->status == "Successful") {
            Alert::success('Nothing to do!', 'Transaction already up to date');
            return redirect()->back();
        }
        else {
            $switch = Transaction::where('merchant_ref',$paydrc->paydrc_reference)->first();
            $response = Http::post('http://167.71.131.224:4500/services/update', [
                'merchant_reference' => $paydrc->thirdparty_reference,
                'transaction_reference' => $paydrc->paydrc_reference,
                'paydrc' => True,
                'status' => True,
            ]);
            $result = json_decode($response->getBody(), true);

            if ($result["success"] == true) {
                return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
            }
            else {
                return redirect()->back();

            }

        }

    }

    public function FailedSingle($id){

        $paydrc = DrcSendMoneyTransac::select('status','paydrc_reference','thirdparty_reference','telco_reference')->where('id',$id)->first();
        // if ($paydrc->status == "Failed" || $paydrc->status == "Successful") {
        //     Alert::success('Nothing to do!', 'Transaction already up to date');
        //     return redirect()->back();
        // }
        // else {
            Session::put('ref',$paydrc->paydrc_reference);
            Transaction::where('merchant_ref',$paydrc->paydrc_reference)->first();
            $response = Http::post('http://167.71.131.224:4500/services/update', [
                'merchant_reference' => $paydrc->thirdparty_reference,
                'transaction_reference' => $paydrc->paydrc_reference,
                'paydrc' => True,
                'status' => False,
            ]);
            $result = json_decode($response->getBody(), true);

            if ($result["success"] == true) {
                return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
            }
            else {
                return redirect()->back();

            }

        // }

    }

    public function updateResult(){
        $ref = Session::get('ref');
		$result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('paydrc_reference',$ref)->first();
        $todayDate = $this->todayDate();
		return view('transaction.update.index',compact('result','todayDate'));
	}

    // public function SuccessSingle($id){

    //     $paydrc = DrcSendMoneyTransac::select('status')->where('id',$id)->first();
    //     if ($paydrc->status == "Failed" || $paydrc->status == "Successful") {
    //         Alert::success('Nothing to do!', 'Transaction already up to date');
    //         return redirect()->back();
    //     }
    //     else {
    //         $getSwitchData = new GetSwitchData;
    //         $response = $getSwitchData->getTransactionByPayDrcRef($paydrc->paydrc_reference);
    //         if ($response["success"] == true) {
    //             $trans_type = $response["result"]["trans_type"];
    //             if ($trans_type == "payout") {
    //                 $action = "credit";
    //             }
    //             elseif ($trans_type == "charge") {
    //                 $action = "debit";
    //             }
    //             $telco_status_description = $response["result"]["financial_institution_status_description"];
    //             $status = "Successful";
    //             $switch_reference = $response["result"]["trans_ref_no"];
    //             $paydrc_reference = $response["result"]["merchant_ref"];
    //             $telco_reference = $response["result"]["financial_institution_transaction_id"]; 
    //         }
    //         $data = [
    //             "status" => "Successful",
    //             "updated_at" => $this->todayDate(),
    //             "telco_reference" => $telco_reference,
    //             "status_description" => "Transaction updated manually!",
    //         ];
    //         $update = DrcSendMoneyTransac::where('id',$id)->update($data);
    //         if ($update) {
                
    //             $data2 = [
    //                 "status" => "Successful",
    //                 "updated_at" => $this->todayDate(),
    //             ];
    //             $update2 = Transaction::where('id',$id)->update($data2);
    //             if ($update2) {
    //                 $callbackRequest = new SendCallBackToMerchant;
    //                 $done = $callbackRequest->callback($action,$switch_reference,$telco_reference,$status,$paydrc_reference,$telco_status_description);
    //                 if ($done) {
    //                     // $transaction = ImportedTransaction::where('id',$id);
    //                     // $transaction->delete();
    //                     return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
    //                 }
    //                 else {
    //                     return response()->json(['success'=>true,'message'=>"Transaction successfully updated but failed to send callback"]);
    //                 }
    //             }
    //             else {
    //                 return response()->json(['success'=>true,'message'=>"Update failed from switch"]);
    //             }
                
    //         }
    //         else {
    //             return response()->json(['success'=>false,'message'=>"Update failed! Please retry again!"]);
    //         }
            
    //     }

    // }

    // public function FailedSingle($id){
        
    //     $paydrc = DrcSendMoneyTransac::select('status')->where('id',$id)->first();
    //     if ($paydrc->status == "Failed" || $paydrc->status == "Successful") {
    //         Alert::success('Nothing to do!', 'Transaction already up to date');
    //         return redirect()->back();
    //     }
    //     else {
    //         $getSwitchData = new GetSwitchData;
    //         $response = $getSwitchData->getTransactionByPayDrcRef($paydrc->paydrc_reference);
    //         if ($response["success"] == true) {
    //             $trans_type = $response["result"]["trans_type"];
    //             if ($trans_type == "payout") {
    //                 $action = "credit";
    //             }
    //             elseif ($trans_type == "charge") {
    //                 $action = "debit";
    //             }
    //             $telco_status_description = $response["result"]["financial_institution_status_description"];
    //             $status = "Successful";
    //             $switch_reference = $response["result"]["trans_ref_no"];
    //             $paydrc_reference = $response["result"]["merchant_ref"];
    //             $telco_reference = $response["result"]["financial_institution_transaction_id"]; 
    //         }
    //         $data = [
    //             "status" => "Failed",
    //             "updated_at" => $this->todayDate(),
    //             "telco_reference" => $telco_reference,
    //             "status_description" => "Transaction updated manually!",
    //         ];
    //         $update = DrcSendMoneyTransac::where('id',$id)->update($data);
    //         if ($update) {
                
    //             $data2 = [
    //                 "status" => "Failed",
    //                 "updated_at" => $this->todayDate(),
    //             ];
    //             $update2 = Transaction::where('id',$id)->update($data2);
    //             if ($update2) {
    //                 $callbackRequest = new SendCallBackToMerchant;
    //                 $done = $callbackRequest->callback($action,$switch_reference,$telco_reference,$status,$paydrc_reference,$telco_status_description);
    //                 if ($done) {
    //                     // $transaction = ImportedTransaction::where('id',$id);
    //                     // $transaction->delete();
    //                     return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
    //                 }
    //                 else {
    //                     return response()->json(['success'=>true,'message'=>"Transaction successfully updated but failed to send callback"]);
    //                 }
    //             }
    //             else {
    //                 return response()->json(['success'=>true,'message'=>"Update failed from switch"]);
    //             }
                
    //         }
    //         else {
    //             return response()->json(['success'=>false,'message'=>"Update failed! Please retry again!"]);
    //         }
            
    //     }
    // }
}
