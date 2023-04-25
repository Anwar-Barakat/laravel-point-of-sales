<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\ItemBatch;
use App\Models\Order;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PDO;

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
        if (($this->order->discount_type == 1 && $this->order->discount_value > $this->order->cost_after_discount) ||
            ($this->order->discount_type == 0 && $this->order->discount_value >= 100)
        ) {
            $this->order->discount_value = 0;
            $this->order->cost_after_discount = $this->order->cost_before_discount;
            $this->order->paid = $this->order->cost_after_discount;

            toastr()->error($this->order->discount_type == 1
                ? __('validation.discount_less_grand_total')
                : __('validation.tax_type_is_percent'));
        }
        $discountAmount = $this->calculateDiscountAmount();

        $this->order->cost_after_discount = $this->order->cost_before_discount - $discountAmount;

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
            $this->order->remains   = $this->order->cost_after_discount - $this->order->paid;

            if ($this->order->paid > $this->order->cost_after_discount)
                $this->order->remains = 0;
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->order->is_approved == 0) {
                $this->remain_paid_price();
                $this->order->remains = $this->order->cost_after_discount - $this->order->paid;

                if ($this->order->invoice_type == 0) {
                    $this->order->paid = $this->order->cost_after_discount;
                }

                if (!has_open_shift()) {
                    toastr()->error(__('account.dont_have_open_shift'));
                    return redirect()->route('admin.shifts.create');
                }
                if (get_treasury_balance() < $this->order->paid) {
                    toastr()->error(__('account.not_enough_balance'));
                    return false;
                }

                DB::beginTransaction();

                // 1- monetary movement :
                TreasuryTransaction::create([
                    'shift_type_id'     => ShiftType::findOrFail(8)->id, // Disbursement for an invoice for purchases from a supplier
                    'shift_id'          => has_open_shift()->id,
                    'admin_id'          => get_auth_id(),
                    'treasury_id'       => has_open_shift()->treasury->id,
                    'order_id'          => $this->order->id,
                    'account_id'        => $this->order->vendor_id,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'transaction_date'  => date('Y-m-d'),
                    'payment'           => has_open_shift()->last_payment_exchange + 1,
                    'money'             => floatval(-$this->order->paid),
                    'money_for_account' => $this->order->paid,
                    'report'            => 'Disbursement for a purchase invoice from the vendor of the number holder #' . get_auth_id(),
                    'company_code'      => get_auth_com(),
                ]);

                has_open_shift()->treasury->increment('last_payment_collect');

                $this->order->treasury_id               = has_open_shift()->treasury->id;
                // $this->order->is_approved               = 1;
                $this->order->approved_by               = get_auth_id();
                $this->order->money_for_account         = floatval(-$this->order->cost_after_discount);
                $this->order->treasury_transaction_id   = TreasuryTransaction::latest()->first()->id;
                $this->order->company_code              = get_auth_com();
                $this->order->save();

                has_open_shift()->treasury->increment('last_payment_exchange');

                // 2- store movement :
                $this->order->orderProducts->map(function ($prod) {
                    if ($prod->unit->status == 'retail') {
                        $quantity   = $prod->qty / $prod->item->retail_count_for_wholesale;
                        $unit_price = $prod->unit_price * $prod->item->retail_count_for_wholesale;
                    } else {
                        $quantity   = $prod->qty;
                        $unit_price = $prod->unit_price;
                    }

                    $data = [
                        'item_id'           => $prod->item->id, // unit and prices
                        'store_id'          => $this->order->store->id,
                        'unit_id'           => $prod->item->parentUnit->id,
                        'unit_price'        => $unit_price,
                        'company_code'      => get_auth_com(),
                    ];
                    if ($prod->item->type == 2) {
                        $data['production_date']   = $prod->production_date;
                        $data['expiration_date']   = $prod->expiration_date;
                    }

                    $batchExists = ItemBatch::where([
                        'item_id'           => $prod->item->id,
                        'store_id'          => $this->order->store->id,
                        'unit_price'        => $unit_price,
                    ])->first();
                    if (isset($batchExists)) {
                        $batchExists->update([
                            'qty'           => $quantity + $batchExists->qty,
                            'total_price'   => $batchExists->unit_price * ($quantity + $batchExists->qty)
                        ]);
                    } else {
                        $data['added_by']       = get_auth_id();
                        $data['qty']            = $quantity;
                        $data['total_price']    = $unit_price * $quantity;
                        ItemBatch::create($data);
                    }
                });



                DB::commit();
                toastr()->success(__('msgs.approved', ['name' => __('movement.order')]));
            } else
                toastr()->error(__('movement.already_approved'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.orders.show', ['order' => $this->order])->with(['error' => $th->getMessage()]);
        }
    }

    private function remain_paid_price()
    {
        $this->order->paid     = $this->order->invoice_type == 0 ? $this->order->cost_after_discount : 0;
        $this->order->remains   = $this->order->invoice_type == 0 ? 0 :  $this->order->cost_after_discount;
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
            'order.paid'               => ['required', 'numeric', function () {
                if ($this->order->paid > $this->order->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                }
            }],
            'order.remains'             => ['required'],
        ];
    }
}