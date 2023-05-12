<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'initial_balance',
        'initial_balance_status',
        'current_balance',
        'notes',
        'is_active',
        'commission_type',
        'commission_value',
        'commission_for_sectoral',
        'commission_for_half_block',
        'commission_for_block',
        'company_id',
    ];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term);
        });
    }

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
