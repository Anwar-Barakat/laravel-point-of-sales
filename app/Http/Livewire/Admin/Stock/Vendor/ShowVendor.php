<?php

namespace App\Http\Livewire\Admin\Stock\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class ShowVendor extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = PAGINATION_COUNT;

    public function updateStatus($id)
    {
        $account    = Vendor::findOrFail($id);
        $account->update(['is_active' => !$account->is_active]);
        $this->getVendors();
    }

    public function render()
    {
        $vendors  = $this->getVendors();
        return view('livewire.admin.stock.vendor.show-vendor', ['vendors' => $vendors]);
    }

    public function getVendors()
    {
        return  Vendor::with(['account'])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);;
    }
}