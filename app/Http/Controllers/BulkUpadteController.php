<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\SendCallBackToMerchant;
use App\Models\DrcSendMoneyTransac;
use App\Models\ImportedTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BulkUpadteController extends Controller
{

    // public function paydrc($reference,$param,$describe) {

    //     $paydrc = ImportedTransaction::select('merchant_reference','transaction_reference')->whereIn('transaction_reference', $reference)->get()->toArray();
    //     dd($paydrc);
    //     $response = Http::post('http://167.71.131.224:4500/services/bulk-update', [
    //         'data' => $paydrc,
    //         'paydrc' => True,
    //         'status' => "Failed",
    //     ]);
    //     $result = json_decode($response->getBody(), true);
    //     dd($result);


    // }
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function paydrc($reference,$param,$describe) {

        $rows = $this->checkStatus($reference);
        $dataSet = [];
        $chunk = 100;
        $count = 1;

        foreach($rows as $idx => $row) {

            $cases[] = "WHEN paydrc_reference = '{$row['paydrc_reference']}' THEN ?";
            $ids[] = $row['id'];
            $paydrc_reference[] = $row['paydrc_reference'];

            $switch[] = $row['switch_reference'];
			$telco[] = $row['telco_reference'];
			$status[] = $param;
            $description[] = $describe;

            if(count($rows) === $idx + 1) {
                $dataSet[] = self::PayDrcBulkUpdate($cases, $ids, $status, $description);
                break;
            }
            if($count >= $chunk) {
                $dataSet[] = self::PayDrcBulkUpdate($cases, $ids, $status, $description);
                $cases = [];
                $ids = [];
                $paydrc_reference = [];
                $switch = [];
                $telco = [];
                $status = [];
                $description = [];
                $count = 0;
            }
            $count ++;
        }


        foreach($dataSet as $data) {
            DB::connection('paydrc')->update($data['sql'], $data['params']);
            $this->callback($paydrc_reference, $param);
            $this->removeData($ids);
        }

        
        
        $response = [
            'success' => true,
        ];
        return $response;

    }

    public function switch($reference,$param) {

        $rows = Transaction::whereIn('merchant_ref', $reference)->get();

        $dataSet = [];
        $chunk = 100;
        $count = 1;
        foreach($rows as $idx => $row) {

            $cases[] = "WHEN merchant_ref = '{$row['merchant_ref']}' THEN ?";
            $ids[] = $row['id'];
            $merchant_ref[] = $row['merchant_ref'];
			$status[] = $param;

            if(count($rows) === $idx + 1) {
                $dataSet[] = self::SwitchBulkUpdate($cases, $ids, $status);
                break;
            }
            if($count >= $chunk) {
                $dataSet[] = self::SwitchBulkUpdate($cases, $ids, $status);
                $cases = [];
                $ids = [];
                $merchant_ref = [];
                $status = [];
                $count = 0;
            }
            $count ++;
        }

        foreach($dataSet as $data) {
            DB::connection('switch')->update($data['sql'], $data['params']);
        }
        
        
        $response = [
            'success' => true,
            'status' => "Successfully updated",
        ];
        return $response;
    }

    public static function SwitchBulkUpdate($cases, $ids, $status) {

        $strCases = implode(' ', $cases);
        $strIds = implode(',', $ids);

        $sql = "UPDATE transactions SET `status` = ";
        $sql .= "CASE {$strCases} END, ";
        $sql .= "updated_at = NOW() ";
        $sql .= "WHERE `id` IN ({$strIds})";

        $data['sql'] = $sql;
        $data['params'] = $status;

        return $data;
    }

    public static function PayDrcBulkUpdate($cases, $ids, $status, $description) {

        $strCases = implode(' ', $cases);
        $strIds = implode(',', $ids);
        $pp = implode(',', $description);

        $sql = "UPDATE drc_send_money_transac SET `status` = ";
        $sql .= "CASE {$strCases} END, ";
        $sql .= "`status_description` = CASE {$strCases} END, ";
        $sql .= "`updated_at` = NOW() ";
        $sql .= "WHERE `id` IN ({$strIds})";

        $data['sql'] = $sql;
        $data['params'] = [...$status, ...$description];

        return $data;
    }

    public function callback($reference, $status){
        $rows = Transaction::whereIn('merchant_ref', $reference)->get();
        foreach ($rows as $key => $value) {
            $action = $value->action;
            $telco_reference = $value->telco_reference;
            $switch_reference = $value->switch_reference;
            $paydrc_reference = $value->paydrc_reference;
            $telco_status_description = $value->telco_status_description;
            $callbackRequest = new SendCallBackToMerchant;
            $callbackRequest->callback($action,$switch_reference,$telco_reference,$status,$paydrc_reference,$telco_status_description);

        }
    }

    public function removeData($reference){
       ImportedTransaction::whereIn('id', $reference)->delete();
    }

    public function checkStatus($reference){
        $rows = DrcSendMoneyTransac::whereIn('paydrc_reference', $reference)->get();
        return $rows;
    }

}
