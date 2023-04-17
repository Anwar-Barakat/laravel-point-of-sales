<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_type_id',
        'shift_id',
        'admin_id',
        'treasury_id',
        'order_id',
        'account_id',
        'is_account',
        'is_approved',
        'transaction_date',
        'money_for_account',
        'money_for_account',
        'company_code'
    ];
}
