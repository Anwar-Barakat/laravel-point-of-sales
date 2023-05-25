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
}