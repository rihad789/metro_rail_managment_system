<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetroCardUserAccount extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'card_user_id',
        'account_no',
        'balance',
    ];
}

