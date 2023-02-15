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

  
    public function __construct()
    {
        ini_set('max_execution_time', 300000);
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
            $this->removeData($ids);
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
            $curl_post_data = [
                "status" => $status,
                "action" => $value["trans_type"],
                "switch_reference" => $value["trans_ref_no"],
                "telco_reference" => $value["financial_institution_transaction_id"],
                "paydrc_reference" => $value["merchant_ref"],
                "telco_status_description" => $value["financial_institution_status_description"]
            ];
    
            $url ="http://206.189.25.253/services/callback";
            $data = json_encode($curl_post_data);
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_exec($ch); 
        }
        $response = [
            'success' => true
        ];
        return $response;
        
    }

    public function removeData($reference){
       ImportedTransaction::whereIn('id', $reference)->delete();
    }

    public function checkStatus($reference){
        $rows = DrcSendMoneyTransac::whereIn('paydrc_reference', $reference)->get();
        return $rows;
    }

}
