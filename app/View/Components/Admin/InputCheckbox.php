<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public string $name, $label, $value;

    public function __construct(string $name, string $label, string $value)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.input-checkbox');
    }
}
