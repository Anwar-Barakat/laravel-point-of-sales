<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\ItemBatch;
use App\Models\ItemTransaction;
use App\Models\Sale;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SaleApproval extends Component
{
    public Sale $sale;

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->remain_paid_price();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedSaleInvoiceType()
    {
        $this->remain_paid_price();
    }

    public function updatedSaleTaxValue()
    {
        if ($this->sale->tax_type == 0)
            $taxAmount = ($this->sale->items_cost * floatval($this->sale->tax_value)) / 100;
        else
            $taxAmount = floatval($this->sale->tax_value);

        $this->sale->cost_before_discount  = $this->sale->items_cost + $taxAmount;
        $this->sale->cost_after_discount   = $this->sale->cost_before_discount;
        $this->remain_paid_price();
    }

    public function updatedSaleDiscountValue()
    {
        if (($this->sale->discount_type == 1 && $this->sale->discount_value > $this->sale->cost_after_discount) ||
            ($this->sale->discount_type == 0 && $this->sale->discount_value >= 100)
        ) {
            $this->sale->discount_value = 0;
            $this->sale->cost_after_discount = $this->sale->cost_before_discount;
            $this->sale->paid = $this->sale->cost_after_discount;

            toastr()->error($this->sale->discount_type == 1
                ? __('validation.discount_less_grand_total')
                : __('validation.tax_type_is_percent'));
        }

        $discountAmount = $this->calculateDiscountAmount();
        $this->sale->cost_after_discount = $this->sale->cost_before_discount - $discountAmount;
        $this->remain_paid_price();
    }

    public function calculateDiscountAmount()
    {
        // Calculate the discount amount based on the discount type
        return $this->sale->discount_type == 0
            ? (floatval($this->sale->items_cost) * floatval($this->sale->discount_value)) / 100
            : floatval($this->sale->discount_value);
    }

    public function updatedSalePaid()
    {
        if ($this->sale->invoice_type == 1)
            $this->sale->remains   = $this->sale->cost_after_discount - $this->sale->paid;
        else
            $this->remain_paid_price();
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->sale->is_approved == 0) {
                $this->remain_paid_price();
                $this->sale->remains = $this->sale->cost_after_discount - $this->sale->paid;

                if ($this->sale->invoice_type == 0)
                    $this->sale->paid = $this->sale->cost_after_discount;

                if (!has_open_shift()) {
                    toastr()->error(__('account.dont_have_open_shift'));
                    return redirect()->route('admin.shifts.create');
                }

                DB::beginTransaction();

                //________________________________________________
                // 1- Monetary Transaction
                //________________________________________________
                TreasuryTransaction::create([
                    'shift_type_id'     => ShiftType::findOrFail(5)->id, // Collection of sales revenue
                    'shift_id'          => has_open_shift()->id,
                    'admin_id'          => get_auth_id(),
                    'treasury_id'       => has_open_shift()->treasury->id,
                    'sale_id'           => $this->sale->id,
                    'account_id'        => $this->sale->customer_id,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'transaction_date'  => date('Y-m-d'),
                    'payment'           => has_open_shift()->last_payment_collect + 1,
                    'money'             => $this->sale->paid,
                    'money_for_account' => floatval(-$this->sale->paid), // العميل
                    'report'            => 'Collecting a sales invoice from the customer name(' . $this->sale->customer->name . ') of the owner of the number #' . $this->sale->customer->id,
                    'company_code'      => get_auth_com(),
                ]);

                //________________________________________________
                // 2- Approving the sale
                //________________________________________________
                $this->sale->treasury_id               = has_open_shift()->treasury->id;
                $this->sale->is_approved               = 1;
                $this->sale->approved_by               = get_auth_id();
                $this->sale->money_for_account         = $this->sale->cost_after_discount; // العميل مدين بالمبلغ كاملاً
                $this->sale->treasury_transaction_id   = TreasuryTransaction::latest()->first()->id;
                $this->sale->company_code              = get_auth_com();
                $this->sale->save();

                //________________________________________________
                // 3- Increment last payment collect for treasury
                //________________________________________________
                has_open_shift()->treasury->increment('last_payment_collect');


                //________________________________________________
                // 4- Update the customer account balance
                //________________________________________________
                update_account_balance($this->sale->customer->account);

                //________________________________________________
                // 5- Transaction on store
                //________________________________________________
                $this->sale->saleProducts->map(function ($prod) {
                    $ratio                  = $prod->item->retail_count_for_wholesale;
                    $qty_before_transaction = item_batch_qty($prod->item);
                    $store_qty_before_trans = item_batch_qty($prod->item, $this->sale->store_id);

                    if ($prod->unit->status == 'retail') {
                        $quantity   = $prod->qty / $ratio;
                        $unit_price = $prod->unit_price * $ratio;
                    } else {
                        $quantity   = $prod->qty;
                        $unit_price = $prod->unit_price;
                    }

                    if ($prod->item->type == 2) {
                        $data['production_date']   = $prod->production_date;
                        $data['expiration_date']   = $prod->expiration_date;
                    }

                    $batch = ItemBatch::find($prod->item_batch_id);
                    $batch->update([
                        'qty'           => $batch->qty - $quantity,
                        'total_price'   => $batch->unit_price * ($batch->qty - $quantity)
                    ]);

                    //________________________________________________
                    // 6- Any transaction on item it must be stored
                    //________________________________________________
                    $qty_after_transaction = item_batch_qty($prod->item);
                    $store_qty_after_trans = item_batch_qty($prod->item, $this->sale->store_id);
                    ItemTransaction::create([
                        'item_transaction_category_id'  => 2,   // Transaction on sales
                        'item_transaction_type_id'      => 4,   //sales
                        'item_id'                       => $prod->item_id,
                        'sale_id'                       => $this->sale->id,
                        'store_id'                      => $prod->store_id,
                        'sale_product_id'               => $prod->id,
                        'report'                        => 'Sales peer for the customer ' . $this->sale->customer->name . ' for the invoice number #' . $this->sale->id,
                        'store_qty_before_transaction'  => $store_qty_before_trans . ' ' . $prod->item->parentUnit->name,
                        'store_qty_after_transaction'   => $store_qty_after_trans . ' ' . $prod->item->parentUnit->name,
                        'qty_before_transaction'        => $qty_before_transaction . ' ' . $prod->item->parentUnit->name,
                        'qty_after_transaction'         => $qty_after_transaction . ' ' . $prod->item->parentUnit->name,
                        'added_by'                      => get_auth_id(),
                        'company_code'                  => get_auth_com(),
                    ]);

                    //________________________________________________
                    // 7- Update Item qty & prices in items table
                    //________________________________________________
                    $prod->item->wholesale_cost_price   = $unit_price;
                    $prod->item->retail_cost_price      = $prod->item->has_retail_unit ? $unit_price / $ratio : null;
                    update_item_qty($prod->item);
                    $prod->item->save();
                });

                DB::commit();
                toastr()->success(__('msgs.approved', ['name' => __('movement.sale_invoice')]));
                return redirect()->route('admin.sales.index');
            } else
                toastr()->error(__('movement.already_approved'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.sales.show', ['sale' => $this->sale])->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.sale.sale-approval');
    }

    public function rules()
    {
        return [
            'sale.items_cost'              => ['required'],
            'sale.tax_type'                => ['nullable', 'boolean'],
            'sale.tax_value'               => ['nullable', 'numeric', function ($value) {
                if ($this->sale->tax_type  == '0' && $this->sale->tax_value  >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                    $this->sale->tax_value = 0;
                }
            }],
            'sale.cost_before_discount'    => ['required'],
            'sale.discount_type'           => ['nullable', 'boolean'],
            'sale.discount_value'          => ['nullable', 'numeric'],
            'sale.cost_after_discount'     => ['required'],
            'sale.invoice_type'            => ['required'],
            'sale.paid'               => ['required', 'numeric', function () {
                if ($this->sale->paid > $this->sale->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                    $this->sale->paid = 0;
                }
            }],
            'sale.remains'             => ['required'],
        ];
    }

    private function remain_paid_price()
    {
        $this->sale->paid       = $this->sale->invoice_type == 0 ? $this->sale->cost_after_discount : 0;
        $this->sale->remains    = $this->sale->invoice_type == 0 ? 0 :  $this->sale->cost_after_discount;
    }
}