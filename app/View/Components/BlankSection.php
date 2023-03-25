<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlankSection extends Component
{
    public $url, $content;

    public function __construct($url, $content)
    {
        $this->url      = $url;
        $this->content  = $content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blank-section');
    }
}
