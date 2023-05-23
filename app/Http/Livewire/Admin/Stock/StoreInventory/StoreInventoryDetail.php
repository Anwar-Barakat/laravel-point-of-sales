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

    public $add_all = false;

    public $batches = [];

    public function mount(StoreInventory $inventory, StoreInventoryItem $product)
    {
        $this->inventory    = $inventory;
        $this->product      = $product;
        $this->batches      = $this->inventory->is_closed == 0 ? ItemBatch::with('unit')->where(['company_id' => get_auth_com(), 'store_id' => $this->inventory->store_id])->distinct()->get() : [];
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->add_all == 1) {
                $batches    = ItemBatch::where(['company_id' => get_auth_com(), 'store_id' => $this->inventory->store_id])->get();
            } else {
                $item_batch = ItemBatch::findOrFail($this->product->item_batch_id);
                $batches    = ItemBatch::where(['company_id' => get_auth_com(), 'store_id' => $this->inventory->store_id, 'item_id' => $item_batch->item_id])->get();
            }

            foreach ($batches as $batch) {

                $batchExists = StoreInventoryItem::where(['store_inventory_id' => $this->inventory->id, 'item_batch_id' => $batch->id, 'item_id' => $batch->item_id])->first();
                if ($batchExists) {
                    if ($this->add_all == 0) {
                        toastr()->error(__('msgs.exists', ['name' => __('validation.attributes.item_batch_id')]));
                        break;
                    }
                } else {
                    StoreInventoryItem::create([
                        'store_inventory_id'  => $this->inventory->id,
                        'item_batch_id'       => $batch->id,
                        'item_id'             => $batch->item_id,
                        'unit_id'             => $batch->unit_id,
                        'unit_price'          => $batch->unit_price,
                        'total_price'         => $batch->total_price,
                        'old_qty'             => $batch->qty,
                        'new_qty'             => $batch->qty,
                        'subtract'            => 0,
                        'production_date'     => $batch->production_date,
                        'expiration_date'     => $batch->expiration_date,
                        'added_by'             => get_auth_id(),
                    ]);
                }
            }

            $hasBatches = $batches->count() > 0;
            if ($hasBatches && !session()->has('batch_added')) {
                toastr()->success(__('msgs.submitted', ['name' => __('stock.store_inventory')]));
                session()->put('batch_added', true);
            }
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
            'add_all'                   => ['required', 'boolean'],
            'product.item_batch_id'     => ['required_if:add_all,0'],
        ];
    }

    public function getStoreInventoryItems()
    {
        return StoreInventoryItem::where('store_inventory_id', $this->inventory->id)->paginate(CUSTOM_PAGINATION);
    }
}