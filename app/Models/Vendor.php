<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',

        'initial_balance',
        'initial_balance_status',
        'currnet_balance',
        'category_id',
        'notes',
        'company_code',
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

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
