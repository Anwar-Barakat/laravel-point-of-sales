<?php

namespace App\Http\Livewire\Admin\Account\TreasuryTransaction;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Shift;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddEditTreasuryTransaction extends Component
{
    public TreasuryTransaction $transaction;

    public Admin $auth;
    public Shift $shiftExists;
    public int $treasuryBalance;

    public $accounts = [],
        $shiftTypes = [];


    public function mount(TreasuryTransaction $transaction)
    {
        $this->transaction = $transaction;
        $this->auth         = Auth::guard('admin')->user();
        $this->accounts     = Account::where(['company_code' => $this->auth->company_code, 'is_parent' => 0])->active()->get();
        $this->shiftTypes   = ShiftType::collect()->active()->get();

        if (Shift::where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->count() > 0) {
            $this->shiftExists  = Shift::with(['treasury:id,name', 'admin:id,name'])->where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->first();
            $this->transaction->treasury_id = !is_null($this->shiftExists)
                ? $this->shiftExists->treasury->id
                : '';
            $this->treasuryBalance = TreasuryTransaction::where(['company_code' => $this->auth->company_code, 'shift_id' => $this->shiftExists->id])->sum('amount_collected') ?? 0;
        } else {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        if (!$this->shiftExists) {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }

        try {
            DB::transaction(function () {
                $this->transaction->fill([
                    'shift_id'          => $this->shiftExists->id,
                    'admin_id'          => $this->auth->id,
                    'treasury_id'       => $this->shiftExists->treasury->id,
                    'payment_receipt'   => $this->shiftExists->last_payment_receipt + 1,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'money_for_account' => floatval(-$this->transaction->amount_collected),
                    'company_code'      => $this->auth->company_code,
                ])->save();

                $this->shiftExists->treasury->increment('last_payment_receipt');
            });

            toastr()->success(__('msgs.submitted', ['name' => __('account.treasury_transaction')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.treasury-transactions.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render(): View
    {
        $transactions   = TreasuryTransaction::with(['treasury:id,name', 'admin:id,name', 'shift_type:id,name'])->where(['company_code' => $this->auth->company_code])->paginate(PAGINATION_COUNT);
        return view('livewire.admin.account.treasury-transaction.add-edit-treasury-transaction', ['transactions' => $transactions]);
    }

    public function rules(): array
    {
        return [
            'transaction.transaction_date'  => ['required', 'date'],
            'transaction.shift_type_id'     => ['required', 'integer'],
            'transaction.amount_collected'  => ['required', 'numeric', 'between:0,9999.99'],
            'transaction.account_id'        => ['required', 'integer'],
            'transaction.report'            => ['required', 'min:20'],
        ];
    }
}
