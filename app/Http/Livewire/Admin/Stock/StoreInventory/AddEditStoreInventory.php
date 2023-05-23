<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\Store;
use App\Models\StoreInventory;
use Livewire\Component;

class AddEditStoreInventory extends Component
{
    public StoreInventory $inventory;

    public $stores    = [];

    public function mount(StoreInventory $inventory)
    {
        $this->inventory                    = $inventory;
        $this->inventory->inventory_date    = date('Y-m-d');
        $this->stores                       = Store::select('id', 'name')->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $inventoryType = StoreInventory::where(['is_closed' => 0, 'store_id' => $this->inventory->store_id, 'company_id' => get_auth_com(), 'inventory_type' => $this->inventory->inventory_type])->where('id', '!=', $this->inventory->id)->first();
            if ($inventoryType) {
                toastr()->error(__('validation.invetory_type_exists'));
                return false;
            }

            $inventoryOpen = StoreInventory::where(['is_closed' => 0, 'store_id' => $this->inventory->store_id, 'company_id' => get_auth_com()])->where('id', '!=', $this->inventory->id)->first();
            if ($inventoryOpen) {
                toastr()->error(__('validation.there_is_an_open_inventory'));
                return false;
            }


            if (!$this->inventory->is_closed == 0) {
                toastr()->error(__('msgs.something_went_wrong'));
                return redirect()->back();
            }

            $this->inventory->inventory_date    = date('Y-m-d');
            $this->inventory->added_by          = get_auth_id();
            $this->inventory->company_id        = get_auth_com();
            $this->inventory->save();

            toastr()->success(__('msgs.submitted', ['name' => __('stock.store_inventory')]));
            return redirect()->route('admin.stores-inventories.show', ['stores_inventory' => $this->inventory]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.stores-inventories.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.store-inventory.add-edit-store-inventory');
    }

    public function rules(): array
    {
        return [
            'inventory.inventory_date'  => ['required', 'date'],
            'inventory.inventory_type'  => ['required', 'in:1,2,3,4'],
            'inventory.store_id'        => ['required', 'integer'],
            'inventory.notes'           => ['required', 'min:10'],
        ];
    }
}
