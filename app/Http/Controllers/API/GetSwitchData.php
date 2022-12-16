<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GetSwitchData extends Controller
{
    public function getTransactionByPayDrcRef($paydrc_reference){
        $switch = Transaction::where('merchant_ref',$paydrc_reference)->first();
        if ($switch == null) {
            $response = [
                'success' => false,
                'message' => "Transaction not found!",
            ];
            return $response;
        }
        else {
            $response = [
                'success' => true,
                'message' => "Transaction found!",
                'result' => $switch,
            ];
            return $response;
        }
    }
    public function getTransactionBySwitchRef($switch_reference){
        $switch = Transaction::where('trans_ref_no',$switch_reference)->first();
        if ($switch == null) {
            $response = [
                'success' => false,
                'message' => "Transaction not found!",
            ];
            return $response;
        }
        else {
            $response = [
                'success' => true,
                'message' => "Transaction found!",
                'result' => $switch,
            ];
            return $response;
        }
    }
}
