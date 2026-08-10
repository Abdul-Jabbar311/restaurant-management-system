<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\RestaurantTable;

class Order extends Model
{
    protected $fillable = [
        'restaurant_table_id',
        'customer_id',
        'waiter_id',
        'order_number',
        'status',
        'payment_status',
        'total_amount',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
        public function table(): BelongsTo
    {
        return $this->belongsTo(
            RestaurantTable::class,
            'restaurant_table_id'
        );
    }

    public function waiter(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'waiter_id'
        );
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function restaurantTable()
{
    return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id');
}
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function kitchenOrder(): HasOne

    {

        return $this->hasOne(KitchenOrder::class);

    }


}