<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'address',
        'mobile',
        'is_active',
        'company_code',
        'added_by',
        'updated_by',
    ];

    public $translatable    = ['name'];
    protected $casts        = ['created_at' => 'date:Y-m-d',];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
