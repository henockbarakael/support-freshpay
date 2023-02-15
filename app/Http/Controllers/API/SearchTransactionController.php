<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class SearchTransactionController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 1200);
    }

    public function index(){
		$result = null;
        $todayDate = $this->todayDate();
        if (Auth::user()->is_user == 0) {
            return view('_admin.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.update.index',compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.update.index',compact('result','todayDate'));
        }
		
	}

    public function update(Request $request){
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
        $url = "http://206.189.25.253/services/paydrc/transaction/search";
        $response = Http::post('http://206.189.25.253/services/paydrc/transaction/search', $data);
        $smt = json_decode($response->getBody(), true);
        $todayDate = $this->todayDate();
        if ($smt == null) {
            Alert::error('Error', 'Transaction not found');
            $result = null;
            
            if (Auth::user()->is_user == 0) {
                return view('_admin.update.index',compact('result','todayDate'));
            }
            elseif (Auth::user()->is_user == 1) {
                return view('_manager.update.index',compact('result','todayDate'));
            }
            elseif (Auth::user()->is_user == 2) {
                return view('_finance.update.index',compact('result','todayDate'));
            }
            elseif (Auth::user()->is_user == 3) {
                return view('_suppfin.update.index',compact('result','todayDate'));
            }
            elseif (Auth::user()->is_user == 4) {
                return view('_support.update.index',compact('result','todayDate'));
            }
        }
        else {
            $result = $smt[0];
            if ($result != null) {
                if ($result["status"] == "Failed" || $result["status"] == "Successful") {
                    Alert::success('Nothing to do!', 'Transaction already up to date');
                    if (Auth::user()->is_user == 0) {
                        return view('_admin.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 1) {
                        return view('_manager.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 2) {
                        return view('_finance.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 3) {
                        return view('_suppfin.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 4) {
                        return view('_support.update.index',compact('result','todayDate'));
                    }
                }
                else {
                    if (Auth::user()->is_user == 0) {
                        return view('_admin.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 1) {
                        return view('_manager.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 2) {
                        return view('_finance.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 3) {
                        return view('_suppfin.update.index',compact('result','todayDate'));
                    }
                    elseif (Auth::user()->is_user == 4) {
                        return view('_support.update.index',compact('result','todayDate'));
                    }
                }
            }
            else {
                Alert::error('Error', 'Transaction not found');
                $result = null;

                if (Auth::user()->is_user == 0) {
                    return view('_admin.update.index',compact('result','todayDate'));
                }
                elseif (Auth::user()->is_user == 1) {
                    return view('_manager.update.index',compact('result','todayDate'));
                }
                elseif (Auth::user()->is_user == 2) {
                    return view('_finance.update.index',compact('result','todayDate'));
                }
                elseif (Auth::user()->is_user == 3) {
                    return view('_suppfin.update.index',compact('result','todayDate'));
                }
                elseif (Auth::user()->is_user == 4) {
                    return view('_support.update.index',compact('result','todayDate'));
                }
            }
        } 
    }

    public function todayDate(){
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y');
        return $todayDate;
    }
}
