<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayDrcTransactionController extends Controller
{
    public function charge(){
        $transactions = DrcSendMoneyTransac::whereDate('created_at', Carbon::today()->toDateString())->where(['action' => "debit"])->orderBy('created_at','desc')->get();
        $count = DrcSendMoneyTransac::whereDate('created_at', Carbon::today()->toDateString())->where(['action' => "debit"])->count();
        $todayDate = $this->todayDate();
        return view('transaction.paydrc.charge',compact('transactions','count','todayDate'));
    }
    public function payout(){
        $transactions = DrcSendMoneyTransac::whereDate('created_at', Carbon::today()->toDateString())->where(['action' => "credit"])->get();
        $count = DrcSendMoneyTransac::whereDate('created_at', Carbon::today()->toDateString())->where(['action' => "credit"])->count();
        $todayDate = $this->todayDate();
        return view('transaction.paydrc.payout',compact('transactions','count','todayDate'));
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
