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

    public function render()
    {
        return view('livewire.admin.stock-movement.order.approval-order');
    }

    public function rules()
    {
        return [
            'order.items_cost'              => ['required'],
            'order.tax_type'                => ['boolean'],
            'order.tax_value'               => ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($this->order->tax_type  == '0' && $value >= 100) {
                    $fail($attribute . ' must be less than 100 when tax type is percentage.');
                }
            }],
            'order.cost_before_discount'    => ['required'],
            'order.discount_type'           => ['boolean'],
            'order.discount_value'          => ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($this->order->discount_type == '0' && $value >= 100) {
                    $fail($attribute . ' must be less than 100 when discount type is percentage.');
                }
            }],
            'order.cost_after_discount'     => ['required'],
        ];
    }
}