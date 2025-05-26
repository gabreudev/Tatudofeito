<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public $type;
    public $name;
    public $placeholder;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $type = 'text', $placeholder = '', $value = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
