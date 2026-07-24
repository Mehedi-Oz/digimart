<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputToggle extends Component
{
    public string $name, $label;

    public ?bool $checked;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        ?string $label = null,
        bool $checked = false,
    ) {
        $this->name = $name;
        $this->label = $label ?? \Str::title(str_replace('_', ' ', $name));
        $this->checked = old($name, $checked);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.input-toggle');
    }
}
