<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use Livewire\Component;

class ApprovalOrder extends Component
{
    public Order $order;

    public $total;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->total = $this->order->cost_after_discount;
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
        // Check the discount type and value
        if (($this->order->discount_type == 1 && $this->order->discount_value > $this->order->cost_after_discount) ||
            ($this->order->discount_type == 0 && $this->order->discount_value >= 100)
        ) {
            // Reset the discount value and update the cost after discount
            $this->order->discount_value = 0;
            $this->order->cost_after_discount = $this->order->cost_before_discount;
            $this->order->what_paid = $this->order->cost_after_discount;

            toastr()->error($this->order->discount_type == 1
                ? __('validation.discount_less_grand_total')
                : __('validation.tax_type_is_percent'));
        }
        // Calculate the discount amount
        $discountAmount = $this->calculateDiscountAmount();

        // Update the cost after discount
        $this->order->cost_after_discount = $this->order->cost_before_discount - $discountAmount;

        // Update the remaining paid price
        $this->remain_paid_price();
    }

    public function calculateDiscountAmount()
    {
        // Calculate the discount amount based on the discount type
        return $this->order->discount_type == 0
            ? ($this->order->items_cost * floatval($this->order->discount_value)) / 100
            : floatval($this->order->discount_value);
    }


    public function updatedOrderWhatPaid()
    {
        if ($this->order->invoice_type) {
            $this->order->what_remain   = $this->order->cost_after_discount - $this->order->what_paid;

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
            'order.tax_value'               => ['nullable', 'numeric', function ($value) {
                if ($this->order->tax_type  == '0' && $value >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                }
            }],
            'order.cost_before_discount'    => ['required'],
            'order.discount_type'           => ['nullable', 'boolean'],
            'order.discount_value'          => ['nullable', 'numeric'],
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
