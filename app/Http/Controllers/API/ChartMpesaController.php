<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartMpesaController extends Controller
{
    public function chartMpesaDebit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'debit')
                ->where('method', 'mpesa')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
    public function chartMpesaCredit(){
        $result = DrcSendMoneyTransac::select(DB::raw("SUM(amount) as count"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->where('action', 'credit')
                ->where('method', 'mpesa')
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('count');
        return $result;
    }
}
