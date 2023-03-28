<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'name',
        'company_code',
        'is_active',
        'description',
        'parent_id',

        'section_id',
        'added_by',
        'updated_by',
    ];

    public $translatable    = ['name'];
    protected $casts        = ['created_at'    => 'date:Y-m-d',];


    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(1920)
            ->height(720);
    }

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function scopeActiveParent($query)
    {
        return $query->where(['parent_id' => 0, 'is_active' => 1]);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'name');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('is_active', 1);
    }
}
