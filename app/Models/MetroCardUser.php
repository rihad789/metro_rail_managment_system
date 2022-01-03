<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetroCardUser extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'nid',
        'division',
        'district',
        'thana',
        'street',
        'postalcode',
    ];
}
