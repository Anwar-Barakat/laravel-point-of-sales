<?php

namespace App\Http\Livewire\Admin\Stock\Vendor;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditVendor extends Component
{
    public Vendor $vendor;
    public $auth;

    public $edit = false;

    public $categories = [];

    public function mount(Vendor $vendor)
    {
        $this->auth     = Auth::guard('admin')->user();
        $this->vendor   = $vendor;
        $this->edit     = !empty($this->vendor->initial_balance_status) ? true : false;
        $this->categories = Category::with('subCategories')->where(['parent_id' => 0])->active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedVendorInitialBalanceStatus()
    {
        $this->vendor->initial_balance = ($this->vendor->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            switch ($this->vendor->initial_balance_status) {
                case 1:
                    $this->vendor->initial_balance = 0;
                    break;
                case 2:
                    abs($this->vendor->initial_balance);
                    break;
                case 3:
                    $this->vendor->initial_balance = $this->vendor->initial_balance * (-1);
                    break;
            }

            $this->vendor['added_by']     = $this->auth->id;
            $this->vendor['company_code'] = $this->auth->company_code;
            $this->vendor->save();

            Account::updateOrCreate(
                [
                    'vendor_id'              => $this->vendor->id,
                ],
                [
                    'name'                      => $this->vendor->name,
                    'account_type_id'           => AccountType::where('name->en', 'Vendor')->first()->id,
                    'is_parent'                 => 0,
                    'parent_id'                 => Setting::where('company_code', $this->auth->company_code)->first()->vendor_account_id,
                    'account_number'            => uniqid(),
                    'initial_balance_status'    => $this->vendor->initial_balance_status,
                    'initial_balance'           => $this->vendor->initial_balance,
                    'notes'                     => $this->vendor->notes,
                    'company_code'              => $this->auth->company_code,
                    'added_by'                  => $this->auth->id,
                ]
            );
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
                    return $query->where('company_code', $this->auth->company_code);
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