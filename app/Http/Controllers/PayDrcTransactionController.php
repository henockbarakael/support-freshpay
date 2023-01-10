<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayDrcTransactionController extends Controller
{
    public function charge(){
        $total = Http::get('http://143.198.138.97/services/paydrc/count-all-debit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $charge = Http::get('http://143.198.138.97/services/paydrc/charge/daily_transactions');
        $transactions = $charge->json();
        return view('transaction.paydrc.charge',compact('transactions','count','todayDate'));
    }
    public function payout(){
        $payout = Http::get('http://143.198.138.97/services/paydrc/payout/daily_transactions');
        $transactions = $payout->json();
        $total = Http::get('http://143.198.138.97/services/paydrc/count-all-credit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        return view('transaction.paydrc.payout',compact('transactions','count','todayDate'));
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
