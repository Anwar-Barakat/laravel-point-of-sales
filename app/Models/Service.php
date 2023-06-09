<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'type',
        'is_active',
        'company_id',
    ];

    public $translatable    = ['name'];

    const SERTICETYPE = [0 => 'internal_services', 1 => 'external_services'];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', $term);
        });
    }

    public function scopeActive($query)
    {
        return $query->where(['is_active' => 1, 'company_id' => get_auth_com()]);
    }
}
