<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantFile extends Model
{
    use HasFactory;
    protected $fillable = ['id','thirdparty_reference',
    'amount','currncy','action','method','customer_details',
    'paydrc_reference','switch_reference','telco_reference','user_id'
];
}
