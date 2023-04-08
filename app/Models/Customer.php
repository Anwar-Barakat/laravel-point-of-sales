<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    public function account()
    {
        return $this->belongsTo(FinancialAccount::class, 'account_id');
    }
    public function parentAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'parent_account_id');
    }
}
