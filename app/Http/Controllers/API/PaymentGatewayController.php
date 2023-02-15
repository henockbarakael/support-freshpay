<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MobileMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 120000);
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

    public function index(){
        if (Auth::user()->is_user == 0) {
            return view('_admin.payment.test');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.payment.test');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.payment.test');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.payment.test');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.payment.test');
        }
        
    }
    public function process(Request $request){

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
}
