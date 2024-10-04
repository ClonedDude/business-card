<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextAreaInput extends Component
{
    public $title, $name, $id, $type, $value, $info, $request, $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $name, $id, $value = null, $info = null, $request = null, $required = false)
    {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->info = $info;
        $this->request = $request;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text-area-input');
    }
}
