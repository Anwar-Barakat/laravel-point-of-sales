<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'account_number',
        'account_id',
        'initial_balance',
        'initial_balance_status',
        'currnet_balance',
        'notes',
        'company_code',
        'is_active',
        'added_by',
        'date',
    ];

    const INITIALBANALNCESTATUS = [1 => 'balanced', 2 => 'credit', 3 => 'debit'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class, 'account_id');
    }
}
