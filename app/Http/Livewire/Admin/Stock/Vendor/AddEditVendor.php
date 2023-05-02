<?php

namespace App\Http\Livewire\Admin\Stock\Vendor;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditVendor extends Component
{
    public Vendor $vendor;

    public $categories = [];

    public function mount(Vendor $vendor)
    {
        $this->vendor       = $vendor;
        $this->categories   = Category::with('subCategories')->where(['parent_id' => 0])->active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedVendorInitialBalanceStatus()
    {
        $this->vendor->initial_balance = ($this->vendor->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        // $this->validate();
        try {
            DB::beginTransaction();
            switch ($this->vendor->initial_balance_status) {
                case 1:
                    $this->vendor->initial_balance = 0;
                    break;
                case 2:
                    $this->vendor->initial_balance = $this->vendor->initial_balance * (-1);
                    break;
                case 3:
                    abs($this->vendor->initial_balance);
                    break;
            }

            $this->vendor['company_id']     = get_auth_com();
            $this->vendor->save();

            if (!$this->vendor->account)
                Account::create([
                    'name'                      => $this->vendor->name,
                    'account_type_id'           => AccountType::where('name->en', 'vendor')->first()->id,
                    'is_parent'                 => 0,
                    'parent_id'                 => Auth::guard('admin')->user()->company->parent_vendor_id,
                    'number'                    => uniqid(),
                    'initial_balance_status'    => $this->vendor->initial_balance_status,
                    'initial_balance'           => $this->vendor->initial_balance,
                    'current_balance'           => $this->vendor->initial_balance,
                    'notes'                     => $this->vendor->notes,
                    'vendor_id'                 => $this->vendor->id,
                    'company_id'                => get_auth_com(),
                    'added_by'                  => get_auth_id(),
                ]);
            else
                $this->vendor->account->update(['name' => $this->vendor->name]);


            DB::commit();
            toastr()->success(__('msgs.submitted', ['name' => __('account.vendor')]));
            return redirect()->route('admin.vendors.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.vendors.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.vendor.add-edit-vendor');
    }

    public function rules(): array
    {
        return [
            'vendor.name'                     => [
                'required',
                'min:3',
                Rule::unique('vendors', 'name')->ignore($this->vendor->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'vendor.email'                    => [
                'required',
                Rule::unique('vendors', 'email')->ignore($this->vendor->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'vendor.address'                    => ['required', 'min:10'],
            'vendor.initial_balance_status'     => ['required', 'in:1,2,3'],
            'vendor.initial_balance'            => ['required', 'between:0,999999'],
            'vendor.is_active'                  => ['required', 'boolean'],
            'vendor.notes'                      => ['required', 'min:10'],
            'vendor.category_id'                => ['required', 'integer'],
        ];
    }
}
