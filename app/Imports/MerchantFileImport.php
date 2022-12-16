<?php

namespace App\Imports;

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

        return new MerchantFile([
            "id" => $row['id'],
            "thirdparty_reference"=>$row['thirdparty_reference'],
            "amount"=>$row['amount'],
            "currency"=>$row['currency'],
            "method"=>$row['method'],
            "customer_details"=>$row['customer_details'],
            "paydrc_reference"=>$row['paydrc_reference'],
            "action"=>$row['action'],
            "switch_reference"=>$row['switch_reference'],
            "telco_reference"=>$row['telco_reference'],
            "user_id"=>Auth::user()->id
        ]);
    }
    public function chunkSize(): int
    {
        return 5000;
    }
}
