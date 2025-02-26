<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];
    protected $with = "courseDetails";


    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class);
    }
}
