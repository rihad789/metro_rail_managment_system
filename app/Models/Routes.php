<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'train_line_id',
        'station_id',
        'next_station_id',
        'station_order',
        'distance'
    ];
}
