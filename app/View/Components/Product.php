<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Product extends Component
{
    public string $link;
    public string $image1;
    public string $image2;
    public string $title;
    public string $price;

    public function __construct(
        $link,
        $image1,
        $image2,
        $title,
        $price
    ) {
        $this->link = $link;
        $this->image = $image1;
        $this->hover = $image2;
        $this->title = $title;
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
