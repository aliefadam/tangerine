<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberPlan extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            "subscribed_date" => "datetime",
            "expired_date" => "datetime",
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }


    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
