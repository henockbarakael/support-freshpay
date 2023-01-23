<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SwitchTransactionController extends Controller
{
    public function charge(){
        $total = Http::get('http://143.198.138.97/services/switch/count-all-debit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $charge = Http::get('http://143.198.138.97/services/switch/charge/daily_transactions');
        $transactions = $charge->json();
        return view('transaction.switch.charge',compact('transactions','count','todayDate'));
    }
    public function payout(){
        $total = Http::get('http://143.198.138.97/services/switch/count-all-credit/transactions');
        $result = $total->json();
        $count = $result[0]["total"];
        $todayDate = $this->todayDate();
        $charge = Http::get('http://143.198.138.97/services/switch/payout/daily_transactions');
        $transactions = $charge->json();
        return view('transaction.switch.payout',compact('transactions','count','todayDate'));
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
