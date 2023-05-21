<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\Service;
use App\Models\ServiceInvoice;
use App\Models\ServiceInvoiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceInvoiceDetailComponent extends Component
{
    use WithPagination;

    public ServiceInvoice $invoice;

    public ServiceInvoiceDetail $service;

    public $services = [];

    protected $listeners = ['updateInvoiceServices'];

    public function updateInvoiceServices(ServiceInvoice $invoice)
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
            if ($this->invoice->is_approved == 0) {
                DB::beginTransaction();

                $this->service->fill([
                    'service_invoice_id'    => $this->invoice->id,
                    'added_by'              => get_auth_id(),
                    'company_id'            => get_auth_com(),
                ])->save();

                $totalPrices = ServiceInvoiceDetail::where('service_invoice_id', $this->invoice->id)->where('company_id', get_auth_com())->sum('total');
                $this->invoice->fill([
                    'services_cost'         => $totalPrices,
                    'cost_before_discount'  => $totalPrices,
                    'cost_after_discount'   => $totalPrices,
                ])->save();

                DB::commit();
                $this->emit('updateInvoiceServices', ['invoice' => $this->invoice]);
                toastr()->success(__('msgs.added', ['name' => __('setting.service')]));
                $this->reset('service');
            }
        } catch (\Throwable $th) {
            return redirect()->route('admin.services-invoices.show', ['services_invoice' => $this->invoice])->with(['error' => $th->getMessage()]);
        }
    }

    public function edit(ServiceInvoiceDetail $service)
    {
        $this->service = $service;
    }

    public function delete(ServiceInvoiceDetail $service)
    {
        $service->delete();
        $totalPrices = ServiceInvoiceDetail::where('service_invoice_id', $this->invoice->id)->where('company_id', get_auth_com())->sum('total');
        $this->invoice->fill([
            'services_cost'         => $totalPrices,
            'cost_before_discount'  => $totalPrices,
            'cost_after_discount'   => $totalPrices,
        ])->save();


        $service->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('setting.service')]));
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.service-invoice-detail-component', [
            'details' => $this->getServiceInvoiceDetails()
        ]);
    }

    public function rules(): array
    {
        return [
            'service.service_id'           => [
                'required',
                Rule::unique('service_invoice_details', 'service_id')->ignore($this->service->id)
            ],
            'service.total'             => ['required', 'numeric', 'between:1,9999'],
            'service.notes'             => ['required', 'min:10'],
        ];
    }

    public function getServiceInvoiceDetails()
    {
        return ServiceInvoiceDetail::where('service_invoice_id', $this->invoice->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }
}
