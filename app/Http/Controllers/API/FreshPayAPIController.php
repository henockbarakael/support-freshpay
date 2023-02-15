<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransactionVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FreshPayAPIController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 120000);
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

    public function index(){
        $rows = null;
        if (Auth::user()->is_user == 0) {
            return view('_admin.verify.transaction_verified');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.verify.transaction_verified');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.verify.transaction_verified');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.verify.transaction_verified');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.verify.transaction_verified');
        }
        
    }

    public function VerifySwitchReference($reference){
        
        $ref_search = Http::post('http://143.198.138.97/services/swicth/search/switch_reference', ['reference' =>$reference]);
        $row = json_decode($ref_search->getBody(), true);
    
        if ($row == null) {
            $response = [
                'success' => false,
                'reference' => "Not found",
                'message'=> "Transation not found!"
            ];
            return $response;
        }
        else {
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

            $response = Http::post('http://143.198.138.97/services/verify', ['operator' =>$operator,'url' =>$url,'data' =>$data]);
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
                $ref_search_2 = Http::post('http://143.198.138.97/services/paydrc/search/switch_reference', ['reference' =>$reference]);
                $paydrc = json_decode($ref_search_2->getBody(), true);
            // dd($paydrc);
                $status = $result["status"];
                $telco_reference = $paydrc[0]["telco_reference"];
                $paydrc_reference = $paydrc[0]["paydrc_reference"];
                $description = $paydrc[0]["status_description"];
                TransactionVerify::updateOrCreate([
                    "financial_institution_id"=>$telco_reference,
                    "financial_status_description"=>$description,
                    "resultCode"=>"",
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
        
        
    }

}
