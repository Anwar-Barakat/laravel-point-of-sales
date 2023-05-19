<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    const INVOICETYPE   = [0 => 'cash', 1 => 'delayed'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
