<?php

namespace App\Http\Controllers;

use App\DataTables\DateRangeDataTable;
use App\DataTables\DrcSendMoneyTransacDataTable;
use App\DataTables\LastMonthDataTable;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionReportController extends Controller
{
    public function LastWeek(DrcSendMoneyTransacDataTable $dataTable){
        if (Auth::user()->is_user == 0) {
            return $dataTable->render('_admin.transaction.report.week');
        }
        elseif (Auth::user()->is_user == 1) {
            return $dataTable->render('_manager.transaction.report.week');
        }
        elseif (Auth::user()->is_user == 2) {
            return $dataTable->render('_finance.transaction.report.week');
        }
        elseif (Auth::user()->is_user == 3) {
            return $dataTable->render('_suppfin.transaction.report.week');
        }
        elseif (Auth::user()->is_user == 4) {
            return $dataTable->render('_support.transaction.report.week');
        }  
    }
    public function LastMonth(LastMonthDataTable $dataTable){
        if (Auth::user()->is_user == 0) {
            return $dataTable->render('_admin.transaction.report.month');
        }
        elseif (Auth::user()->is_user == 1) {
            return $dataTable->render('_manager.transaction.report.month');
        }
        elseif (Auth::user()->is_user == 2) {
            return $dataTable->render('_finance.transaction.report.month');
        }
        elseif (Auth::user()->is_user == 3) {
            return $dataTable->render('_suppfin.transaction.report.month');
        }
        elseif (Auth::user()->is_user == 4) {
            return $dataTable->render('_support.transaction.report.month');
        }
    }
    public function DateRangePicker(DateRangeDataTable $dataTable, Request $request){
        if (Auth::user()->is_user == 0) {
            return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'_admin.transaction.report.daterange');
        }
        elseif (Auth::user()->is_user == 1) {
            return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'_manager.transaction.report.daterange');
        }
        elseif (Auth::user()->is_user == 2) {
            return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'_finance.transaction.report.daterange');
        }
        elseif (Auth::user()->is_user == 3) {
            return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'_suppfin.transaction.report.daterange');
        }
        elseif (Auth::user()->is_user == 4) {
            return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'_support.transaction.report.daterange');
        }
        
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
