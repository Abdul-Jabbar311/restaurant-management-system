<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'unit',
        'stock_quantity',
        'minimum_stock',
        'cost_per_unit',
        'is_active',
    ];

    protected $casts = [
        'stock_quantity' => 'decimal:3',
        'minimum_stock' => 'decimal:3',
        'cost_per_unit' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventoryTransactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    /**
     * Menu items that use this ingredient.
     */
    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(
            MenuItem::class,
            'ingredient_menu_item'
        )
        ->withPivot('quantity')
        ->withTimestamps();
    }
}