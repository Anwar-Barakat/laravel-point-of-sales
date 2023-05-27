<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopInvoice extends Model
{
    use HasFactory;

    protected $guarded  = [];

    const INVOICETYPE   = [0 => 'cash', 1 => 'delayed'];

    public function scopeByTypeAndCompany($query, $type)
    {
        return $query->where(['type' => $type, 'company_id' => get_auth_com()]);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function workshopItems(): HasMany
    {
        return $this->hasMany(WorkshopInvoiceItem::class);
    }
}