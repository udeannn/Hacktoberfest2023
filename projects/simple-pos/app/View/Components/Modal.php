<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $modalId, $modalTitleClass, $modalSubmit;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $modalId = 'modal-store',
        $modalTitleClass = 'modal-title',
        $modalSubmit = 'true'
    ) {
        $this->modalId = $modalId;
        $this->modalTitleClass = $modalTitleClass;
        $this->modalSubmit = $modalSubmit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
