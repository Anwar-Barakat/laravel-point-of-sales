<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\ItemBatch;
use App\Models\StoreInventory;
use App\Models\StoreInventoryItem;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StoreInventoryDetail extends Component
{
    use WithPagination;

    public StoreInventory $inventory;

    public StoreInventoryItem $product;

    public $batches = [], $batch;

    public function mount(StoreInventory $inventory, StoreInventoryItem $product)
    {
        $this->inventory    = $inventory;
        $this->product      = $product;
        $this->batches      = $this->inventory->is_closed == 0 ? ItemBatch::with('unit')->where(['company_id' => get_auth_com(), 'store_id' => $this->inventory->store_id])->distinct()->get() : [];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedProductItemBatchId()
    {
        $this->batch            = ItemBatch::find($this->product->item_batch_id);
        $this->product->old_qty = (int)$this->batch->qty;
    }

    public function submit()
    {
        $this->validate();
        try {

            $this->product->store_inventory_id  = $this->inventory->id;
            $this->product->item_id             = $this->batch->item_id;
            $this->product->unit_id             = $this->batch->unit_id;
            $this->product->unit_price          = $this->batch->unit_price;
            $this->product->total_price         = $this->batch->total_price;
            $this->product->old_qty             = $this->batch->qty;
            $this->product->subtract            = $this->batch->qty - $this->product->new_qty;
            $this->product->production_date     = $this->batch->production_date;
            $this->product->expiration_date     = $this->batch->expiration_date;
            $this->product->added_by            = get_auth_id();
            $this->product->save();

            toastr()->success(__('msgs.submitted', ['name' => __('stock.store_inventory')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.stores-inventories.show', ['stores_inventory' => $this->inventory])->with(['error' => $th->getMessage()]);
        }
    }

    public function edit(StoreInventoryItem $product)
    {
        $this->product = $product;
        $this->batch   = ItemBatch::find($this->product->item_batch_id);
    }

    public function delete(StoreInventoryItem $product)
    {
        if ($product->is_closed == 0) {
            $product->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('stock.store_inventory')]));
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.store-inventory.store-inventory-detail', ['inventoryItems' => $this->getStoreInventoryItems()]);
    }

    public function rules()
    {
        return [
            'product.item_batch_id'     => [
                'required', 'integer',
                Rule::unique('store_inventory_items', 'item_batch_id')->ignore($this->product->id)
            ],
            'product.notes'             => ['required', 'min:3', 'max:255'],
            'product.old_qty'           => ['integer'],
            'product.new_qty'           => ['required', 'integer']
        ];
    }

    public function getStoreInventoryItems()
    {
        return StoreInventoryItem::where('store_inventory_id', $this->inventory->id)->paginate(CUSTOM_PAGINATION);
    }
}
