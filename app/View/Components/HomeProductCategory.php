<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeProductCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public $category_item;
    public function __construct($categoryitem)
    {
       $this->category_item=$categoryitem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $list_catid = [];
        $category = $this->category_item;
        array_push($list_catid, $category->id);
        $args1 = [
            ['status', '=', '1'],
            ['parent_id', '=', $category->id],
        ];
        $categories1 = Category::where($args1)->get();

        foreach ($categories1 as $category1) {
            array_push($list_catid, $category1->id);
            $args2 = [
                ['status', '=', '1'],
                ['parent_id', '=', $category1->id],
            ];
            $categories2 = Category::where($args2)->get();

            foreach ($categories2 as $category2) {
                array_push($list_catid, $category2->id);
            }
        }
        $products = Product::where('status', '=', 1)
            ->whereIn('category_id', $list_catid)
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        // Trả về view của component
        return view('components.home-product-category', compact('products'));
    }
}
