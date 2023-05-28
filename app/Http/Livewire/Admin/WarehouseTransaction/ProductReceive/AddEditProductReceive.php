<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductReceive;

use App\Models\ProductionLine;
use App\Models\ProductRecieve;
use App\Models\Store;
use App\Models\Workshop;
use Livewire\Component;

class AddEditProductReceive extends Component
{
    public ProductRecieve $invoice;

    public $production_lines    = [],
        $stores       = [],
        $workshops       = [];

    public function mount(ProductRecieve $invoice)
    {
        $this->invoice                  = $invoice;
        $this->invoice->invoice_date    = date('Y-m-d');
        $this->stores                   = Store::select('id', 'name')->active()->get();
        $this->production_lines         = ProductionLine::select('id', 'plan')->closed()->get();
        $this->workshops                = Workshop::active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->invoice->invoice_type    = 1;
            $this->invoice->added_by        = get_auth_id();
            $this->invoice->company_id      = get_auth_com();
            $this->invoice->save();

            toastr()->success(__('msgs.submitted', ['name' => __('transaction.service_invoice')]));
            return redirect()->route('admin.products-receive.show', ['products_receive' => $this->invoice]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.products-receive.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.product-receive.add-edit-product-receive');
    }


    public function rules(): array
    {
        return [
            'invoice.production_line_id'    => ['required', 'integer'],
            'invoice.workshop_id'           => ['required', 'integer'],
            'invoice.store_id'              => ['required', 'integer'],
            'invoice.invoice_date'          => ['required', 'date'],
            'invoice.notes'                 => ['required', 'min:10'],
        ];
    }
}
