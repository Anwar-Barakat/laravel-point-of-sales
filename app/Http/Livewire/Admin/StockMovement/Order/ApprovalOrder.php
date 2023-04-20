<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use Livewire\Component;

class ApprovalOrder extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order    = $order;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }


    public function updatedOrderTaxValue()
    {
        if ($this->order->tax_type == 0)
            $taxAmount = ($this->order->items_cost * floatval($this->order->tax_value)) / 100;
        else
            $taxAmount = floatval($this->order->tax_value);

        $this->order->cost_before_discount  = $this->order->items_cost + $taxAmount;
        $this->order->cost_after_discount   = $this->order->cost_before_discount;
    }

    public function updatedOrderDiscountValue()
    {
        if ($this->order->discount_type == 0)
            $disAmount = ($this->order->items_cost * floatval($this->order->discount_value)) / 100;
        else
            $disAmount = floatval($this->order->discount_value);

        $this->order->cost_after_discount   = $this->order->cost_before_discount - $disAmount;
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.approval-order');
    }

    public function rules()
    {
        return [
            'order.items_cost'              => ['required'],
            'order.tax_type'                => ['boolean'],
            'order.tax_value'               => ['numeric', function ($attribute, $value, $fail) {
                if ($this->order->tax_type  == '0' && $value >= 100) {
                    $fail(__('validation.tax_type_is_percent'));
                }
            }],
            'order.cost_before_discount'    => ['required'],
            'order.discount_type'           => ['boolean'],
            'order.discount_value'          => ['numeric', function ($attribute, $value, $fail) {
                if ($this->order->discount_type == '0' && $value >= 100) {
                    $fail(__('validation.discount_type_is_percent'));
                }
            }],
            'order.cost_after_discount'     => ['required'],
        ];
    }
}