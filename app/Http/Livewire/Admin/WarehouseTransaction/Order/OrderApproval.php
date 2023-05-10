<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\ItemTransaction;
use App\Models\Order;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderApproval extends Component
{
    public Order $order;

    public $total;

    protected $listeners = ['updateOrderProducts'];

    public function updateOrderProducts(Order $order)
    {
        $this->order = $order;
        $this->remain_paid_price();
    }

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

    public function updatedOrderPaid()
    {
        if ($this->order->invoice_type)
            $this->order->remains   = $this->order->cost_after_discount - $this->order->paid;
        else
            $this->remain_paid_price();
    }

    public function submit()
    {
        $this->validate();
        try {
            if (!$this->order->is_approved == 0) {
                toastr()->error(__('transaction.already_approved'));
                return redirect()->back();
            }

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
                $this->order->paid = 0;
            }

            DB::beginTransaction();

            //________________________________________________
            // 1- Monetary Transaction
            //________________________________________________

            if ($this->order->type == 1) :
                $shift_type = ShiftType::findOrFail(8)->id; // Disbursement for an invoice for purchases from a vendor
                $payment    = has_open_shift()->last_payment_exchange + 1;
                $money      = floatval(-$this->order->paid);
                $report     = 'Disbursement for a purchase invoice from the vendor of the number holder #' . $this->order->vendor->id;
                $name       = __('transaction.purchase_bill');
            elseif ($this->order->type == 3) :

                $shift_type = ShiftType::findOrFail(9)->id; // Collection of a return counterpart purchased to a vendor
                $payment    = has_open_shift()->last_payment_collect + 1;
                $money      = $this->order->paid;
                $report     = 'Collection of a return counterpart purchased to a vendor of the number holder #' . $this->order->vendor->id;
                $name       = __('transaction.general_order_return');
            endif;

            TreasuryTransaction::create([
                'shift_type_id'     => $shift_type,
                'shift_id'          => has_open_shift()->id,
                'admin_id'          => get_auth_id(),
                'treasury_id'       => has_open_shift()->treasury->id,
                'order_id'          => $this->order->id,
                'account_id'        => $this->order->account_id,
                'is_approved'       => 1,
                'is_account'        => 1,
                'transaction_date'  => date('Y-m-d'),
                'payment'           => $payment,
                'money'             => $money,
                'money_for_account' => floatval(-$money),
                'report'            => $report,
                'company_id'        => get_auth_com(),
            ]);


            //________________________________________________
            // 2- Approving the order
            //________________________________________________
            if ($this->order->type == 1) :
                $money_for_account = floatval(-$this->order->cost_after_discount);

                //________________________________________________
                // 3- Increment last payment exchange for treasury
                //________________________________________________
                has_open_shift()->treasury->increment('last_payment_exchange');
            elseif ($this->order->type == 3) :
                $money_for_account = $this->order->cost_after_discount;

                //________________________________________________
                // 3- Increment last payment collect for treasury
                //________________________________________________
                has_open_shift()->treasury->increment('last_payment_collect');
            endif;

            $this->order->treasury_id               = has_open_shift()->treasury->id;
            $this->order->is_approved               = 1;
            $this->order->approved_by               = get_auth_id();
            $this->order->money_for_account         = $money_for_account;
            $this->order->treasury_transaction_id   = TreasuryTransaction::latest()->first()->id;
            $this->order->company_id                = get_auth_com();
            $this->order->save();


            //________________________________________________
            // 4- Update the vendor account balance
            //________________________________________________
            update_account_balance($this->order->account);


            //________________________________________________
            // 5- Transaction on store
            //________________________________________________
            $this->order->orderProducts->map(function ($prod) {
                $qty_before_transaction = item_batch_qty($prod->item);
                $store_qty_before_trans = item_batch_qty($prod->item, $this->order->store_id);

                if ($prod->unit->status == 'retail') {
                    $quantity   = $prod->qty / $prod->item->retail_count_for_wholesale;
                    $unit_price = $prod->unit_price * $prod->item->retail_count_for_wholesale;
                } else {
                    $quantity   = $prod->qty;
                    $unit_price = $prod->unit_price;
                }

                $data = [
                    'item_id'           => $prod->item->id,
                    'store_id'          => $this->order->store->id,
                    'unit_id'           => $prod->item->parentUnit->id,
                    'unit_price'        => $unit_price,
                    'company_id'        => get_auth_com(),
                ];
                if ($prod->item->type == 2) {
                    $data['production_date']   = $prod->production_date;
                    $data['expiration_date']   = $prod->expiration_date;
                }

                $batchExists = ItemBatch::where($data)->first();

                if (isset($batchExists)) {
                    if ($this->order->type == 1) :
                        $batch_qty  = $batchExists->qty + $quantity;
                    elseif ($this->order->type == 3) :
                        $batch_qty  = $batchExists->qty - $quantity;
                    endif;

                    $batchExists->update([
                        'qty'           => $batch_qty,
                        'total_price'   => $batchExists->unit_price * ($batch_qty)
                    ]);
                } else {
                    $data['added_by']       = get_auth_id();
                    $data['qty']            = $quantity;
                    $data['total_price']    = $unit_price * $quantity;
                    ItemBatch::create($data);
                }


                //________________________________________________
                // 6- Any transaction on item it must be stored
                //________________________________________________

                if ($this->order->type == 1) :
                    $item_trans_report      = 'For purchases from the vendor ' . $this->order->vendor->name . ' for the invoice number #' . $this->order->id;
                    $item_transaction_type  = 1; //purchases
                elseif ($this->order->type == 3) :
                    $item_trans_report      = 'For general order return to the vendor ' . $this->order->vendor->name . ' for the invoice number #' . $this->order->id;
                    $item_transaction_type  = 3; //General Purchase Returns
                endif;

                $qty_after_transaction = item_batch_qty($prod->item);
                $store_qty_after_trans = item_batch_qty($prod->item, $this->order->store_id);
                ItemTransaction::create([
                    'item_transaction_category_id'  => 1,   // Transaction on purchases
                    'item_transaction_type_id'      => $item_transaction_type,
                    'item_id'                       => $prod->item_id,
                    'order_id'                      => $this->order->id,
                    'store_id'                      => $this->order->store_id,
                    'order_product_id'              => $prod->id,
                    'report'                        => $item_trans_report,
                    'store_qty_before_transaction'  => $store_qty_before_trans . ' ' . $prod->item->parentUnit->name,
                    'store_qty_after_transaction'   => $store_qty_after_trans . ' ' . $prod->item->parentUnit->name,
                    'qty_before_transaction'        => $qty_before_transaction . ' ' . $prod->item->parentUnit->name,
                    'qty_after_transaction'         => $qty_after_transaction . ' ' . $prod->item->parentUnit->name,
                    'added_by'                      => get_auth_id(),
                    'company_id'                    => get_auth_com(),
                ]);

                //________________________________________________
                // 7- Update Item qty & prices in items table
                //________________________________________________
                $prod->item->wholesale_cost_price   = $unit_price;

                $prod->item->retail_cost_price      = $prod->item->has_retail_unit ? $unit_price / $prod->item->retail_count_for_wholesale : null;
                update_item_qty($prod->item);
                $prod->item->save();
            });

            DB::commit();
            toastr()->success(__('msgs.approved', ['name' => $name]));
            $this->emit('updateOrderProducts', ['order' => $this->order]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.orders.show', ['order' => $this->order])->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.order-approval', ['order' => $this->order]);
    }

    public function rules()
    {
        return [
            'order.items_cost'              => ['required'],
            'order.tax_type'                => ['nullable', 'boolean'],
            'order.tax_value'               => ['nullable', 'numeric', function ($value) {
                if ($this->order->tax_type  == '0' && $this->order->tax_value  >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                    $this->order->tax_value = 0;
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
                    $this->order->paid = 0;
                }
            }],
            'order.remains'             => ['required'],
        ];
    }

    private function remain_paid_price()
    {
        $this->order->paid      = $this->order->invoice_type == 0 ? $this->order->cost_after_discount : 0;
        $this->order->remains   = $this->order->invoice_type == 0 ? 0 :  $this->order->cost_after_discount;
    }
}
