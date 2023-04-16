<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'delivered_admin_id',
        'treasury_id',
        'delivered_treasury_id',
        'delivered_shift_id',
        'init_treasury_balance',
        'start_date',
        'end_date',
        'is_finished',
        'is_delivered',
        'commission',
        'what_delivered',
        'status',
        'status_money',
        'receive_type',
        'review_date',
        'notes',
        'company_code',
    ];
}
