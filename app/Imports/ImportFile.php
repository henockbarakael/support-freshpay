<?php

namespace App\Imports;

use App\Models\ImportedTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFile implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportedTransaction([
            "id" => $row['id'],
            "merchant_code"=>$row['merchant_code'],
            "thirdparty_reference"=>$row['thirdparty_reference'],
            "amount"=>$row['amount'],
            "currency"=>$row['currency'],
            "method"=>$row['method'],
            "created_at"=>Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at']),
            "updated_at"=>Carbon::createFromFormat('Y-m-d H:i:s', $row['updated_at']),
            "customer_details"=>$row['customer_details'],
            "paydrc_reference"=>$row['paydrc_reference'],
            "status"=>$row['status'],
            "action"=>$row['action'],
            "switch_reference"=>$row['switch_reference'],
            "telco_reference"=>$row['telco_reference'],
            "callback_url"=>$row['callback_url'],
            "status_description"=>$row['status_description'],
            "user_id"=>Auth::user()->id,
        ]);
    }
}
