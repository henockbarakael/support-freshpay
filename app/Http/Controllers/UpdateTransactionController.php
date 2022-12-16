<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateTransactionController extends Controller
{
    public function update(){
		$result = null;
        $todayDate = $this->todayDate();
		return view('transaction.update.index',compact('result','todayDate'));
	}
    
    public function updateSearch(Request $request){
        $reference = $request->option;
        $reference_value = $request->option_value;
        $date = date('Y-m-d', strtotime($request->datetime));

        $todayDate = $this->todayDate();
	
        if($reference == "paydrc_reference"){
            $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('paydrc_reference','LIKE','%'.$reference_value.'%')->first();
            if ($result != null) {
                if ($result->status == "Failed" || $result->status == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                return view('transaction.update.index',compact('result','todayDate'));
            }
            
        }
		elseif($reference == "switch_reference"){
            $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('switch_reference','LIKE','%'.$reference_value.'%')->first();
            if ($result != null) {
                if ($result->status == "Failed" || $result->status == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                return view('transaction.update.index',compact('result','todayDate'));
            }
        }
		elseif($reference == "telco_reference"){
            $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('telco_reference','LIKE','%'.$reference_value.'%')->first();
            if ($result != null) {
                if ($result->status == "Failed" || $result->status == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                return view('transaction.update.index',compact('result','todayDate'));
            }
        }
		elseif($reference == "customer_number"){
            $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('customer_details','LIKE','%'.$reference_value.'%')->first();
            if ($result != null) {
                if ($result->status == "Failed" || $result->status == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                return view('transaction.update.index',compact('result','todayDate'));
            }
        }

        elseif($reference == "id"){
            $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->where('id','LIKE','%'.$reference_value.'%')->first();
            if ($result != null) {
                if ($result->status == "Failed" || $result->status == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                return view('transaction.update.index',compact('result','todayDate'));
            }
        }

        else {
            $result = null;
            return view('transaction.update.index',compact('result','todayDate'));
        }
		
        
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
