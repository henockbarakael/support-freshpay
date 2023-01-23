<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateRangeController extends Controller
{
    public function index(){
        return view('transaction.report.daterange');
    }
    
    public function records(Request $request){
        if ($request->ajax()) {
    
            if ($request->input('start_date') && $request->input('end_date')) {
    
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));
    
                if ($end_date->greaterThan($start_date)) {
                    $students = DrcSendMoneyTransac::select('id','merchant_code','thirdparty_reference','created_at')->whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $students = DrcSendMoneyTransac::select('id','merchant_code','thirdparty_reference','created_at')->latest()->get();
                }
            } else {
                $students = DrcSendMoneyTransac::select('id','merchant_code','thirdparty_reference','created_at')->latest()->get();
            }
    
            return response()->json([
                'students' => $students
            ]);
        } else {
            abort(403);
        }
    
    }
}
