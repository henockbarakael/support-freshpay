<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrcSendMoneyMerchant extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'drc_send_money_merchant';
    protected $guarded = [];
}
