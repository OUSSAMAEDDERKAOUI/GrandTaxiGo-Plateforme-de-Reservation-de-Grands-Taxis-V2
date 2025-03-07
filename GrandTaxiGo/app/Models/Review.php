<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected  $fillable=[
        'review',
        'comment',
        'driver_id',
        'passenger_id',
    ];
    public function driver(){
        return $this->BelongsTo(Driver::class);
    }
    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }
}
