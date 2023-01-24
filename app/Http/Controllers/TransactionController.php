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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function import(){
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
        $filePath = $request->file('file')->getRealPath();
        // Read the Excel file and get the list of IDs
        $ids = Excel::toArray(new MerchantFileImport, $filePath)[0];
        // Search for the records in the database
        $records = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->whereIn('id', $ids)->get();
    
        session::put('records',$records);
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

        $curl_post_data = [
            "status" => $request->status,
            "action" => $request->action,
            "switch_reference" => $request->switch_reference,
            "telco_reference" => $request->telco_reference,
            "paydrc_reference" => $request->paydrc_reference,
            "telco_status_description" => $request->telco_status_description
        ];

        $url ="http://143.198.138.97/services/callback";
        
        $data = json_encode($curl_post_data);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $curl_response = curl_exec($ch);
        if ($curl_response == false) {
            $message = "Erreur de connexion! Vérifiez votre connexion internet";
            return response()->json(['success'=>false,'message'=>$message]);
        }
        else {
            $result = json_decode($curl_response,true);
          
            if ($result["status"] == 200) {
                Alert::success('Done!', 'Callback successfully sent');
                return redirect()->back();
            }
            else {
                Alert::success('Failed!', 'Callback not sent to merchant!');
                return redirect()->back();
            }
        }
        
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        ImportedTransaction::whereIn('paydrc_reference',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Transaction deleted successfully."]);
         
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx'
        ]);

        Excel::import(new TransactionsImport, request()->file('file')->store('temp'));
    }

    // public function FailedIds(Request $request){
    //     $reference = explode(",",$request->ids);

    //     $curl_post_data = [
    //         "merchant_reference" => $reference,
    //         "status" => "Failed",
    //     ];

    //     $url ="http://143.198.138.97/services/update";
    //     $data = json_encode($curl_post_data);
    //     $ch=curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    //     $curl_response = curl_exec($ch);
    //     if ($curl_response == false) {
    //         $message = "Erreur de connexion! Vérifiez votre connexion internet";
    //         return response()->json(['success'=>false,'message'=>$message]);
    //     }
    //     else {
    //         $result = json_decode($curl_response,true);
          
    //         if ($result["success"] == true) {
    //             // var_dump($result["callback"]);
    //             ImportedTransaction::whereIn('paydrc_reference', $reference)->delete();
    //             return response()->json(['success'=>true,'message'=>$result["message"]]);
    //         }
    //         else {
    //             return response()->json(['success'=>false,'message'=>$result["message"]]);
    
    //         }
    //     }
        

    // }

    public function FailedIds(Request $request){
        $reference = explode(",",$request->ids);
        $sendRequest = new BulkUpadteController;
        $status = "Failed";
        $describ = "Transaction updated manually!";
        $response = $sendRequest->paydrc($reference,$status,$describ);
        
        if ($response["success"] == true) {
            $responseB = $sendRequest->switch($reference,$status);
            if ($responseB["success"] == true) {
                $responseC = $sendRequest->callback($reference, $status);
                if ($responseC["success"] == true) {
                    ImportedTransaction::whereIn('paydrc_reference', $reference)->delete();
                    
                }
                return response()->json(['status'=>true,'message'=>"Transaction successfully updated."]);
            }
            else {
                return response()->json(['status'=>false,'message'=>$responseB["message"]]);
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
        $curl_post_data = [
            "value" => $id,
            "status" => "Successful",
            "type" => "paydrc_reference",
        ];
        
        $url ="http://143.198.138.97/services/paydrc/transaction/update";
        $data = json_encode($curl_post_data);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        Session::put('ref',$id);

        $curl_response = curl_exec($ch);
        if ($curl_response == false) {
            $message = "Erreur de connexion! Vérifiez votre connexion internet";
            return response()->json(['success'=>false,'message'=>$message]);
        }
        else {
            $result = json_decode($curl_response,true);
            if ($result["success"] == true) {
                Alert::success('Great!', $result["message"]);
                return redirect()->route('admin.updateResult');
            }
            else {
                Alert::error('Nothing to do!', $result["message"]);
                return redirect()->route('admin.updateResult');
            }
        }
    }

    public function FailedSingle($id){

        // dd($id);
        $curl_post_data = [
            "value" => $id,
            "status" => "Failed",
            "type" => "paydrc_reference",
        ];
        
        $url ="http://127.0.0.1:8086/services/paydrc/transaction/update";
        $data = json_encode($curl_post_data);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        Session::put('ref',$id);

        $curl_response = curl_exec($ch);
        // dd($curl_response);
        if ($curl_response == false) {
            $message = "Erreur de connexion! Vérifiez votre connexion internet";
            return response()->json(['success'=>false,'message'=>$message]);
        }
        else {
            $result = json_decode($curl_response,true);
            if ($result["success"] == true) {
                // Alert::success('Great!', $result["message"]);
                return response()->json(['success'=>true,'message'=>$result["message"]]);
                return redirect()->route('admin.updateResult');
            }
            else {
                Alert::error('Nothing to do!', $result["message"]);
                return redirect()->route('admin.updateResult');
            }
        }


    }

    public function updateResult(){
        $ref = Session::get('ref');
		$result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('paydrc_reference',$ref)->first();
        $todayDate = $this->todayDate();
		return view('transaction.update.index',compact('result','todayDate'));
	}

}
