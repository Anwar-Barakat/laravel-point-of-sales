<?php

namespace App\Http\Livewire\Admin\Account\ExchangeTransaction;

use App\Models\Account;
use App\Models\Shift;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddEditExchangeTransaction extends Component
{
    use WithPagination;

    public TreasuryTransaction $transaction;

    public $accounts = [],
        $shiftTypes = [];


    public function mount(TreasuryTransaction $transaction)
    {
        $this->transaction  = $transaction;
        $this->accounts     = Account::with(['accountType:id,name'])->where(['company_code' => get_auth_com(), 'is_parent' => 0])->active()->get();
        $this->shiftTypes   = ShiftType::private()->active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedTransactionAccountId()
    {
        $account            = Account::with('accountType:id')->findOrFail($this->transaction->account_id);
        $this->shiftTypes   = ShiftType::where(['account_type_id' => $account->accountType->id])->private()->get();
    }

    public function submit()
    {
        $this->validate();
        if (!has_open_shift()) {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }

        if ($this->transaction->money > get_treasury_balance()) {
            toastr()->error(__('account.not_enough_balance'));
            return false;
        }

        try {
            DB::transaction(function () {
                $this->transaction->fill([
                    'money'             => floatval(-$this->transaction->money), // treasury is credit
                    'shift_id'          => has_open_shift()->id,
                    'admin_id'          => get_auth_id(),
                    'treasury_id'       => has_open_shift()->treasury->id,
                    'payment'           => has_open_shift()->last_payment_exchange + 1,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'money_for_account' => $this->transaction->money,
                    'company_code'      => get_auth_com(),
                ])->save();

                has_open_shift()->treasury->increment('last_payment_exchange');
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
            ->where(['company_code' => get_auth_com()])
            ->where('money', '<', '0')
            ->paginate(CUSTOM_PAGINATION);

        return view('livewire.admin.account.exchange-transaction.add-edit-exchange-transaction', [
            'transactions'      => $transactions,
            'treasuryBalance'   => get_treasury_balance()
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
