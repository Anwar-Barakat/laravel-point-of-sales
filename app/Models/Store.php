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
        'is_active',
        'company_code',
        'added_by',
        'updated_by',
    ];

    public $translatable = ['name'];
}
