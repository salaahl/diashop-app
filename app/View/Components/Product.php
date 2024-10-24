<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Product extends Component
{
    public string $created;
    public string $link;
    public string $image1;
    public string $image2;
    public string $title;
    public string $price;
    public string $promotion;
    public string $message;

    public function __construct(
        $created,
        $link,
        $image1,
        $image2,
        $title,
        $price,
        $promotion,
        $message
    ) {
        $this->created = $created;
        $this->link = $link;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->title = $title;
        $this->price = $price;
        $this->promotion = $promotion;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
