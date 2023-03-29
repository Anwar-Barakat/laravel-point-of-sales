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

    public function scopeActive($query)
    {
        return $query->where(['status' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->with('subCategories')->where('parent_id', 0);
    }

    public function parentCategories()
    {
        return $this->hasMany(Category::class)->where(['categories.parent_id' => 0])->select('id', 'name');
    }
}
