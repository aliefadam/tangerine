<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beautician extends Model
{
    /** @use HasFactory<\Database\Factories\BeauticianFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
