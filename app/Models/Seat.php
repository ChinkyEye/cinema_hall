<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'row',
        'column',
        'type',
        'is_occupied',
        'movie_id',
        'group_id',
        'created_by',
    ];
}
