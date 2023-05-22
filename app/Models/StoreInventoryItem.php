<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'is_closed',
        'added_by',
    ];
}
