<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'date_opened',
        'date_closed',
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


    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function treasury(): BelongsTo
    {
        return $this->belongsTo(Treasury::class, 'treasury_id');
    }
}