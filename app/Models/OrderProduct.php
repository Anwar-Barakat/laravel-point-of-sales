<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'unit_id',
        'unit_price',
        'item_id',
        'production_date',
        'expiration_date',
        'qty',
        'total_cost',
        'added_by',
        'company_code',
    ];
}