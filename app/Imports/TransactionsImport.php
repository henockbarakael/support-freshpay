<?php

namespace App\Imports;

use App\Models\ImportedTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $created_at = empty($row['created_at']) ? $row['created_at'] : Carbon::createFromFormat('d/m/Y h:i A', $row['created_at'])->format('d/m/Y');
        // $updated_at = empty($row['updated_at']) ? $row['updated_at'] : Carbon::createFromFormat('d/m/Y h:i A', $row['updated_at'])->format('d/m/Y');

        
        return new ImportedTransaction([
            "id" => $row['id'],
            "merchant_code"=>$row['merchant_code'],
            "thirdparty_reference"=>$row['thirdparty_reference'],
            "amount"=>$row['amount'],
            "currency"=>$row['currency'],
            "method"=>$row['method'],
            "customer_details"=>$row['customer_details'],
            "paydrc_reference"=>$row['paydrc_reference'],
            "status"=>$row['status'],
            "action"=>$row['action'],
            "switch_reference"=>$row['switch_reference'],
            "telco_reference"=>$row['telco_reference'],
            "callback_url"=>$row['callback_url'],
            "status_description"=>$row['status_description'],
            "user_id"=>Auth::user()->id
        ]);
    }
    public function chunkSize(): int
    {
        return 5000;
    }
}
