<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'name',
        'alert_msg',
        'address',
        'mobile',
        'is_active',
        'admin_id',
        'parent_customer_id',
        'parent_vendor_id',
        'parent_delegate_id',
    ];

    public $translatable    = ['name'];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('company_logo')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function parentVendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'parent_vendor_id');
    }

    public function parentCustomer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'parent_customer_id');
    }

    public function parentDelegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class, 'parent_delegate_id');
    }
}
