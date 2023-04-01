<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardItem extends Model
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

    const ITEMTYPE = ['stored', 'consuming', 'protected'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function parentCard()
    {
        return $this->belongsTo(Card::class, 'parent_id');
    }
}
