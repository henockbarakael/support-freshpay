<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartOrangeController extends Controller
{
    public function chartOrangeDebit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'debit')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
    public function chartOrangeCredit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'credit')
                ->where('method', 'orange')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
}
