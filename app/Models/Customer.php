<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'mobile',
        'initial_balance',
        'initial_balance_status',
        'notes',
        'company_id',
        'is_active',
        'added_by',
        'date',
    ];

    const INITIALBANALNCESTATUS = [1 => 'balanced', 2 => 'credit', 3 => 'debit'];

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
