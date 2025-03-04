<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            "date" => "datetime",
            "time" => "datetime",
        ];
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberPlan()
    {
        return $this->belongsTo(MemberPlan::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseDetail()
    {
        return $this->belongsTo(CourseDetail::class);
    }

    public function scheduleCapacity()
    {
        return $this->hasOne(ScheduleCapacity::class);
    }
}
