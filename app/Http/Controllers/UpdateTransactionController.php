<?php

namespace App\Http\Controllers;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateTransactionController extends Controller
{
    public function update(){
		$result = null;
        $todayDate = $this->todayDate();
		return view('transaction.update.index',compact('result','todayDate'));
	}
    
    public function updateSearch(Request $request){
        $reference = $request->option;
        $reference_value = $request->option_value;
        $date = $request->date;
        // $date = date('Y-m-d', strtotime($request->datetime));
        if ($date == null) {
            $madate = "";
        }
        else {
            $madate = $date;
        }
        $data = [
            "value"=>$reference_value,
            "type"=>$reference,
            "date"=>$madate
        ];
        $url = "http://127.0.0.1:8086/services/paydrc/transaction/search";
        $response = Http::post('http://127.0.0.1:8086/services/paydrc/transaction/search', $data);
        $smt = json_decode($response->getBody(), true);
        $todayDate = $this->todayDate();
        if ($smt == null) {
            Alert::error('Error', 'Transaction not found');
            $result = null;
            return view('transaction.update.index',compact('result','todayDate'));
        }
        else {
            $result = $smt[0];
            if ($result != null) {
                if ($result["status"] == "Failed" || $result["status"] == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    return view('transaction.update.index',compact('result','todayDate'));
                }
                else {
                    return view('transaction.update.index',compact('result','todayDate'));
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                $result = null;

                return view('transaction.update.index',compact('result','todayDate'));
            }
        } 
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
