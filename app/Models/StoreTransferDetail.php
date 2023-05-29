<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTransferDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_transfer_id',
        'item_id',
        'unit_id',
        'from_item_batch',
        'to_item_batch',
        'production_date',
        'expiration_date',
        'qty',
        'unit_price',
        'total_price',
        'added_by',
        'company_id',
    ];

    public function fromItemBatch()
    {
        return $this->belongsTo(ItemBatch::class, 'from_item_batch');
    }

    public function toItemBatch()
    {
        return $this->belongsTo(ItemBatch::class, 'to_item_batch');
    }
}