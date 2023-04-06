<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_parent',
        'account_type_id',
        'parent_id',
        'account_number',
        'initial_balance',
        'currnet_balance',
        'notes',
        'company_code',
        'is_archived',
        'is_active',
        'added_by',
        'date',
    ];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function parentAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'parent_id');
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }
}
