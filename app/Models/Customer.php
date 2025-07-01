<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // barbershop owner
        'name',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function haircutHistories()
    {
        return $this->hasMany(HaircutHistory::class);
    }
} 