<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'restaurant_name',
        'phone',
        'email',
        'address',
        'tax_percentage',
        'currency',
        'logo',
    ];

    protected $casts = [
        'tax_percentage' => 'decimal:2',
    ];
}