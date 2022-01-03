<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneyFare extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'line_id',
        'start_station',
        'destination_station',
        'status',
        'card_no',
        'distance',
        'charged_fare',
    ];
}
