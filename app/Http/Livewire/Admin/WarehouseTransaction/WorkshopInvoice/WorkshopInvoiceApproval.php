<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\WorkshopInvoice;

use App\Models\ItemBatch;
use App\Models\ItemTransaction;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use App\Models\WorkshopInvoice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WorkshopInvoiceApproval extends Component
{
    public WorkshopInvoice $invoice;


    protected $listeners = ['updateWorkshopProducts'];

    public function updateWorkshopProducts(WorkshopInvoice $invoice)
    {
        $this->invoice = $invoice;
        $this->remain_paid_price();
    }

    public function mount(WorkshopInvoice $invoice)
    {
        $this->invoice = $invoice;
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
        $this->invoice->cost_before_discount  = $this->invoice->items_cost + get_tax_value($this->invoice);
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

        $discountAmount = get_discount_value($this->invoice);
        $this->invoice->cost_after_discount = $this->invoice->cost_before_discount - $discountAmount;
        $this->remain_paid_price();
    }

    public function updatedInvoicePaid()
    {
        if ($this->invoice->invoice_type == 1)
            $this->invoice->remains    = $this->invoice->cost_after_discount - $this->invoice->paid;
        else
            $this->remain_paid_price();
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->invoice->invoice_type = 1;

            if (!has_open_shift()) {
                toastr()->error(__('account.dont_have_open_shift'));
                return redirect()->route('admin.shifts.create');
            }

            DB::beginTransaction();

            //________________________________________________
            // 1- Monetary Transaction
            //________________________________________________
            TreasuryTransaction::create([
                'shift_type_id'     => ShiftType::findOrFail(19)->id, // Disbursement of an workshop invoice,
                'shift_id'          => has_open_shift()->id,
                'admin_id'          => get_auth_id(),
                'treasury_id'       => has_open_shift()->treasury->id,
                'sale_id'           => $this->invoice->id,
                'account_id'        => $this->invoice->account_id,
                'is_approved'       => 1,
                'is_account'        => 1,
                'transaction_date'  => date('Y-m-d'),
                'payment'           => has_open_shift()->last_payment_exchange + 1,
                'money'             => floatval(-$this->invoice->paid),
                'money_for_account' => $this->invoice->paid,
                'report'            => 'Disbursement for a workshop (' . $this->invoice->workshop->name . ') of the account number is #' . $this->invoice->workshop->account->number,
                'company_id'        => get_auth_com(),
            ]);

            //________________________________________________
            // 2- Approving the sale
            //________________________________________________

            //________________________________________________
            // 3- Increment last payment exchange for treasury
            //________________________________________________
            has_open_shift()->treasury->increment('last_payment_exchange');


            $this->invoice->treasury_id                = has_open_shift()->treasury->id;
            $this->invoice->is_approved                = 1;
            $this->invoice->approved_by                = get_auth_id();
            $this->invoice->money_for_account          = floatval(-$this->invoice->cost_after_discount);
            $this->invoice->treasury_transaction_id    = TreasuryTransaction::latest()->first()->id;
            $this->invoice->company_id                 = get_auth_com();
            $this->invoice->save();


            //________________________________________________
            // 4- Update the customer balance
            //________________________________________________
            update_account_balance($this->invoice->workshop->account);

            //________________________________________________
            // 5- Transaction on store
            //________________________________________________
            $this->invoice->workshopItems->map(function ($prod) {
                $ratio                  = $prod->item->retail_count_for_wholesale;
                $qty_before_transaction = item_batch_qty($prod->item);
                $store_qty_before_trans = item_batch_qty($prod->item, $this->invoice->store_id);

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

                $batch      = ItemBatch::find($prod->item_batch_id);
                $batch->update([
                    'qty'           => $batch->qty - $quantity,
                    'total_price'   => $batch->unit_price * ($batch->qty - $quantity)
                ]);

                //________________________________________________
                // 6- Any transaction on item it must be stored
                //________________________________________________
                $qty_after_transaction = item_batch_qty($prod->item);
                $store_qty_after_trans = item_batch_qty($prod->item, $this->invoice->store_id);

                ItemTransaction::create([
                    'item_transaction_category_id'  => 4,  // Transaction on sales
                    'item_transaction_type_id'      => 11, // Disbursement of raw materials for the production line
                    'item_id'                       => $prod->item_id,
                    'workshop_invoice_id'           => $this->invoice->id,
                    'workshop_invoice_item_id'      => $prod->id,
                    'store_id'                      => $this->invoice->store_id,
                    'report'                        => "Disbursement of raw materials for the production line ({$this->invoice->workshop->name}) and invoice number #({$this->invoice->id}) ",
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
                $prod->item->retail_cost_price      = $prod->item->has_retail_unit ? $unit_price / $ratio : null;
                update_item_qty($prod->item);
                $prod->item->save();
            });


            DB::commit();
            toastr()->success(__('msgs.approved', ['name' => __('transaction.workshop_invoice')]));
            $this->emit('updateWorkshopProducts', ['invoice' => $this->invoice]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.workshop-invoices.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.workshop-invoice.workshop-invoice-approval');
    }

    public function rules()
    {
        return [
            'invoice.items_cost'               => ['required'],
            'invoice.tax_type'                 => ['nullable', 'boolean'],
            'invoice.tax_value'                => ['nullable', 'numeric', function ($value) {
                if ($this->invoice->tax_type  == '0' && $this->invoice->tax_value  >= 100) {
                    toastr()->error(__('validation.tax_type_is_percent'));
                    $this->invoice->tax_value = 0;
                }
            }],
            'invoice.cost_before_discount'     => ['required'],
            'invoice.discount_type'            => ['nullable', 'boolean'],
            'invoice.discount_value'           => ['nullable', 'numeric'],
            'invoice.cost_after_discount'      => ['required'],
            'invoice.paid'                     => ['numeric', function () {
                if ($this->invoice->paid > $this->invoice->cost_after_discount) {
                    toastr()->error(__('validation.paid_smaller_than_cost'));
                    $this->invoice->paid = 0;
                }
            }],
            'invoice.remains'                  => ['required'],
        ];
    }

    private function remain_paid_price()
    {
        $this->invoice->paid      = $this->invoice->invoice_type == 0 ? $this->invoice->cost_after_discount : 0;
        $this->invoice->remains   = $this->invoice->invoice_type == 0 ? 0 :  $this->invoice->cost_after_discount;
    }
}
