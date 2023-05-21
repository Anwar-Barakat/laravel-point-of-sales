<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\ServiceInvoice;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServiceInvoiceApproval extends Component
{
    public ServiceInvoice $invoice;

    public $total;

    protected $listeners = ['updateServicesInvoice'];

    public function updateServicesInvoice(ServiceInvoice $invoice)
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

            if ($this->invoice->service_type == 0 && get_treasury_balance() < $this->invoice->paid) {
                toastr()->error(__('account.not_enough_balance'));
                $this->invoice->paid = 0;
            }

            DB::beginTransaction();

            //________________________________________________
            // 1- Monetary Transaction
            //________________________________________________

            if ($this->invoice->service_type == 0) :
                $shift_type = ShiftType::findOrFail(17)->id; // Disbursement of an internal invoice
                $payment    = has_open_shift()->last_payment_exchange + 1;
                $money      = floatval(-$this->invoice->paid);
                $report     = 'Disbursement of an internal invoice from the account of the number holder #' . $this->invoice->account->id;
            elseif ($this->invoice->service_type == 1) :
                $shift_type = ShiftType::findOrFail(18)->id; // Collecting money from an external invoice
                $payment    = has_open_shift()->last_payment_collect + 1;
                $money      = $this->invoice->paid;
                $report     = 'Collecting money from an external invoice from an account of the number holder #' . $this->invoice->account->id;
            endif;

            TreasuryTransaction::create([
                'shift_type_id'     => $shift_type,
                'shift_id'          => has_open_shift()->id,
                'admin_id'          => get_auth_id(),
                'treasury_id'       => has_open_shift()->treasury->id,
                'service_id'        => $this->invoice->id,
                'account_id'        => $this->invoice->account_id,
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
            // 2- Approving the service invoice
            //________________________________________________
            if ($this->invoice->service_type == 0) :
                $money_for_account = floatval(-$this->invoice->cost_after_discount);

                //________________________________________________
                // 3- Increment last payment exchange for treasury
                //________________________________________________
                has_open_shift()->treasury->increment('last_payment_exchange');
            elseif ($this->invoice->service_type == 1) :
                $money_for_account = $this->invoice->cost_after_discount;

                //________________________________________________
                // 3- Increment last payment collect for treasury
                //________________________________________________
                has_open_shift()->treasury->increment('last_payment_collect');
            endif;

            $this->invoice->treasury_id               = has_open_shift()->treasury->id;
            $this->invoice->is_approved               = 1;
            $this->invoice->approved_by               = get_auth_id();
            $this->invoice->money_for_account         = $money_for_account;
            $this->invoice->treasury_transaction_id   = TreasuryTransaction::latest()->first()->id;
            $this->invoice->company_id                = get_auth_com();
            $this->invoice->save();


            //________________________________________________
            // 4- Update the vendor account balance
            //________________________________________________
            update_account_balance($this->invoice->account);

            DB::commit();
            toastr()->success(__('msgs.approved', ['name' => __('transaction.service_invoice')]));
            $this->emit('updateServicesInvoice', ['invoice' => $this->invoice]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.services-invoices.show', ['services_invoice' => $this->invoice])->with(['error' => $th->getMessage()]);
        }
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
