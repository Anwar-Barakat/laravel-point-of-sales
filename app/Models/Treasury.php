<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Treasury extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'is_master',
        'is_active',
        'last_payment_receipt',
        'last_payment_collect',
        'added_by',
        'updated_by',
        'company_code',
        'date',
    ];

    public $translatable = ['name'];


    protected $casts = [
        'created_at'    => 'date:Y-m-d h:i',
    ];

    protected function isMaster(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['is_master'] ? __('treasury.master') : __('treasury.branch'),
        );
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['is_active'] ? __('treasury.active') : __('treasury.not_active'),
        );
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
