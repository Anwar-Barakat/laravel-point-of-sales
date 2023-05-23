<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_date',
        'inventory_type',
        'store_id',
        'is_closed',
        'total_inventory',
        'notes',
        'added_by',
        'company_id',
    ];
    
    const INVENTORYTYPE = [1 => 'daily_inventory', 2 => 'weekly_inventory', 3 => 'monthly_inventory', 4 => 'annual_inventory'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function storeInventoryItems(): HasMany
    {
        return $this->hasMany(StoreInventoryItem::class);
    }
}