<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardItem extends Model
{
    use HasFactory;

    protected $guarded = [];

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
