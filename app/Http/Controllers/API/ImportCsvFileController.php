<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\TransactionsImport;
use App\Models\ImportedTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ImportCsvFileController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }

    public function index(){
        $rows = ImportedTransaction::orderBy('id','asc')->get();
        $todayDate = $this->todayDate();
        if (Auth::user()->is_user == 0) {
            return view('_admin.update.import',compact('rows','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.update.import',compact('rows','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.update.import',compact('rows','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.update.import',compact('rows','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.update.import',compact('rows','todayDate'));
        }
        
    }
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx'
        ]);

        Excel::import(new TransactionsImport, request()->file('file')->store('temp'));
    }
    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        ImportedTransaction::whereIn('paydrc_reference',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Transaction deleted successfully."]);
         
    }
}
