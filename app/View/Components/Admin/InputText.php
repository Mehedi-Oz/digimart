<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    public string $name, $label, $type;
    public ?string  $id, $value, $placeholder, $hint;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label = null,
        string $type = 'text',
        string $id = null,
        string $value = null,
        string $placeholder = null,
        string $hint = null,
    ) {
        $this->name = $name;
        $this->label = $label ?? \Str::title(str_replace('_', ' ', $name));
        $this->type = $type;
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->hint = $hint;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.input-text');
    }
}
