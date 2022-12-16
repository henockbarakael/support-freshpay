<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SwitchTransactionController extends Controller
{
    public function charge(){
        $transactions = Transaction::whereDate('created_at', Carbon::today()->toDateString())->where(['trans_type' => "charge"])->orderBy('created_at','desc')->get();
        $count = Transaction::whereDate('created_at', Carbon::today()->toDateString())->where(['trans_type' => "charge"])->count();
        $todayDate = $this->todayDate();
        return view('transaction.switch.charge',compact('transactions','count','todayDate'));
    }
    public function payout(){
        $transactions = Transaction::whereDate('created_at', Carbon::today()->toDateString())->where(['trans_type' => "payout"])->get();
        $count = Transaction::whereDate('created_at', Carbon::today()->toDateString())->where(['trans_type' => "payout"])->count();
        $todayDate = $this->todayDate();
        return view('transaction.switch.payout',compact('transactions','count','todayDate'));
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
