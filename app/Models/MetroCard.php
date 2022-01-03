<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetroCard extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'card_no',
        'pin',
        'card_user_id',
        'status',
    ];

}

