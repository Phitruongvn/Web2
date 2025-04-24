<?php

namespace App\Http\Controllers\shop;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view('shop.cart');
    }

    public function addcart(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if(isset($cart[$id])) {
            $cart[$id]['qty'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'thumbnail' => $product->thumbnail,
                'price_buy' => $product->price_buy,
                'price_sale' => $product->price_sale,
                'qty' => $quantity
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->qty){
            $cart = Session::get('cart');
            $cart[$request->id]["qty"] = $request->qty;
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
    }

    public function delCart($id = null)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Giỏ hàng đã được xóa');
    }
}
