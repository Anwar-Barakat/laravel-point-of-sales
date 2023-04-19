<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treasury extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_master',
        'is_active',
        'last_payment_exchange',
        'last_payment_collect',
        'company_code',
        'admin_id',
    ];

    protected $casts = ['created_at' => 'date:Y-m-d',];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function treasuriesDelivery(): HasMany
    {
        return $this->hasMany(TreasuryDelivery::class);
    }
}
