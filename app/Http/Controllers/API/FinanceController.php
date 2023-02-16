<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FinanceController extends Controller
{
    public function pendingPayout(Request $request){
        $response = Http::get('http://206.189.25.253/services/paydrc/institution');
        $result = $response->json();
        $transactions = [];
        if(request()->ajax()) {
            
            if(!empty($request->dateStart)) {

                $dateStart = date('Y-m-d', strtotime($request->dateStart));
                $dateEnd = date('Y-m-d', strtotime($request->dateEnd));

                $data = ["dateStart"=>$dateStart,"dateEnd"=>$dateEnd];
                
                $sendData = Http::post('http://206.189.25.253/services/pending-payouts', $data);
                $transactions = $sendData->json();
                // dd($transactions);
            } 
            return datatables()->of($transactions)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    $btn ="<button class='btn btn-sm btn-dark deleteUser' data-id='".$row["paydrc_reference"]."'><i class='fa fa-paper-plane'></i></button>";
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        if (Auth::user()->is_user == 0) {
            return view('_admin.finance.pending',compact('result'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.finance.pending',compact('result'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.finance.pending',compact('result'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.finance.pending',compact('result'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.finance.pending',compact('result'));
        }
    }

    public function indexBalance(Request $request){
        $response = Http::get('http://206.189.25.253/services/paydrc/merchant');
        $result = $response->json();
        $transactions = [];
        if(request()->ajax()) {
            
            if(!empty($request->start_date)) {

                $date = date('Y-m-d', strtotime($request->start_date));
                // dd($request->merchant_code);
                $channel = $request->channel;
                $currency = $request->currency;
                $merchant_code = $request->merchant_code;
                $action = $request->action;

                $data = [
                    "merchant_code" => $merchant_code,
                    "currency" => $currency,
                    "channel" => $channel,
                    "date" => $date,
                    "action" => $action
                ];
                
                $sendData = Http::post('http://206.189.25.253/services/api/merchant/balance', $data);
                $transactions = $sendData->json();

                dd($transactions);
              
            } 
            return datatables()->of($transactions)->make(true);

        }
       
        if (Auth::user()->is_user == 0) {
            return view('_admin.finance.balance',compact('result'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.finance.balance',compact('result'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.finance.balance',compact('result'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.finance.balance',compact('result'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.finance.balance',compact('result'));
        }
        
    }

    // public function indexBalance(Request $request){
    //     $response = Http::get('http://206.189.25.253/services/paydrc/merchant');
    //     $result = $response->json();
    //     $transactions = [];
    //     if(request()->ajax()) {
            
    //         if(!empty($request->start_date)) {

    //             $date = date('Y-m-d', strtotime($request->start_date));
    //             // dd($request->merchant_code);
    //             $channel = $request->channel;
    //             $currency = $request->currency;
    //             $merchant_code = $request->merchant_code;
    //             $action = $request->action;

    //             $data = [
    //                 "merchant_code" => $merchant_code,
    //                 "currency" => $currency,
    //                 "channel" => $channel,
    //                 "date" => $date,
    //                 "action" => $action
    //             ];
                
    //             $sendData = Http::post('http://206.189.25.253/services/merchant-balance', $data);
    //             $transactions = $sendData->json();
    //             // dd($transactions);
    //         } 
    //         return datatables()->of($transactions)->make(true);

    //     }
       
    //     if (Auth::user()->is_user == 0) {
    //         return view('_admin.finance.balance',compact('result'));
    //     }
    //     elseif (Auth::user()->is_user == 1) {
    //         return view('_manager.finance.balance',compact('result'));
    //     }
    //     elseif (Auth::user()->is_user == 2) {
    //         return view('_finance.finance.balance',compact('result'));
    //     }
    //     elseif (Auth::user()->is_user == 3) {
    //         return view('_suppfin.finance.balance',compact('result'));
    //     }
    //     elseif (Auth::user()->is_user == 4) {
    //         return view('_support.finance.balance',compact('result'));
    //     }
        
        
    // }


    public function TopUpWallet(){
        $response = Http::get('http://206.189.25.253/services/paydrc/merchant');
        $result = $response->json();
        // dd($rKesult);
        if (Auth::user()->is_user == 0) {
            return view('_admin.finance.topup',compact('result'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.finance.topup',compact('result'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.finance.topup',compact('result'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.finance.topup',compact('result'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.finance.topup',compact('result'));
        }
    }

    public function WalletTopUpRequest(Request $request){
        $result = [];

        if(!empty($request->merchant_code)) {

            $merchant_code = $request->merchant_code;
            $vendor = $request->vendor;
            $amount = $request->amount;
            $currency = $request->currency;
        
            $data = [
                "merchant_code" => $merchant_code,
                "vendor" => $vendor,
                "amount" => $amount,              
                "currency" => $currency
            ];

            $sendData = Http::post('http://206.189.25.253/services/topup', $data);
            $result = $sendData->json();
            if ($result["success"] == true) {
                return response()->json(['success'=>true,'data'=>$result["dataTable"],'message'=>$result["message"]]);
            }
            else {
                return response()->json(['success'=>false,'message'=>$result["message"]]);
            }
        } 
    }

    public function transfer(){
        $response = Http::get('http://206.189.25.253/services/paydrc/merchant');
        $result = $response->json();
      
        if (Auth::user()->is_user == 0) {
            return view('_admin.finance.transfert',compact('result'));
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.finance.transfert',compact('result'));
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.finance.transfert',compact('result'));
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.finance.transfert',compact('result'));
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.finance.transfert',compact('result'));
        }
    }

    public function initiateTransfer(Request $request){
        $result = [];

        if(!empty($request->merchant_code)) {

            $merchant_code = $request->merchant_code;
            $channel = $request->channel;
            
            if(!empty($request->vendorTo) && $channel == "Wallet To Wallet") {
               
                    $vendorTo = $request->vendorTo;
                    $vendorFrom = $request->vendorFrom;
                    $vendor = $request->vendorFrom;
                
                
            }
            else{
    
                    $vendorTo = $request->vendorTo;
                    $vendorFrom = $request->vendorFrom;
                    $vendor = $request->vendor;
            }
            
            $amount = $request->amount;
            $currency = $request->currency;
        
            $data = [
                "merchant_code" => $merchant_code,
                "channel" => $channel,
                "vendorFrom" => $vendorFrom,
                "vendorTo" => $vendorTo,
                "vendor" => $vendor,
                "amount" => $amount,              
                "currency" => $currency
            ];

            $sendData = Http::post('http://206.189.25.253/services/transfert', $data);
            $result = $sendData->json();
            if ($result["success"] == true) {
                return response()->json(['success'=>true,'data'=>$result["dataTable"],'message'=>$result["message"]]);
            }
            else {
                return response()->json(['success'=>false,'message'=>$result["message"]]);
            }
        } 
    }

    public function history(Request $request){

       
        if(request()->ajax()) {
            $transactions = [];
            if(!empty($request->start_date)) {
                $dateStart = date('Y-m-d', strtotime($request->start_date));
                
                $sendData = Http::get('http://206.189.25.253/services/topupList/<dateStart>?', ["dateStart"=>$dateStart]);
                $transactions = $sendData->json();
            } 
            return datatables()->of($transactions)->make(true);

        }
        if (Auth::user()->is_user == 0) {
            return view('_admin.finance.history');
        }
        elseif (Auth::user()->is_user == 1) {
            return view('_manager.finance.history');
        }
        elseif (Auth::user()->is_user == 2) {
            return view('_finance.finance.history');
        }
        elseif (Auth::user()->is_user == 3) {
            return view('_suppfin.finance.history');
        }
        elseif (Auth::user()->is_user == 4) {
            return view('_support.finance.history');
        }
    }

    public function balance(Request $request){
       $request->validate([
            'merchant_code' => 'required|string|max:255',
        ]);

        $data = [
            "merchant_code"=>$request->merchant_code,
        ];
        $sendData = Http::post('http://206.189.25.253/services/merchant-balance', $data);
        $response = json_decode($sendData->getBody(), true);
      
        if ($response["success"] == true) {
            return response()->json(['success'=>true,'data'=>$response["balance"],'message'=>"Transaction successfully updated."]);
        }
        else {
            return response()->json(['success'=>false,'message'=>"Failed to update from switch db."]);
        }
    }
}
