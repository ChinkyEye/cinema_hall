<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'category',
        'reminder',
        'status',
        'created_by',
    ];

    public function isCompleted(): bool
    {
        return $this->status === 'Completed';
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}
