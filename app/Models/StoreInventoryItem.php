<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreInventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_inventory_id',
        'item_id',
        'unit_id',
        'item_batch_id',
        'old_qty',
        'new_qty',
        'subtract',
        'unit_price',
        'total_price',
        'production_date',
        'expiration_date',
        'is_closed',
        'notes',
        'added_by',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function item_batch(): BelongsTo
    {
        return $this->belongsTo(ItemBatch::class, 'item_batch_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
