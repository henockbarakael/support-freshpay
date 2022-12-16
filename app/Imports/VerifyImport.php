<?php

namespace App\Imports;

use App\Models\TransactionVerify;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VerifyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TransactionVerify([
            "customer_number"=>$row["source_account_number"],
            "switch_reference"=>$row["trans_ref_no"],
            "trans_partid"=>$row["partid"],
            "user_id"=>Auth::user()->id,
        ]);
    }
}
