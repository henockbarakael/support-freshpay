<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use App\Models\MerchantFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantFileController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        MerchantFile::whereIn('paydrc_reference',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Transaction deleted successfully."]);
         
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
                    MerchantFile::whereIn('paydrc_reference', $reference)->delete();
                    return response()->json(['status'=>true,'message'=>"Transaction successfully updated."]);
                }
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
        
        $url ="http://206.189.25.253/services/paydrc/transaction/update";
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

        $curl_post_data = [
            "value" => $id,
            "status" => "Failed",
            "type" => "paydrc_reference",
        ];
        
        $url ="http://206.189.25.253/services/paydrc/transaction/update";
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

    public function updateResult(){
        $ref = Session::get('ref');
		$result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('paydrc_reference',$ref)->first();
        $todayDate = $this->todayDate();
		return view('transaction.update.index',compact('result','todayDate'));
	}
}
