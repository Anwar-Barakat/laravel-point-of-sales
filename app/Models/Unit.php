<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unit extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'status',
        'is_active',
        'company_id',
        'added_by',
        'updated_by',
    ];

    protected $translatable = ['name'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1, 'company_id' => get_auth_com()]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
