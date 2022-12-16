<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DrcSendMoneyTransac;
use Illuminate\Http\Request;

class GetPayDrcData extends Controller
{
    public function getTransactionByPayDrcRef($paydrc_reference){
        $paydrc = DrcSendMoneyTransac::where('paydrc_reference',$paydrc_reference)->first();
        if ($paydrc == null) {
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
                'result' => $paydrc,
            ];
            return $response;
        }
    }
    public function getTransactionBySwitchRef($switch_reference){
        $paydrc = DrcSendMoneyTransac::where('switch_reference',$switch_reference)->first();
        if ($paydrc == null) {
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
                'result' => $paydrc,
            ];
            return $response;
        }
    }
    public function getTransactionByTelcoRef($telco_reference){
        $paydrc = DrcSendMoneyTransac::where('telco_reference',$telco_reference)->first();
        if ($paydrc == null) {
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
                'result' => $paydrc,
            ];
            return $response;
        }
    }
    public function getTransactionById($id){
        $paydrc = DrcSendMoneyTransac::where('id',$id)->first();
        if ($paydrc == null) {
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
                'result' => $paydrc,
            ];
            return $response;
        }
    }
}
