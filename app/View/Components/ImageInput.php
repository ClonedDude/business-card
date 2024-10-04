<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageInput extends Component
{
    public $title, $name, $id, $value, $height, $required;

    public function __construct($title = null, $name, $id, $value = null, $height = null, $required = null)
    {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->height = $height;
        $this->required = $required;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.image-input');
    }
}
