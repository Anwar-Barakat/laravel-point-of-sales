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

    public function scopeActive($query)
    {
        return $query->where(['company_id' => get_auth_com()]);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function production_line(): BelongsTo
    {
        return $this->belongsTo(ProductionLine::class, 'production_line_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function workshopItems(): HasMany
    {
        return $this->hasMany(WorkshopInvoiceItem::class);
    }
}