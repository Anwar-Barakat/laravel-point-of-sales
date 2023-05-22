<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    const INVENTORYTYPE = [1 => 'daily_inventry', 2 => 'weekly_inventry', 3 => 'monthly_inventry', 4 => 'yearly_inventry'];
}
