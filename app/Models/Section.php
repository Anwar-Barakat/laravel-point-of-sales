<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'notes',
        'is_active',
        'added_by',
        'updated_by',
    ];

    public $translatable    = ['name'];
    protected $casts        = ['created_at' => 'date:Y-m-d',];
}
