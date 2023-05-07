<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'item_id',
        'unit_id',
        'qty',
        'unit_price',
        'total_price',
        'production_date',
        'expiration_date',
        'is_archieved',
        'added_by',
        'company_id',
    ];


    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
