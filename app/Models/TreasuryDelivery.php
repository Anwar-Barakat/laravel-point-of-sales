<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'treasury_id',
        'treasury_delivery_id',
        'added_by',
        'updated_by',
    ];

    protected $casts        = ['created_at' => 'date:Y-m-d',];

    public function treasury()
    {
        return $this->belongsTo(Treasury::class, 'treasury_id');
    }

    public function treasuryDelivered()
    {
        return $this->belongsTo(Treasury::class, 'treasury_delivery_id');
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
