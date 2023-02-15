<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StatistiqueController extends Controller
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
        $statistique = Http::get('http://206.189.25.253/services/paydrc/merchant_stat');
        $result = $statistique->json();
        $todayDate = $this->todayDate();
        if (Auth::user()->is_user == 0) {
            return view("_admin.statistique.statistique", compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view("_manager.statistique.statistique", compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view("_finance.statistique.statistique", compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view("_suppfin.statistique.statistique", compact('result','todayDate'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view("_support.statistique.statistique", compact('result','todayDate'));
        }
    }
}
