<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MerchantController extends Controller
{
    public function index(){
        $response = Http::get('http://127.0.0.1:8086/services/paydrc/merchant');
        $result = $response->json();
        $response_2 = Http::get('http://127.0.0.1:8086/services/paydrc/institution');
        $result_2 = $response_2->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.marchand.index',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.marchand.index',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.marchand.index',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.marchand.index',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.marchand.index',compact('result','result_2'));
        }
    }

    public function store(Request $request){
        
        $data = [
            "institution_code"=>$request->institution_code,
            "account_number_vodacom"=>$request->vodacom_number,
            "account_number_orange"=>$request->orange_number,
            "account_number_airtel"=>$request->airtel_number,
            "vodacom_debit_comission"=>$request->vodacom_debit_comission,
            "vodacom_credit_comission"=>$request->vodacom_credit_comission,
            "orange_debit_comission"=>$request->orange_debit_comission,
            "orange_credit_comission"=>$request->orange_credit_comission,
            "airtel_debit_comission"=>$request->airtel_debit_comission,
            "airtel_credit_comission"=>$request->airtel_credit_comission,
        ];
        
        $sendData = Http::post('http://127.0.0.1:8086/services/create-merchant', $data);
        $response = json_decode($sendData->getBody(), true);

        if ($response["success"] == true) {
            $data = [
                "merchant_code"=>$response["institution"]["merchant_code"],
                "merchant_id"=>$response["institution"]["merchant_id"],
                "merchant_secrete"=>$response["institution"]["merchant_secrete"]
            ];
            return response()->json(['status'=>true,'message'=>$response["description"],'data'=>$response["institution"]["merchant_secrete"]]);
        }
        else {
            return response()->json(['status'=>false,'message'=>$response["description"]]);
        }
    } 
}
