<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CarouselItem extends Component
{
    public string $image;
    public string $title;
    public string $text;

    public function __construct(
        $image,
        $title,
        $text,
    ) {
        $this->image = $image;
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel-item');
    }
}
