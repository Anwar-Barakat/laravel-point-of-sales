<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'account_number',
        'account_id',
        'parent_account_id',
        'initial_balance',
        'initial_balance_status',
        'currnet_balance',
        'notes',
        'company_code',
        'is_active',
        'added_by',
        'date',
    ];

    public function account()
    {
        return $this->belongsTo(FinancialAccount::class, 'account_id');
    }
    public function parentAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'parent_account_id');
    }
}
