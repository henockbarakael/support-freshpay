<?php

namespace App\Imports;

use App\Models\DrcSendMoneyTransac;
use App\Models\MerchantFile;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MerchantFileImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		// $result = DrcSendMoneyTransac::select('id','merchant_code','action','customer_details','amount','currency','method','thirdparty_reference','paydrc_reference','switch_reference','telco_reference','status','created_at','updated_at')->whereIn('paydrc_reference',$row['reference'])->get();
        return new MerchantFile([
            "id"=>$row['id'],
            "user_id"=>Auth::user()->id
        ]);
    }
    public function chunkSize(): int
    {
        return 5000;
    }
}
