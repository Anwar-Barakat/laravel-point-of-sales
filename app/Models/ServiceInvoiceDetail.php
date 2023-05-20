<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'service_invoice_id',
        'notes',
        'total',
        'company_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}