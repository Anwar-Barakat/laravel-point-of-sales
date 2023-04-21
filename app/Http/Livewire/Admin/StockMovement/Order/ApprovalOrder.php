<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use Livewire\Component;

class ApprovalOrder extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->remain_paid_price();
    }
    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedOrderInvoiceType()
    {
        $this->remain_paid_price();
    }

    public function updatedOrderTaxValue()
    {
        if ($this->order->tax_type == 0)
            $taxAmount = ($this->order->items_cost * floatval($this->order->tax_value)) / 100;
        else
            $taxAmount = floatval($this->order->tax_value);

        $this->order->cost_before_discount  = $this->order->items_cost + $taxAmount;
        $this->order->cost_after_discount   = $this->order->cost_before_discount;
        $this->remain_paid_price();
    }

    public function updatedOrderDiscountValue()
    {
        if ($this->order->discount_type == 0)
            $disAmount = ($this->order->items_cost * floatval($this->order->discount_value)) / 100;
        else
            $disAmount = floatval($this->order->discount_value);

        $this->order->cost_after_discount   = $this->order->cost_before_discount - $disAmount;
        $this->remain_paid_price();
    }

    public function updatedOrderWhatPaid()
    {
        if ($this->order->invoice_type) {
            $this->order->what_remain = $this->order->cost_after_discount - $this->order->what_paid;

            if ($this->order->what_paid > $this->order->cost_after_discount)
                $this->order->what_remain = 0;
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->remain_paid_price();
            $this->order->what_remain = $this->order->cost_after_discount - $this->order->what_paid;

            dd($this->order->what_paid);
        } catch (\Throwable $th) {
        }
    }

    private function remain_paid_price()
    {
        $this->order->what_paid     = $this->order->invoice_type == 0 ? $this->order->cost_after_discount : 0;
        $this->order->what_remain   = $this->order->invoice_type == 0 ? 0 :  $this->order->cost_after_discount;
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.approval-order');
    }
    public function rules()
    {
        return [
            'order.items_cost'              => ['required'],
            'order.tax_type'                => ['nullable', 'boolean'],
            'order.tax_value'               => ['nullable', 'numeric', function ($value, $fail) {
                if ($this->order->tax_type  == '0' && $value >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                }
            }],
            'order.cost_before_discount'    => ['required'],
            'order.discount_type'           => ['nullable', 'boolean'],
            'order.discount_value'          => ['nullable', 'numeric', function ($value, $fail) {
                if ($this->order->discount_type == '0' && $value >= 100) {
                    toastr()->error(__('validation.discount_type_is_percent'));
                }
            }],
            'order.cost_after_discount'     => ['required'],
            'order.invoice_type'            => ['required'],
            'order.what_paid'               => ['required', 'numeric', function () {
                if ($this->order->what_paid > $this->order->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                }
            }],
            'order.what_remain'             => ['required'],
        ];
    }
}