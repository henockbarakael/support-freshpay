<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\VerifyImport;
use App\Models\TransactionVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class VerifyAPIController extends Controller
{
    public function index(){
        $rows = TransactionVerify::orderBy('id','desc')->get();
        if (Auth::user()->is_user == 0) {
            return view('_admin.verify.transaction_verified',compact('rows'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.verify.transaction_verified',compact('rows'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.verify.transaction_verified',compact('rows'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.verify.transaction_verified',compact('rows'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.verify.transaction_verified',compact('rows'));
        }
        
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

    public function uploadVerify(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        Excel::import(new VerifyImport, request()->file('file')->store('temp'));
    }

    public function reference($length = 8){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = 'test';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
