<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_date',
        'is_approved',
        'notes',
        'items_cost',
        'store_id',
        'to_store',
        'added_by',
        'company_id',
    ];

    public function fromStore()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function toStore()
    {
        return $this->belongsTo(Store::class, 'to_store');
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
