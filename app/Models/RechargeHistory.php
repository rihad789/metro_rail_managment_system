<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'amount',
        'method',
        'payment_from',
        'transaction_id',
        'recharged_by',
    ];
}
