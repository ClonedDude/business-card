<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImagePreview extends Component
{
    public $url, $title, $width, $height;

    public function __construct($url, $title, $width, $height)
    {
        $this->url = $url;
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
    }

    public function render(): View|Closure|string
    {
        return view('components.image-preview');
    }
}
