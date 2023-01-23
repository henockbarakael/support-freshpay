<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\VerifyImport;
use App\Models\DrcSendMoneyTransac;
use App\Models\ImportedTransaction;
use App\Models\MobileMoney;
use App\Models\Transaction;
use App\Models\TransactionVerify;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class FreshPayAPIController extends Controller
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
    public function PaymentRequest(){
        return view('api.test');
    }
    public function PostRequest(Request $request){

        $data = $request->validate([
            'customer_number' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'method' => 'required',
            'action' => 'required'
        ]);

        $phone = new VerifyNumberController;
        $customer_number = $phone->verify_number($data['customer_number']);
        $operator = $phone->operator($customer_number);


        if ($operator != $data['method']) {

            if ($operator == "mpesa") {
                $reseau = "M-pesa";
                $message = "Le numéro saisi n'est pas un numéro ".$reseau;
                Alert::error('Erreur!', $message);
                return back();
                
            }
            elseif ($operator == "airtel") {
                $reseau = "Airtel money";
                $message = "Le numéro saisi n'est pas un numéro ".$reseau;
                Alert::error('Erreur!', $message);
                return back();
                
            }
            elseif ($operator == "orange") {
                $reseau = "Orange money";
                $message = "Le numéro saisi n'est pas un numéro ".$reseau;
                Alert::error('Erreur!', $message);
                return back();
                
            }

        }

        else {
            $url = 'https://paydrc.gofreshbakery.net/api/v5/';

            $curl_post_data = [
                "merchant_id" => "jwHfjdopenc3yt\$Tb",
                "merchant_secrete"=> "jz5ulzR!a54kGg!iF",
                "action"=> $data['action'],
                "method" =>$data['method'],
                "amount" => $data['amount'],
                "currency" => $data['currency'],
                "customer_number" =>  $customer_number,
                "firstname" =>"SupportTest",
                "lastname" => "SupportTest",
                "email" => "support@gofreshbakery.com",
                "reference" => $this->reference(),
                "callback_url" => ""
            ];

            $data = json_encode($curl_post_data);
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            $curl_response = curl_exec($ch);

            if ($curl_response == false) {
                $message = "Erreur de connexion! Vérifiez votre connexion internet";
               
                Alert::error('Erreur', $message);
                return back();
            }
            else {
                $curl_decoded = json_decode($curl_response,true);

                $dataInsert = [
                    "amount" => $curl_decoded["Amount"],
                    "comment" => $curl_decoded["Comment"],
                    "created_at" => $curl_decoded["Created_At"],
                    "currency" => $curl_decoded["Currency"],
                    "customer_Number" => $curl_decoded["Customer_Number"],
                    "reference" => $curl_decoded["Reference"],
                    "status" => $curl_decoded["Status"],
                    "transaction_id" => $curl_decoded["Transaction_id"],
                    "updated_at" => $curl_decoded["Updated_At"],
                    // "action" => $data['action'],
                    // "method" => $data['method'],
                    "user_id" => Auth::user()->id,
                ];

                $storeData = MobileMoney::create($dataInsert);
                if ($storeData) {
                    Alert::success('Processed', $curl_decoded["Comment"]);
                    return back();
                }
            }
        }

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
                $status = $paydrc["status"];
                $telco_reference = $paydrc["telco_reference"];
                $paydrc_reference = $paydrc["paydrc_reference"];
                $description = $paydrc["status_description"];
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
    public static function PayDrcBulkUpdate($cases, $ids, $status) {
 
        $strCases = implode(' ', $cases);
        $strIds = implode(',', $ids);
 
        $sql = "UPDATE drc_send_money_transac SET `status` = ";
        $sql .= "CASE {$strCases} END, ";
        $sql .= "`updated_at` = NOW() ";
        $sql .= "WHERE `id` IN ({$strIds})";
 
        $data['sql'] = $sql;
        $data['params'] = $status;
 
        return $data;
    }


}
