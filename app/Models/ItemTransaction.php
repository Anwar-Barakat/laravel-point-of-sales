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
        'store_id',
        'order_id',
        'order_product_id',
        'sale_id',
        'sale_product_id',
        'report',
        'store_qty_before_transaction',
        'store_qty_after_transaction',
        'qty_before_transaction',
        'qty_after_transaction',
        'added_by',
        'company_id',
    ];
}
