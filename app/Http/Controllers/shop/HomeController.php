<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
   function index(){
    // Lấy tất cả sản phẩm có status = 1
    $products = Product::where('status', 1)->get();
    return view('shop.home', compact('products'));
   }

   public function search(Request $request)
   {
       $query = $request->input('query');

       // Search logic: Adjust based on your data and model
       $results = Product::query()
           ->where('name', 'LIKE', "%$query%")
           ->orWhere('description', 'LIKE', "%$query%")
           ->get();

       return view('shop.results', compact('results', 'query'));
   }
}
