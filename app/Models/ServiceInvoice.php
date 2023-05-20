<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    const INVOICETYPE   = [0 => 'cash', 1 => 'delayed'];
    const SERTICETYPE   = [0 => 'internal_services', 1 => 'external_services'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function serviceInvoiceDetails()
    {
        return $this->hasMany(ServiceInvoiceDetail::class);
    }
}
