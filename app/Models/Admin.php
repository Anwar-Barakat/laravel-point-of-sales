<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'address',
        'bio',
        'company_id'
    ];

    protected $guard    = 'admin';
    protected $hidden   = ['password',];
    protected $casts    = ['email_verified_at' => 'datetime',];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('admin_avatar')
            ->fit(Manipulations::FIT_CROP, 300)
            ->nonQueued();
    }

    public function treasuries(): HasMany
    {
        return $this->hasMany(Treasury::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
