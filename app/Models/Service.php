<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ["categorySalon"];

    public function categorySalon()
    {
        return $this->belongsTo(CategorySalon::class);
    }
}
