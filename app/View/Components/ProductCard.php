<?php

namespace App\View\Components;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $product_item;
    public function __construct($productitem)
    {
        $this->product_item= $productitem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = $this->product_item;
        return view('components.product-card',compact('product'));
    }
}
