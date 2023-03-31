<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'barcode',
        'parent_id',
        'item_type',
        'has_retail_unit',
        'retail_unit_id',
        'wholesale_unit_id',
        'retail_unit_equal_to_wholesale',
        'is_active',
        'date',
        'company_code',
        'added_by',
        'updated_by',
        'category_id',
    ];
}
