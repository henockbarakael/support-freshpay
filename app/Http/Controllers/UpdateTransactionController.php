<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateTransactionController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 120000);
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
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
                if (Auth::user()->is_user == 0) {
                    return redirect()->route('admin.updateResult');
                }
                elseif (Auth::user()->is_user == 1) {
                    return redirect()->route('manager.updateResult');
                }
                elseif (Auth::user()->is_user == 2) {
                    return redirect()->route('finance.updateResult');
                }
                elseif (Auth::user()->is_user == 3) {
                    return redirect()->route('suppfin.updateResult');
                }
                elseif (Auth::user()->is_user == 4) {
                    return redirect()->route('support.updateResult');
                }
                
            }
            else {
                Alert::error('Nothing to do!', $result["message"]);
                if (Auth::user()->is_user == 0) {
                    return redirect()->route('admin.updateResult');
                }
                elseif (Auth::user()->is_user == 1) {
                    return redirect()->route('manager.updateResult');
                }
                elseif (Auth::user()->is_user == 2) {
                    return redirect()->route('finance.updateResult');
                }
                elseif (Auth::user()->is_user == 3) {
                    return redirect()->route('suppfin.updateResult');
                }
                elseif (Auth::user()->is_user == 4) {
                    return redirect()->route('support.updateResult');
                }
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
        // dd($curl_response);
        if ($curl_response == false) {
            $message = "Erreur de connexion! Vérifiez votre connexion internet";
            return response()->json(['success'=>false,'message'=>$message]);
        }
        else {
            $result = json_decode($curl_response,true);
            if ($result["success"] == true) {
                // Alert::success('Great!', $result["message"]);
                return response()->json(['success'=>true,'message'=>$result["message"]]);
                // return redirect()->route('admin.updateResult');
            }
            else {
                Alert::error('Nothing to do!', $result["message"]);
                if (Auth::user()->is_user == 0) {
                    return redirect()->route('admin.updateResult');
                }
                elseif (Auth::user()->is_user == 1) {
                    return redirect()->route('manager.updateResult');
                }
                elseif (Auth::user()->is_user == 2) {
                    return redirect()->route('finance.updateResult');
                }
                elseif (Auth::user()->is_user == 3) {
                    return redirect()->route('suppfin.updateResult');
                }
                elseif (Auth::user()->is_user == 4) {
                    return redirect()->route('support.updateResult');
                }
            }
        }
    }
    public function updateResult(){
        $ref = Session::get('ref');
		$result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('paydrc_reference',$ref)->first();
        $todayDate = $this->todayDate();
        if (Auth::user()->is_user == 0) {
            return view('_admin.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.update.index',compact('result','todayDate'));
        }
		
	}
}
