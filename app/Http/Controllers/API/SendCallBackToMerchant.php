<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use App\Models\DrcSendMoneyMerchant;
use App\Models\DrcSendMoneyTransac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendCallBackToMerchant extends Controller
{
    public function callback($action,$switch_reference,$telco_reference,$status,$paydrc_reference,$telco_status_description){

        // $params = [
        //     "action"=> $action,
        //     "switch_reference" =>$switch_reference,
        //     "telco_reference" => $telco_reference,
        //     "status" => $status,
        //     "paydrc_reference" => $paydrc_reference,
        //     "telco_status_description" => $telco_status_description
        // ];
        // $data = json_encode($params);
  
        // $response = Http::post('http://161.35.78.118:2808/api/v5/callback', $data
        // );

        // $result = json_decode($response->getBody(), true);
        // dd($result);

        $url = "http://161.35.78.118:2808/api/v5/callback";

        $curl_post_data = [
            "action"=> $action,
            "switch_reference" =>$switch_reference,
            "telco_reference" => $telco_reference,
            "status" => $status,
            "paydrc_reference" => $paydrc_reference,
            "telco_status_description" => $telco_status_description
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
        curl_exec($ch);
        // $curl_response = curl_exec($ch);

        // $curl_decoded = json_decode($curl_response,true);

        // dd($curl_decoded);
        

    }

    public function merchant_callback_url(){
        $result = DrcSendMoneyTransac::select('merchant_code','callback_url','action')->distinct()->get();
        foreach ($result as $key => $value) {
            $merchant_code = $value["merchant_code"];
            $callback_url = $value["callback_url"];
            Callback::updateOrCreate(['merchant_code' => $merchant_code],
            ['callback_url' => $callback_url]);
        }
        return 'done!';
       
    }


    public function merchant_code(){
        $result = DrcSendMoneyMerchant::select('merchant_code')->get();
        return $result;
    }


}
