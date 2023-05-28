<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan',
        'plan_date',
        'is_approved',
        'approved_by',
        'approved_at',
        'added_by',
        'is_closed',
        'closed_by',
        'closed_at',
        'company_id',
    ];

    public function scopeClosed($query)
    {
        return $query->where(['is_closed' => 1, 'company_id' => get_auth_com()]);
    }

    public function scopeApproved($query)
    {
        return $query->where(['is_approved' => 1, 'company_id' => get_auth_com()]);
    }
}
