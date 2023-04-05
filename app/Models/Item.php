<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Item extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    const ITEMTYPE = [1 => 'stored', 2 => 'consuming', 3 => 'protected'];

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1]);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 400, 400)
            ->nonQueued();
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function parentItem()
    {
        return $this->belongsTo(Item::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function parentUnit()
    {
        return $this->belongsTo(Unit::class, 'wholesale_unit_id');
    }

    public function childUnit()
    {
        return $this->belongsTo(Unit::class, 'retail_unit_id');
    }
}