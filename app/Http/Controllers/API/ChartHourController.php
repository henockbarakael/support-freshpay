<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartHourController extends Controller
{
    public function hour(){
        $hour = DrcSendMoneyTransac::select(DB::raw("Hour(created_at) as hour"))
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->groupBy(DB::raw("Hour(created_at)"))
                ->pluck('hour');
        return $hour;
    }
}
