<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        // Filtering
        $products->when($request->input('search'), function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%");
        });

        $products->when($request->input('price_min'), function ($query, $priceMin) {
            $query->where('price_buy', '>=', $priceMin);
        });

        $products->when($request->input('price_max'), function ($query, $priceMax) {
            $query->where('price_buy', '<=', $priceMax);
        });

        $products->when($request->input('brand'), function ($query, $brandId) {
            $query->where('brand_id', $brandId);
        });

        $products->when($request->input('category'), function ($query, $categoryId) {
            $query->where('category_id', $categoryId);
        });

        // Sorting
        if ($request->input('sort') == 'price_high_to_low') {
            $products->orderBy('price_sale', 'desc');
        } elseif ($request->input('sort') == 'price_low_to_high') {
            $products->orderBy('price_sale', 'asc');
        }

        // Apply pagination **after** sorting and filtering
        $products = $products->paginate(8);

        $brands = Brand::all();
        $categories = Category::all();

        return view('shop.product', compact('products', 'brands', 'categories'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop.product-detail', compact('product'));
    }
    public function productsByCategory(Request $request, $categorySlug)
    {
        $filters = $request->only(['search', 'price_min', 'price_max', 'brand']);
        $sortBy = $request->input('sort_by', 'newest');
        $viewType = $request->input('view', 'grid'); // Default to 'grid'

        // Lấy danh mục theo slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Lọc sản phẩm theo danh mục
        $products = Product::where('category_id', $category->id)
            ->filter($filters)
            ->sort($sortBy)
            ->paginate(12);

        $brands = Brand::all();
        $categories = Category::all();

        return view('shop.product-category', compact(
            'products',
            'category',
            'brands',
            'categories',
            'filters',
            'sortBy',
            'viewType'
        ));
    }

    public function productsByBrand(Request $request, $brandSlug)
    {
        $filters = $request->only(['search', 'price_min', 'price_max', 'category']);
        $sortBy = $request->input('sort_by', 'newest');
        $viewType = $request->input('view', 'grid'); // Default to 'grid'

        // Lấy thương hiệu theo slug
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();

        // Lọc sản phẩm theo thương hiệu
        $products = Product::where('brand_id', $brand->id)
            ->filter($filters)
            ->sort($sortBy)
            ->paginate(12);

        $brands = Brand::all();
        $categories = Category::all();

        return view('shop.product-brand', compact(
            'products',
            'brand',
            'brands',
            'categories',
            'filters',
            'sortBy',
            'viewType'
        ));
    }

    public function allCategories()
    {
        $categories = Category::with(['products' => function($query) {
            $query->take(4); // Lấy 4 sản phẩm mới nhất cho mỗi danh mục
        }])->get();

        return view('shop.categories', compact('categories'));
    }

    public function allBrands()
    {
        $brands = Brand::all();
        return view('shop.brands', compact('brands'));
    }
}
