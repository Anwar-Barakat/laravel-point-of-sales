<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_transaction_category_id',
        'item_transaction_type_id',
        'item_id',
        'order_id',
        'order_product_id',
        'report',
        'qty_before_transaction',
        'qty_after_transaction',
        'added_by',
        'company_code',
    ];
}