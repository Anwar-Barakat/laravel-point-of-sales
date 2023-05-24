<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\ItemBatch;
use App\Models\StoreInventory;
use App\Models\StoreInventoryItem;
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
            $batchExists = StoreInventoryItem::where(['store_inventory_id' => $this->inventory->id, 'item_batch_id' => $this->batch->id, 'item_id' => $this->batch->item_id])->first();
            if ($batchExists) {
                toastr()->error(__('msgs.exists', ['name' => __('validation.attributes.item_batch_id')]));
                return false;
            }
            
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

            $index = array_search($this->batch, $this->batches);
            dd($index);
            if ($index !== false)
                array_splice($this->batches, $index, 1);



            toastr()->success(__('msgs.submitted', ['name' => __('stock.store_inventory')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.stores-inventories.show', ['stores_inventory' => $this->inventory])->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.store-inventory.store-inventory-detail', ['inventoryItems' => $this->getStoreInventoryItems()]);
    }

    public function rules()
    {
        return [
            'product.item_batch_id'     => ['required', 'integer'],
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