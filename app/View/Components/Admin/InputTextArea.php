<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputTextArea extends Component
{
    public string $name, $label;
    public ?string  $id, $value, $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label = null,
        string $id = null,
        string $value = null,
        string $placeholder = null
    ) {
        $this->name = $name;
        $this->label = $label ?? \Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.input-text-area');
    }
}
