<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AccountType extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'is_active',
        'related_to_internal_account',
        'added_by'
    ];

    public $translatable    = ['name'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}