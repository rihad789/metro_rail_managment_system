<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{

    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'type',
        'status',
    ];

}



