<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaircutHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'style',
        'note',
        'photo',
        'is_favorite',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
} 