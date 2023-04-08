<?php

namespace App\Http\Livewire\Admin\Stock\Store;

use App\Models\Store;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $store_id;

    public function updateStatus($store_id)
    {
        $store              = Store::findOrFail($store_id);
        $store->update(['is_active' => !$store->is_active]);
        $this->is_active    = $store->is_active;
    }

    public function render()
    {
        return view('livewire.admin.stock.store.update-status');
    }
}