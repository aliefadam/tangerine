<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        "rent_price_under_10" => "array",
        "rent_price_over_10" => "array",
    ];
}
