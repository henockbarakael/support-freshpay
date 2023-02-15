<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SwitchTransactionController extends Controller
{
    public function charge(){
        $total = Http::get('http://206.189.25.253/services/switch/count-all-debit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $charge = Http::get('http://206.189.25.253/services/switch/charge/daily_transactions');
        $transactions = $charge->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.switch.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.switch.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.switch.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.switch.charge',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.switch.charge',compact('transactions','count','todayDate'));
        }
        
    }
    public function payout(){
        $total = Http::get('http://206.189.25.253/services/switch/count-all-credit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $payout = Http::get('http://206.189.25.253/services/switch/payout/daily_transactions');
        $transactions = $payout->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.transaction.switch.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.transaction.switch.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.transaction.switch.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.transaction.switch.payout',compact('transactions','count','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.transaction.switch.payout',compact('transactions','count','todayDate'));
        }
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
