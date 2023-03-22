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
        'last_payment_receipt',
        'last_payment_collect',
        'added_by',
        'updated_by',
        'company_code',
        'date',
        'is_active',
    ];

    public $translatable = ['name'];


    protected $casts = [
        'created_at'    => 'date:Y-m-d h:i',
    ];

    public function isMaster(): Attribute
    {
        $isMaster = $this->attributes['is_master'];
        return new Attribute(fn (string $value) => $isMaster ? __('treasury.master') : __('treasury.branch'));
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
