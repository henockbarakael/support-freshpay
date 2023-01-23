<?php

namespace App\Http\Controllers;

use App\DataTables\DateRangeDataTable;
use App\DataTables\DrcSendMoneyTransacDataTable;
use App\DataTables\LastMonthDataTable;
use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function LastWeek(DrcSendMoneyTransacDataTable $dataTable){
        return $dataTable->render('transaction.report.week');
    }
    public function LastMonth(LastMonthDataTable $dataTable){
        return $dataTable->render('transaction.report.month');
    }
    public function DateRangePicker(DateRangeDataTable $dataTable, Request $request){
        return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render(view :'transaction.report.daterange');
    }
    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
