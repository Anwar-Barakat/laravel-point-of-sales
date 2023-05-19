<?php

namespace App\Http\Livewire\Admin\Setting\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ShowService extends Component
{
    use WithPagination;

    public function updateStatus(Service $servuce)
    {
        $servuce->update(['is_active' => !$servuce->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.setting.service.show-service', ['services' => $this->getServices()]);
    }

    public function getServices()
    {
        return Service::latest()->paginate(CUSTOM_PAGINATION);
    }
}