<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class PayDrcTransactionController extends Controller
{
    public function daterangePayDrc(Request $request){

       
        if(request()->ajax()) {
            $transactions = [];
            if(!empty($request->start_date)) {
                $dateStart = date('Y-m-d', strtotime($request->start_date));
                $dateEnd = date('Y-m-d', strtotime($request->end_date));
                
                $sendData = Http::post('http://127.0.0.1:8086/services/paydrc/daterange', ["dateStart"=>$dateStart,"dateEnd"=>$dateEnd,"action"=>$request->action]);
                $transactions = $sendData->json();
            } 
            return datatables()->of($transactions)->make(true);

        }
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.paydrc.charge');
        }
    }

    public function daterangeSwitch(Request $request){

       
        if(request()->ajax()) {
            $transactions = [];
            if(!empty($request->start_date)) {
                $dateStart = date('Y-m-d', strtotime($request->start_date));
                $dateEnd = date('Y-m-d', strtotime($request->end_date));
                
                $sendData = Http::post('http://127.0.0.1:8086/services/switch/daterange', ["dateStart"=>$dateStart,"dateEnd"=>$dateEnd,"action"=>$request->action]);
                $transactions = $sendData->json();
            } 
            return datatables()->of($transactions)->make(true);

        }
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.paydrc.charge');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.paydrc.charge');
        }
    }

    public function charge_old(){
        $total = Http::get('http://143.198.138.97/services/paydrc/count-all-debit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $charge = Http::get('http://143.198.138.97/services/paydrc/charge/daily_transactions');
        $transactions = $charge->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.paydrc.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.paydrc.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.paydrc.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.paydrc.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.paydrc.charge',compact('transactions','count','todayDate'));
        }
    }
    public function payout(){
        $payout = Http::get('http://143.198.138.97/services/paydrc/payout/daily_transactions');
        $transactions = $payout->json();
        $total = Http::get('http://143.198.138.97/services/paydrc/count-all-credit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.paydrc.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.paydrc.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.paydrc.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.paydrc.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.paydrc.payout',compact('transactions','count','todayDate'));
        }
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
