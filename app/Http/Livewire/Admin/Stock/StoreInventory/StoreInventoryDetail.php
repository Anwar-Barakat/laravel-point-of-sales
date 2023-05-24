<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\ItemTransaction;
use App\Models\StoreInventory;
use App\Models\StoreInventoryItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StoreInventoryDetail extends Component
{
    use WithPagination;

    public StoreInventory $inventory;

    public StoreInventoryItem $product;

    public $batches = [],
        $items = [],
        $batch;

    public function mount(StoreInventory $inventory, StoreInventoryItem $product)
    {
        $this->inventory    = $inventory;
        $this->product      = $product;
        $this->items        = Item::whereHas('item_batches', fn ($query) =>      $query->where('store_id', $this->inventory->store_id))
            ->with(['parentUnit', 'childUnit'])->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedProductItemId()
    {
        $this->batches  = $this->inventory->is_closed == 0
            ? ItemBatch::with('unit')->where(['company_id' => get_auth_com(), 'store_id' => $this->inventory->store_id, 'item_id' => $this->product->item_id])->orderBy('item_id', 'asc')->get()
            : [];
    }

    public function updatedProductItemBatchId()
    {
        $this->batch    = ItemBatch::findOrFail($this->product->item_batch_id);
        $this->product->old_qty = (int)$this->batch->qty;
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->product->store_inventory_id  = $this->inventory->id;
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

    public function approve(StoreInventoryItem $product)
    {
        try {
            DB::beginTransaction();
            $qty_before_transaction = item_batch_qty($product->item);
            $store_qty_before_trans = item_batch_qty($product->item, $this->inventory->store_id);

            //________________________________________________
            // 1- update batch's qty
            //________________________________________________
            $batch                  = ItemBatch::findOrFail($product->item_batch_id);
            $batch->qty             = $product->new_qty;
            $batch->total_price     = ($product->new_qty * $batch->unit_price);
            $batch->save();

            $qty_after_transaction = item_batch_qty($product->item);
            $store_qty_after_trans = item_batch_qty($product->item, $this->inventory->store_id);

            //________________________________________________
            // 2- Any transaction on item it must be stored
            //________________________________________________
            ItemTransaction::create([
                'item_transaction_category_id'  => 3,  // Transaction on stores
                'item_transaction_type_id'      => 15, // Stores inventory
                'item_id'                       => $product->item_id,
                'store_inventory_id'            => $this->inventory->id,
                'store_id'                      => $this->inventory->store_id,
                'store_inventory_item_id'       => $product->id,
                'report'                        => 'Store inventroy for the batch number # ' . $batch->id,
                'store_qty_before_transaction'  => $store_qty_before_trans . ' ' . $product->item->parentUnit->name,
                'store_qty_after_transaction'   => $store_qty_after_trans . ' ' . $product->item->parentUnit->name,
                'qty_before_transaction'        => $qty_before_transaction . ' ' . $product->item->parentUnit->name,
                'qty_after_transaction'         => $qty_after_transaction . ' ' . $product->item->parentUnit->name,
                'added_by'                      => get_auth_id(),
                'company_id'                    => get_auth_com(),
            ]);

            $product->is_closed       = 1;
            $product->closed_at       = date('Y-m-d');
            $product->total_price     = $batch->total_price;
            $product->save();

            //________________________________________________
            // 3- Any transaction on item it must be stored
            //________________________________________________
            $product->item->wholesale_cost_price   = $batch->unit_price;
            $product->item->retail_cost_price      = $product->item->has_retail_unit ? $batch->unit_price / $product->item->retail_count_for_wholesale : null;
            update_item_qty($product->item);
            $product->item->save();
            DB::commit();
            toastr()->success(__('msgs.approved', ['name' => __('stock.item')]));
        } catch (\Throwable $th) {
            DB::rollBack();
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
            'product.item_id'     => [
                'required', 'integer',
                Rule::unique('store_inventory_items', 'item_id')->ignore($this->product->id)
            ],
            'product.item_batch_id'     => [
                'required', 'integer',
                Rule::unique('store_inventory_items', 'item_batch_id')->ignore($this->product->id)
            ],
            'product.notes'             => ['required', 'min:3', 'max:255'],
            'product.old_qty'           => ['integer'],
            'product.new_qty'           => ['required', 'integer'],

        ];
    }

    public function getStoreInventoryItems()
    {
        return StoreInventoryItem::where('store_inventory_id', $this->inventory->id)->paginate(CUSTOM_PAGINATION);
    }
}
