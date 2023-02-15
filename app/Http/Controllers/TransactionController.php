<?php

namespace App\Http\Controllers;

use App\Imports\MerchantFileImport;
use App\Models\DrcSendMoneyTransac;
use App\Models\ImportedTransaction;
use App\Models\MerchantFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('Y-m-d H:i:s');
        return $todayDate;
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
                    return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
                }
                return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
            }
            else {
                return response()->json(['success'=>false,'message'=>$responseB["message"]]);
            }
            return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
        }
        else {
            return response()->json(['success'=>false,'message'=>$response["message"]]);
        }

    }
    public function SuccessfulIds(Request $request){
        $reference = explode(",",$request->ids);
        $sendRequest = new BulkUpadteController;
        $status = "Successful";
        $describ = "Transaction updated manually!";
        $response = $sendRequest->paydrc($reference,$status,$describ);
        if ($response["success"] == true) {
            return response()->json(['success'=>true,'message'=>"Transaction successfully updated."]);
        }
        else {
            return response()->json(['success'=>false,'message'=>"Failed to update from switch db."]);
        }

    }
}
