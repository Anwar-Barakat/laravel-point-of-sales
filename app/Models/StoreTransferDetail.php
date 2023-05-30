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
        'item_batch_id',
        'to_item_batch',
        'production_date',
        'expiration_date',
        'qty',
        'unit_price',
        'total_price',
        'added_by',
        'company_id',
        'is_approved',
        'approved_at',
        'approved_by',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function fromItemBatch()
    {
        return $this->belongsTo(ItemBatch::class, 'item_batch_id');
    }

    public function toItemBatch()
    {
        return $this->belongsTo(ItemBatch::class, 'to_item_batch');
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

}