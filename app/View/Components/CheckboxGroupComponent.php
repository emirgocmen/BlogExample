<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroupComponent extends Component
{
    private string $label;
    private string $name;
    private string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, string $value)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox-group-component', [
            "label" => $this->label,
            "name" => $this->name,
            "value" => $this->value,
        ]);
    }
}
