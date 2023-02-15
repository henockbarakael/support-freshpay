<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use App\Models\DrcSendMoneyMerchant;
use App\Models\DrcSendMoneyTransac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class SendCallBackToMerchant extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function index(){
        if (Auth::user()->is_user == 0) {
            return view('_admin.callback.index');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.callback.index');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.callback.index');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.callback.index');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.callback.index');
        }
    }

    public function process(Request $request){
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

        $url ="http://206.189.25.253/services/callback";
        
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
}
