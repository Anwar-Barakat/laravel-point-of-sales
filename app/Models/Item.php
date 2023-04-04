<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'is_active',
        'item_type',
        'category_id',
        'parent_id',
        'has_fixed_price',
        'has_retail_unit',
        'wholesale_unit_id',
        'wholesale_price',
        'wholesale_price_for_block',
        'wholesale_price_for_half_block',
        'wholesale_cost_price',
        'retail_count_for_wholesale',
        'retail_unit_id',
        'retail_price',
        'retail_price_for_block',
        'retail_price_for_half_block',
        'retail_cost_price',
    ];

    const ITEMTYPE = [1 => 'stored', 2 => 'consuming', 3 => 'protected'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function parentItem()
    {
        return $this->belongsTo(Item::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function parentUnit()
    {
        return $this->belongsTo(Unit::class, 'wholesale_unit_id');
    }

    public function childUnit()
    {
        return $this->belongsTo(Unit::class, 'retail_unit_id');
    }
}
