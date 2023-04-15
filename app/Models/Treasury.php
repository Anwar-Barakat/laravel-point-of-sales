<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_master',
        'is_active',
        'last_payment_receipt',
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

    public function treasuriesDelivery()
    {
        return $this->hasMany(TreasuryDelivery::class);
    }
}
