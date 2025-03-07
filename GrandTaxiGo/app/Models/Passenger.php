<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

public function reviews(){
    return $this->hasMany(Review::class);
}
}
