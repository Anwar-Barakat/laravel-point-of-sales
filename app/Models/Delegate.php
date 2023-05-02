<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'initial_balance',
        'initial_balance_status',
        'current_balance',
        'notes',
        'is_active',
        'added_by',
        'commission_type',
        'commission_value',
        'commission_value_for_sectoral',
        'commission_value_for_half_block',
        'commission_value_for_block',
        'category_id',
        'company_id',
    ];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
