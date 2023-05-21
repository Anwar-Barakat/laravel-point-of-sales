<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\ServiceInvoice;
use Livewire\Component;

class ServiceInvoiceApproval extends Component
{
    public ServiceInvoice $invoice;

    public $total;

    protected $listeners = ['updateInvoiceServices'];

    public function updateOrderProducts(ServiceInvoice $invoice)
    {
        $this->invoice = $invoice;
        $this->remain_paid_price();
    }

    public function mount(ServiceInvoice $invoice)
    {
        $this->invoice = $invoice;
        $this->total = $this->invoice->cost_after_discount;
        $this->remain_paid_price();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedInvoiceInvoiceType()
    {
        $this->remain_paid_price();
    }

    public function updatedInvoiceTaxValue()
    {
        if ($this->invoice->tax_type == 0)
            $taxAmount = ($this->invoice->services_cost * floatval($this->invoice->tax_value)) / 100;
        else
            $taxAmount = floatval($this->invoice->tax_value);

        $this->invoice->cost_before_discount  = $this->invoice->services_cost + $taxAmount;
        $this->invoice->cost_after_discount   = $this->invoice->cost_before_discount;
        $this->remain_paid_price();
    }

    public function updatedInvoiceDiscountValue()
    {
        if (($this->invoice->discount_type == 1 && $this->invoice->discount_value > $this->invoice->cost_after_discount) ||
            ($this->invoice->discount_type == 0 && $this->invoice->discount_value >= 100)
        ) {
            $this->invoice->discount_value = 0;
            $this->invoice->cost_after_discount = $this->invoice->cost_before_discount;
            $this->invoice->paid = $this->invoice->cost_after_discount;

            toastr()->error($this->invoice->discount_type == 1
                ? __('validation.discount_less_grand_total')
                : __('validation.tax_type_is_percent'));
        }
        $discountAmount = $this->calculateDiscountAmount();

        $this->invoice->cost_after_discount = $this->invoice->cost_before_discount - $discountAmount;

        $this->remain_paid_price();
    }

    public function calculateDiscountAmount()
    {
        // Calculate the discount amount based on the discount type
        return $this->invoice->discount_type == 0
            ? ($this->invoice->services_cost * floatval($this->invoice->discount_value)) / 100
            : floatval($this->invoice->discount_value);
    }

    public function updatedInvoicePaid()
    {
        if ($this->invoice->invoice_type)
            $this->invoice->remains   = $this->invoice->cost_after_discount - $this->invoice->paid;
        else
            $this->remain_paid_price();
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.service-invoice-approval', ['invoice' => $this->invoice]);
    }

    public function rules()
    {
        return [
            'invoice.services_cost'             => ['required'],
            'invoice.tax_type'                  => ['nullable', 'boolean'],
            'invoice.tax_value'                 => ['nullable', 'numeric', function ($value) {
                if ($this->invoice->tax_type    == '0' && $this->invoice->tax_value  >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                    $this->invoice->tax_value = 0;
                }
            }],
            'invoice.cost_before_discount'      => ['required'],
            'invoice.discount_type'             => ['nullable', 'boolean'],
            'invoice.discount_value'            => ['nullable', 'numeric'],
            'invoice.cost_after_discount'       => ['required'],
            'invoice.invoice_type'              => ['required'],
            'invoice.paid'                      => ['required', 'numeric', function () {
                if ($this->invoice->paid > $this->invoice->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                    $this->invoice->paid = 0;
                }
            }],
            'invoice.remains'                   => ['required'],
        ];
    }

    private function remain_paid_price()
    {
        $this->invoice->paid      = $this->invoice->invoice_type == 0 ? $this->invoice->cost_after_discount : 0;
        $this->invoice->remains   = $this->invoice->invoice_type == 0 ? 0 :  $this->invoice->cost_after_discount;
    }
}
