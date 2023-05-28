<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductReceive;

use App\Models\ItemBatch;
use App\Models\ItemTransaction;
use App\Models\ProductReceive;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductReceiveApproval extends Component
{
    public ProductReceive $invoice;

    public $total;

    protected $listeners = ['updateProductsReceiveDetail'];

    public function updateProductsReceiveDetail(ProductReceive $invoice)
    {
        $this->invoice = $invoice;
        $this->remain_paid_price();
    }

    public function mount(ProductReceive $invoice)
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
        $taxAmount                              = get_tax_value($this->invoice);
        $this->invoice->cost_before_discount    = $this->invoice->items_cost + $taxAmount;
        $this->invoice->cost_after_discount     = $this->invoice->cost_before_discount;
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
        $discountAmount = get_discount_value($this->invoice);
        $this->invoice->cost_after_discount = $this->invoice->cost_before_discount - $discountAmount;
        $this->remain_paid_price();
    }

    public function updatedInvoicePaid()
    {
        if ($this->invoice->invoice_type)
            $this->invoice->remains   = $this->invoice->cost_after_discount - $this->invoice->paid;
        else
            $this->remain_paid_price();
    }

    public function submit()
    {
        $this->validate();
        try {
            if (!$this->invoice->is_approved == 0) {
                toastr()->error(__('transaction.already_approved'));
                return redirect()->back();
            }

            if (!has_open_shift()) {
                toastr()->error(__('account.dont_have_open_shift'));
                return redirect()->route('admin.shifts.create');
            }

            DB::beginTransaction();

            //________________________________________________
            // 1- Monetary Transaction
            //________________________________________________
            $report     = "Disbursement for a products receive from production line ({$this->invoice->production_line->plan}) of the number holder ({$this->invoice->production_line->id})";
            TreasuryTransaction::create([
                'shift_type_id'         => ShiftType::findOrFail(20)->id,
                'shift_id'              => has_open_shift()->id,
                'admin_id'              => get_auth_id(),
                'treasury_id'           => has_open_shift()->treasury->id,
                'product_receive_id'    => $this->invoice->id,
                'account_id'            => 1,
                'is_approved'           => 1,
                'is_account'            => 1,
                'transaction_date'      => date('Y-m-d'),
                'payment'               => has_open_shift()->last_payment_exchange + 1,
                'money'                 => floatval(-$this->invoice->paid),
                'money_for_account'     => $this->invoice->paid,
                'report'                => $report,
                'company_id'            => get_auth_com(),
            ]);


            //________________________________________________
            // 2- Approving the product receive
            //________________________________________________
            $this->invoice->treasury_id               = has_open_shift()->treasury->id;
            $this->invoice->is_approved               = 1;
            $this->invoice->approved_by               = get_auth_id();
            $this->invoice->money_for_account         = floatval(-$this->invoice->cost_after_discount);
            $this->invoice->treasury_transaction_id   = TreasuryTransaction::latest()->first()->id;
            $this->invoice->company_id                = get_auth_com();
            $this->invoice->save();


            //________________________________________________
            // 3- Increment last payment exchange for treasury
            //________________________________________________
            has_open_shift()->treasury->increment('last_payment_exchange');


            //________________________________________________
            // 4- Update the vendor account balance
            //________________________________________________
            // update_account_balance($this->invoice->account);


            //________________________________________________
            // 5- Transaction on store
            //________________________________________________
            $this->invoice->productsReceiveDetail->map(function ($prod) {
                $qty_before_transaction = item_batch_qty($prod->item);
                $store_qty_before_trans = item_batch_qty($prod->item, $this->invoice->store_id);

                if ($prod->unit->status == 'retail') {
                    $quantity   = $prod->qty / $prod->item->retail_count_for_wholesale;
                    $unit_price = $prod->unit_price * $prod->item->retail_count_for_wholesale;
                } else {
                    $quantity   = $prod->qty;
                    $unit_price = $prod->unit_price;
                }

                $data = [
                    'item_id'           => $prod->item->id,
                    'store_id'          => $this->invoice->store->id,
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
                    $batchExists->update([
                        'qty'           => $batchExists->qty + $quantity,
                        'total_price'   => $batchExists->unit_price * ($batchExists->qty + $quantity)
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
                $item_trans_report      = "For products recieve from the production line  ({$this->invoice->production_line->plan})  for the invoice number # {$this->invoice->id}";
                $item_transaction_type  = 1; //purchases

                $qty_after_transaction = item_batch_qty($prod->item);
                $store_qty_after_trans = item_batch_qty($prod->item, $this->invoice->store_id);
                ItemTransaction::create([
                    'item_transaction_category_id'  => 3,   // Transaction on stores
                    'item_transaction_type_id'      => $item_transaction_type,
                    'item_id'                       => $prod->item_id,
                    'product_receive_id'            => $this->invoice->id,
                    'product_receive_detail_id'     => $prod->id,
                    'store_id'                      => $this->invoice->store_id,
                    'report'                        => $item_trans_report,
                    'store_qty_before_transaction'  => $store_qty_before_trans  . ' ' .  $prod->item->parentUnit->name,
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
            toastr()->success(__('msgs.approved', ['name' => __('transaction.product_receive')]));
            $this->emit('updateProductsReceiveDetail', ['invoice' => $this->invoice]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.products-receive.show', ['products_receive' => $this->invoice])->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.product-receive.product-receive-approval', ['invoice' => $this->invoice]);
    }

    public function rules()
    {
        return [
            'invoice.items_cost'              => ['required'],
            'invoice.tax_type'                => ['nullable', 'boolean'],
            'invoice.tax_value'               => ['nullable', 'numeric', function ($value) {
                if ($this->invoice->tax_type  == '0' && $this->invoice->tax_value  >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                    $this->invoice->tax_value = 0;
                }
            }],
            'invoice.cost_before_discount'    => ['required'],
            'invoice.discount_type'           => ['nullable', 'boolean'],
            'invoice.discount_value'          => ['nullable', 'numeric'],
            'invoice.cost_after_discount'     => ['required'],
            'invoice.invoice_type'            => ['required'],
            'invoice.paid'               => ['required', 'numeric', function () {
                if ($this->invoice->paid > $this->invoice->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                    $this->invoice->paid = 0;
                }
            }],
            'invoice.remains'             => ['required'],
        ];
    }

    private function remain_paid_price()
    {
        $this->invoice->paid      = $this->invoice->invoice_type == 0 ? $this->invoice->cost_after_discount : 0;
        $this->invoice->remains   = $this->invoice->invoice_type == 0 ? 0 :  $this->invoice->cost_after_discount;
    }
}