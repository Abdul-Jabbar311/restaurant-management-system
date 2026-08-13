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
    'inventory_deducted',
    'stock_deducted_at',
    'payment_status',
    'total_amount',
    'notes',
];

protected $casts = [
    'total_amount' => 'decimal:2',
    'inventory_deducted' => 'boolean',
    'stock_deducted_at' => 'datetime',
];

    /**
     * Customer who placed the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Restaurant table.
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(
            RestaurantTable::class,
            'restaurant_table_id'
        );
    }

    /**
     * Waiter assigned to the order.
     */
    public function waiter(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'waiter_id'
        );
    }

    /**
     * Items included in this order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Restaurant table relationship.
     */
    public function restaurantTable(): BelongsTo
    {
        return $this->belongsTo(
            RestaurantTable::class,
            'restaurant_table_id'
        );
    }

    /**
     * Payments made for this order.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Kitchen order associated with this order.
     */
    public function kitchenOrder(): HasOne
    {
        return $this->hasOne(KitchenOrder::class);
    }
}