<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Product extends Component
{
    public string $image;
    public string $title;
    public string $description;
    public float $price;

    public function __construct(
        $image = "/images/placeholder.png",
        $title = "Titre",
        $description = "Courte description de l'\article",
        $price
    ) {
        $this->image = $image;
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
