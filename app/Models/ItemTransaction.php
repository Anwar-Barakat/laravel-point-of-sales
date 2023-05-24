<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_transaction_category_id',
        'item_transaction_type_id',
        'item_id',
        'store_id',
        'order_id',
        'order_product_id',
        'sale_id',
        'sale_product_id',
        'store_inventory_id',
        'store_inventory_item_id',
        'report',
        'store_qty_before_transaction',
        'store_qty_after_transaction',
        'qty_before_transaction',
        'qty_after_transaction',
        'added_by',
        'company_id',
    ];


    public function transaction_category(): BelongsTo
    {
        return $this->belongsTo(ItemTransactionCategory::class, 'item_transaction_category_id');
    }

    public function transaction_type(): BelongsTo
    {
        return $this->belongsTo(ItemTransactionType::class, 'item_transaction_type_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
