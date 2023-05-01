<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_type_id',
        'is_parent',
        'parent_id',
        'number',
        'initial_balance',
        'initial_balance_status',
        'current_balance',
        'notes',
        'company_code',
        'is_archived',
        'added_by',
        'date',
        'customer_id',
        'vendor_id',
        'delegate_id',
    ];

    const INITIALBANALNCESTATUS = [1 => 'balanced', 2 => 'credit', 3 => 'debit'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term);
        });
    }

    public function scopeActive($query)
    {
        return $query->where(['is_archived' => '0']);
    }

    public function scopeParent($query)
    {
        return $this->where(['is_parent' => '1', 'is_archived' => '0']);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function parentAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    public function childAccounts(): HasMany
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
    }
}