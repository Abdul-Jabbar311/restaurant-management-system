<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;
use App\Models\RestaurantTable;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'restaurant_table_id',
        'reservation_date',
        'reservation_time',
        'number_of_guests',
        'status',
        'special_request',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id');
    }

public function restaurantTable()
{
    return $this->belongsTo(RestaurantTable::class);
}
}