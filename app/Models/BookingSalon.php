<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSalon extends Model
{
    /** @use HasFactory<\Database\Factories\BookingSalonFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule_service()
    {
        return $this->belongsTo(ScheduleService::class, 'schedule_id');
    }
}
