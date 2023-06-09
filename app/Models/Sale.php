<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded      = [];
    const INVOICETYPE       = [0 => 'cash', 1 => 'delayed'];
    const SALETYPE          = [1 => 'sales', 3 => 'general_sale_return'];
    const SALEINVOICETYPE   = [1 => 'sectoral', 2 => 'half_wholesale', 3 => 'wholesale'];

    public function scopeByTypeAndCompany($query, $type)
    {
        return $query->where(['type' => $type, 'company_id' => get_auth_com()]);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class, 'delegate_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function saleProducts(): HasMany
    {
        return $this->hasMany(SaleProduct::class, 'sale_id');
    }
}
