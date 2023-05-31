<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BarcodeModal extends Component
{
    public $id, $name, $barcode;

    public function __construct($name, $id, $barcode)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->barcode     = $barcode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.barcode-modal');
    }
}
