<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\VerifyImport;
use App\Models\DrcSendMoneyTransac;
use App\Models\Transaction;
use App\Models\TransactionVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class ManagerAPIController extends Controller
{
    public function reference($length = 8){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = 'test';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function verify(){
        $rows = TransactionVerify::orderBy('id','desc')->get();
        return view('api.verify',compact('rows'));
    }

    public function store(Request $request){
        $response = $this->VerifySwitchReference($request->switch_reference);
        if ($response["success"] == true) {
            $data = TransactionVerify::where(function ($query) use ($request){                 
                if (!empty($request->switch_reference)) {
                    $query->Where('switch_reference', 'LIKE', '%' . $request->switch_reference . '%');
                }
            })->orderBy('id','desc')->get();

            return response()->json(['data'=>$data, 'success'=>true]);
        }
        else {
            $rows = null;
            return response()->json(['data'=>$rows, 'success'=>false]);
        }

    }
    public function VerifySwitchReference($reference){
        
        $row = Transaction::where('trans_ref_no',$reference)->first();
        $phone = new VerifyNumberController;
        $customer_number = $phone->verify_number($row['source_account_number']);
        $operator = $phone->operator($customer_number);

        if ($operator == "orange") {
            $data = [
                "PartnId"=> $row['partID'],
                "mermsisdn"=> $row['source_account_number'],
                "transid"=>$row['trans_ref_no']
            ];
            $url = "http://35.233.0.76:2801/api/v1/verify";
        }
        elseif ($operator == "airtel") {
            $data = [
                "transid"=>$row['trans_ref_no']
            ];
            $url = "http://35.205.213.194:2801/api/v1/verify";
        }
        else {
            $response = [
                'success' => false,
                'message' =>"Can't verify mpesa transaction",
            ];
            return $response;
        }

        $response = Http::post($url, $data);
        $result = json_decode($response->getBody(), true);

        if ($result["financial_institution_id"] == "null") {
            $response = [
                'success' => false,
                'reference' => $row["trans_ref_no"],
                'message'=>$result["financial_status_description"]
            ];
            return $response;
          
        }
        else {
            $paydrc = DrcSendMoneyTransac::where('switch_reference', $reference)->first();
            $status = $paydrc->status;
            $telco_reference = $paydrc->telco_reference;
            $paydrc_reference = $paydrc->paydrc_reference;
            $description = $paydrc->status_description;
            TransactionVerify::updateOrCreate([
                "financial_institution_id"=>$telco_reference,
                "financial_status_description"=>$description,
                "resultCode"=>$result["resultCode"],
                "status"=>$status,
                "new_status"=>$result["status"],
                "customer_number"=>$row["source_account_number"],
                "switch_reference"=>$row["trans_ref_no"],
                "paydrc_reference"=>$paydrc_reference,
                "trans_partid"=>$row["partID"],
                "user_id"=>Auth::user()->id
            ]);

            $response = [
                'success' => true,
                'reference' => $row["trans_ref_no"],
            ];
            return $response;
        }
        

    }

    public function index(){
        $rows = null;
        return view('api.transaction_verified');
    }

    public function uploadVerify(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        Excel::import(new VerifyImport, request()->file('file')->store('temp'));
    }

    public function VerifyIds(Request $request){

        $reference = explode(",",$request->ids);
        $response = $this->verifyTransaction($reference);
        if ($response["success"] == true) {
            return response()->json(['status'=>true,'message'=>"Transaction successfully verified."]);
        }
        else {
            return response()->json(['status'=>false,'message'=>"Can't verify mpesa transaction"]);
        }

    }

    public function verifyTransaction($reference) {

        $rows = TransactionVerify::whereIn('switch_reference',$reference)->get();
        $phone = new VerifyNumberController;
        

        foreach($rows as $idx => $row) {
            set_time_limit(0);
            ini_set('display_errors', '1');
            ini_set('max_execution_time', 600);

            $customer_number = $phone->verify_number($row['customer_number']);
            $operator = $phone->operator($customer_number);

            if ($operator == "orange") {
                $data = [
                    "PartnId"=> $row['trans_partid'],
                    "mermsisdn"=> $row['customer_number'],
                    "transid"=>$row['switch_reference']
                ];
                $url = "http://35.233.0.76:2801/api/v1/verify";
            }

            elseif ($operator == "airtel") {
                $data = [
                    "transid"=>$row['switch_reference']
                ];
                $url = "http://35.205.213.194:2801/api/v1/verify";
            }
            else {
                $response = [
                    'success' => false,
                ];
                return $response;
            }
            

            $response = Http::post($url, $data);
            $result = json_decode($response->getBody(), true);

            TransactionVerify::where('switch_reference',$row['switch_reference'])->update([
                "financial_institution_id"=>$result["financial_institution_id"],
                "financial_status_description"=>$result["financial_status_description"],
                "resultCode"=>$result["resultCode"],
                "new_status"=>$result["status"],
                "user_id"=>Auth::user()->id
            ]);

        }
        $response = [
                'success' => true,
            ];
            return $response;
 
    }
}
