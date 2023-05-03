<?php

namespace App\Http\Livewire\Admin\Account\CollectTransaction;

use App\Models\Account;
use App\Models\ShiftType;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddEditCollectTransaction extends Component
{
    use WithPagination;

    public $created_at,
        $shift_type_id,
        $treasury_id,
        $admin_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $tranasctions_from_date,
        $tranasctions_to_date;

    public TreasuryTransaction $transaction;

    public $accounts    = [],
        $shiftTypes     = [],
        $financial_account = '';


    public function mount(TreasuryTransaction $transaction)
    {
        $this->transaction  = $transaction;
        $this->accounts     = Account::where(['company_id' => get_auth_com(), 'is_parent' => 0])->active()->get();
        $this->shiftTypes   = ShiftType::collect()->active()->get();
        $this->tranasctions_to_date = date('Y-m-d');
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedTransactionAccountId()
    {
        $this->financial_account    = Account::with('accountType:id,name')->findOrFail($this->transaction->account_id);
        $this->shiftTypes           = ShiftType::where(['account_type_id' => $this->financial_account->accountType->id])->collect()->get();
    }

    public function submit()
    {
        if (!has_open_shift()) {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }

        $this->validate();
        try {
            DB::transaction(function () {
                $this->transaction->fill([
                    'shift_id'          => has_open_shift()->id,
                    'admin_id'          => get_auth_id(),
                    'treasury_id'       => has_open_shift()->treasury->id,
                    'payment'           => has_open_shift()->treasury->last_payment_collect + 1,
                    'is_approved'       => 1,
                    'is_account'        => 1,
                    'money_for_account' => floatval(-$this->transaction->money),
                    'company_id'      => get_auth_com(),
                ])->save();

                has_open_shift()->treasury->increment('last_payment_collect');
            });

            update_account_balance($this->transaction->account);

            toastr()->success(__('msgs.submitted', ['name' => __('account.treasury_transaction')]));
            $this->reset('transaction', 'account');
        } catch (\Throwable $th) {
            return redirect()->route('admin.collect-transactions')->with(['error' => $th->getMessage()]);
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

    public function render()
    {
        $transactions       = TreasuryTransaction::with(['treasury:id,name', 'admin:id,name', 'shift_type:id,name', 'account'])
            ->where(['company_id' => get_auth_com()])
            ->where('money', '>', '0')
            ->when($this->shift_type_id,            fn ($q) => $q->where('shift_type_id', $this->shift_type_id))
            ->when($this->treasury_id,              fn ($q) => $q->where('treasury_id', $this->treasury_id))
            ->when($this->admin_id,                 fn ($q) => $q->where('admin_id', $this->admin_id))
            ->when($this->tranasctions_from_date,   fn ($q) => $q->whereBetween('transaction_date', [$this->tranasctions_from_date, $this->tranasctions_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);

        return view('livewire.admin.account.collect-transaction.add-edit-collect-transaction', [
            'transactions'      => $transactions,
            'treasuryBalance'   => get_treasury_balance()
        ]);
    }
}