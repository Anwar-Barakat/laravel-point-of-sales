<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductReceive extends Model
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

    public function production_line(): BelongsTo
    {
        return $this->belongsTo(ProductionLine::class, 'production_line_id');
    }

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id')->with('account');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function productsReceiveDetail(): HasMany
    {
        return $this->hasMany(ProductReceiveDetail::class, 'product_receive_id');
    }
}
