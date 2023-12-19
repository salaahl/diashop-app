<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Product extends Component
{
    public string $link;
    public string $image;
    public string $hover;
    public string $title;
    public string $description;
    public float $price;

    public function __construct(
        $link,
        $image,
        $hover,
        $title,
        $description,
        $price
    ) {
        $this->link = $link;
        $this->image = $image;
        $this->hover = $hover;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product');
    }
}
