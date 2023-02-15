<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class InstitutionController extends Controller
{
    public function index(){
        $response = Http::get('http://206.189.25.253/services/paydrc/institution');
        $result = $response->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.institution.index',compact('result'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.institution.index',compact('result'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.institution.index',compact('result'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.institution.index',compact('result'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.institution.index',compact('result'));
        }
    }

    public function store(Request $request){
        
        $data = [
            "institution_name"=>$request->institution_name,
            "email"=>$request->institution_email,
            "telephone"=>$request->institution_phone
        ];
        $sendData = Http::post('http://206.189.25.253/services/create-institution', $data);
        $response = json_decode($sendData->getBody(), true);

        if ($response["success"] == true) {
            # dd($response["institution"]["email"]);
            return response()->json(['status'=>true,'message'=>$response["description"]]);
        }
        else {
            return response()->json(['status'=>false,'message'=>$response["description"]]);
        }
    }   

    public function user(){
        $response = Http::get('http://206.189.25.253/services/paydrc/institution_user');
        $result = $response->json();
        $response_2 = Http::get('http://206.189.25.253/services/paydrc/institution');
        $result_2 = $response_2->json();
        if (Auth::user()->is_user == 0) {
            return view('_admin.institution.user',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.institution.user',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.institution.user',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.institution.user',compact('result','result_2'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.institution.user',compact('result','result_2'));
        }
    }

    public function storeUser(Request $request){
        $data = [
            "institution_code"=>$request->institution_code,
            // "institution_name"=>$request->institution_name,
            "firstname"=>$request->firstname,
            "lastname"=>$request->lastname,
            "level"=>$request->niveau,
            "email"=>$request->email,
            "telephone"=>$request->telephone,
            "password"=>$request->password
        ];
        $sendData = Http::post('http://206.189.25.253/services/create-institution-user', $data);
        $response = json_decode($sendData->getBody(), true);

        if ($response["success"] == true) {
            # dd($response["institution"]["email"]);
            return response()->json(['status'=>true,'message'=>$response["description"]]);
        }
        else {
            return response()->json(['status'=>false,'message'=>$response["description"]]);
        }
    }
}
