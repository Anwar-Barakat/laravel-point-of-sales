<?php

namespace App\Http\Livewire\Admin\Account\ExchangeTransaction;

use App\Models\Account;
use App\Models\Shift;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddEditExchangeTransaction extends Component
{
    public TreasuryTransaction $transaction;

    public $auth;
    public Shift $shiftExists;

    public $accounts = [],
        $treasury_balance,
        $shiftTypes = [];


    public function mount(TreasuryTransaction $transaction)
    {
        $this->transaction = $transaction;
        $this->auth         = Auth::guard('admin')->user();
        $this->accounts     = Account::where(['company_code' => $this->auth->company_code, 'is_parent' => 0])->active()->get();
        $this->shiftTypes   = ShiftType::private()->active()->get();


        $this->shiftExists  = Shift::with(['treasury:id,name', 'admin:id,name'])
            ->where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->first();

        $this->transaction->treasury_id = !is_null($this->shiftExists)
            ? $this->shiftExists->treasury->id
            : '';
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

        if ($this->transaction->money > $this->treasury_balance) {
            toastr()->error(__('account.not_enough_balance'));
            return false;
        }

        try {
            DB::transaction(function () {
                $this->transaction->fill([
                    'money'             => floatval(-$this->transaction->money), // treasury is credit
                    'shift_id'          => $this->shiftExists->id,
                    'admin_id'          => $this->auth->id,
                    'treasury_id'       => $this->shiftExists->treasury->id,
                    'payment'           => $this->shiftExists->last_payment_exchange + 1,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'money_for_account' => $this->transaction->money,
                    'company_code'      => $this->auth->company_code,
                ])->save();

                $this->shiftExists->treasury->increment('last_payment_exchange');
            });

            toastr()->success(__('msgs.submitted', ['name' => __('account.treasury_transaction')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.treasury-transactions.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $transaction = TreasuryTransaction::findOrFail($id);
        if (!$transaction) {
            toastr()->error(__('msgs.something_went_wrong'));
            return false;
        }
        $this->transaction  = $transaction;
    }




    public function render()
    {
        $transactions       = TreasuryTransaction::with(['treasury:id,name', 'admin:id,name', 'shift_type:id,name'])
            ->where(['company_code' => $this->auth->company_code])
            ->where('money', '<', '0')
            ->paginate(CUSTOM_PAGINATION);

        $treasuryBalance    = TreasuryTransaction::where(['company_code' => $this->auth->company_code, 'shift_id' => $this->shiftExists->id])
            ->sum('money') ?? 0;

        $this->treasury_balance = $treasuryBalance;

        return view('livewire.admin.account.exchange-transaction.add-edit-exchange-transaction', [
            'transactions'      => $transactions,
            'treasuryBalance'   => $treasuryBalance
        ]);
    }


    public function rules(): array
    {
        return [
            'transaction.transaction_date'  => ['required', 'date'],
            'transaction.shift_type_id'     => ['required', 'integer'],
            'transaction.money'             => ['required', 'numeric', 'between:0,9999.99'],
            'transaction.account_id'        => ['required', 'integer'],
            'transaction.report'            => ['required', 'min:20'],
        ];
    }
}