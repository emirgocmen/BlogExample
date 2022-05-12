<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileGroupComponent extends Component
{
    private string $label;
    private string $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name)
    {
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-group-component', [
            "label" => $this->label,
            "name" => $this->name,
        ]);
    }
}
