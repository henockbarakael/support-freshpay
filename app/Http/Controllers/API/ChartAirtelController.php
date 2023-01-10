<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartAirtelController extends Controller
{
    public function chartAirtelDebit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'debit')
                ->where('method', 'airtel')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
    public function chartAirtelCredit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'credit')
                ->where('method', 'airtel')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
}
