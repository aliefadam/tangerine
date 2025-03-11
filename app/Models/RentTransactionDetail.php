<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentTransactionDetail extends Model
{
    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function rentTransaction()
    {
        return $this->belongsTo(RentTransaction::class);
    }
}
