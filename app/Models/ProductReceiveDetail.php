<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReceiveDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'workshop_invoice_id',
        'item_id',
        'unit_id',
        'item_batch_id',
        'production_date',
        'expiration_date',
        'qty',
        'unit_price',
        'total_price',
        'added_by',
        'company_id',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function item_batch(): BelongsTo
    {
        return $this->belongsTo(ItemBatch::class, 'item_batch_id');
    }
}
