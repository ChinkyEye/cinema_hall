<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'seat_id',
        'user_id',
    ];
    public  function getUserName(){
        return $this->belongsTo(User::class,'user_id');
    }
    public  function getSeatName(){
        return $this->belongsTo(Seat::class,'seat_id');
    }

}
