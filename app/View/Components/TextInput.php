<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    public $title, $name, $id, $type, $value, $info, $request, $orientation, $min, $max, $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $name, $id, $type = "text", $value = null, $min = null, $max = null, $info = null, $request = null, $orientation = "vertical", $required = false)
    {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->info = $info;
        $this->request = $request;
        $this->orientation = $orientation;
        $this->min = $min;
        $this->max = $max;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text-input');
    }
}
