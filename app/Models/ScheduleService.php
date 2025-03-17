<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleService extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleServiceFactory> */
    use HasFactory;

    protected $guarded = ['id'];
}
