<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\WorkshopInvoice;

use App\Models\Store;
use App\Models\WorkshopInvoice;
use Livewire\Component;

class AddEditWorkshopInvoice extends Component
{
    public function render()
    {
        return view('livewire.admin.warehouse-transaction.workshop-invoice.add-edit-workshop-invoice');
    }
}
