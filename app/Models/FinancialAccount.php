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
        'acount_number',
        'initial_balance',
        'currnet_balance',
        'notes',
        'company_code',
        'is_archived',
        'added_by',
        'date',
    ];
}