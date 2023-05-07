<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $query->where(['is_active' => 1, 'company_id' => get_auth_com()]);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term);
        });
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

    public function transactions(): HasMany
    {
        return $this->hasMany(ItemTransaction::class);
    }

    public function item_batches(): HasMany
    {
        return $this->hasMany(ItemBatch::class, 'item_id');
    }
}
