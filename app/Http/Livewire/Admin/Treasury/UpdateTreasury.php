<?php

namespace App\Http\Livewire\Admin\Treasury;

use Livewire\Component;

class UpdateTreasury extends Component
{
    public $treasury_name_ar, $treasury_name_en,
        $is_master,
        $is_active,
        $last_payment_receipt,
        $last_payment_collect;

    public function mount($treasury)
    {
        $this->treasury_name_ar         = $treasury->getTranslation('name', 'ar');
        $this->treasury_name_en         = $treasury->getTranslation('name', 'en');
        $this->is_master                = $treasury->is_master;
        $this->is_active                = $treasury->is_active;
        $this->last_payment_receipt     = $treasury->last_payment_receipt;
        $this->last_payment_collect     = $treasury->last_payment_collect;
    }

    public function render()
    {
        return view('livewire.admin.treasury.update-treasury');
    }
}
