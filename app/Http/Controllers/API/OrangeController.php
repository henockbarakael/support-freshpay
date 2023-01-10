<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrangeController extends Controller
{
    public function global_payout(){
        $totals = DrcSendMoneyTransac::selectRaw("count(case when status = 'Successful' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'credit' and method = 'orange' then 1 end) as success")
        ->selectRaw("count(case when status = 'Failed' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'credit' and method = 'orange' then 1 end) as failed")
        ->selectRaw("count(case when status = 'Pending' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'credit' and method = 'orange' then 1 end) as pending")
        ->selectRaw("count(case when status = 'Submitted' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'credit' and method = 'orange' then 1 end) as submitted")
        ->first();
        return $totals;
    }
    public function global_charge(){
        $totals = DrcSendMoneyTransac::selectRaw("count(case when status = 'Successful' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as success")
        ->selectRaw("count(case when status = 'Failed' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as failed")
        ->selectRaw("count(case when status = 'Pending' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as pending")
        ->selectRaw("count(case when status = 'Submitted' and DATE(created_at) = DATE(SUBDATE(NOW(), 0)) and action = 'debit' and method = 'orange' then 1 end) as submitted")
        ->first();
        return $totals;
    }
}
