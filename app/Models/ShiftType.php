<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ShiftType extends Model
{
    use HasFactory, HasTranslations;

    public $translatable    = ['name'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function scopePrivate($query)
    {
        return $query->where('in_screen', 0);
    }

    public function scopeCollect($query)
    {
        return $query->where('in_screen', 1);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }
}