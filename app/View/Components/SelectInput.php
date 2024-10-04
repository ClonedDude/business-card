<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $title, $name, $id, $multiple, $info, $required;

    public function __construct($title, $name, $id, $multiple = null, $info = null, $required = null)
    {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->multiple = $multiple;
        $this->info = $info;
        $this->required = $required;
    }   

    public function render()
    {
        return view('components.select-input');
    }
}
