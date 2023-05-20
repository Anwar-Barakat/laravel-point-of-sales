<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\Service;
use App\Models\ServiceInvoice;
use App\Models\ServiceInvoiceDetail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceInvoiceDetailComponent extends Component
{
    use WithPagination;

    public ServiceInvoice $invoice;
    public ServiceInvoiceDetail $service;

    public $services = [], $item;

    public $consuming = false;

    protected $listeners = ['updateOrderProducts'];

    public function updateOrderProducts(ServiceInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function mount(ServiceInvoice $invoice, ServiceInvoiceDetail $service)
    {
        $this->invoice                  = $invoice;
        $this->service                  = $service;
        $this->invoice->invoice_date    = date('Y-m-d');
        $this->invoice->is_approved     == 0 ?  $this->services = Service::select('id', 'name')->where('type', $this->invoice->service_type)->active()->get() : [];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->order->is_approved == 0) {

                $this->service->save();

                $this->emit('updateOrderProducts', ['order' => $this->order]);
                toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
                $this->reset('product.item_id');
            }
        } catch (\Throwable $th) {
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.service-invoice-detail-component', ['serviceInvoiceDetails' => $this->getServiceInvoiceDetails()]);
    }

    public function rules(): array
    {
        return [
            'service.service_id'           => [
                'required',
                Rule::unique('service_invoice_details', 'service_id')->ignore($this->service->id)
            ],
            'service.total_price'       => ['required'],
            'service.notes'             => ['required', 'min:10'],
        ];
    }

    public function getServiceInvoiceDetails()
    {
        return ServiceInvoiceDetail::where('service_invoice_id', $this->invoice->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }
}
