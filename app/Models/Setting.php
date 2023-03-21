<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'company_name', 'company_code',
        'alert_msg',
        'address', 'mobile',
        'added_by', 'updated_by', 'is_active',
    ];

    public $translatable = ['company_name'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('global_setting')
            ->fit(Manipulations::FIT_CROP, 300)
            ->nonQueued();
    }


    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}