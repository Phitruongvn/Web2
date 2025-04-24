<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart')->with('error', 'Giỏ hàng của bạn đang trống');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price_buy'] * $item['qty'];
        }

        return view('shop.checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'user_id' => 'required|numeric'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng',
            'user_id.required' => 'Vui lòng đăng nhập để đặt hàng'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng kiểm tra lại thông tin',
                'errors' => $validator->errors()
            ], 422);
        }

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng của bạn đang trống'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Tạo đơn hàng
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price_buy'] * $item['qty'];
            }

            $order = Order::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'created_by' => $request->user_id,
                'updated_by' => $request->user_id,
                'status' => 1
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($cart as $item) {
                // Lấy thông tin sản phẩm
                $product = Product::find($item['id']);
                if (!$product) {
                    throw new \Exception("Không tìm thấy sản phẩm");
                }

                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product->id;
                $orderDetail->price = $item['price_buy'];
                $orderDetail->qty = $item['qty'];
                $orderDetail->amount = $item['price_buy'] * $item['qty'];
                $orderDetail->discount = 0;
                $orderDetail->thumbnail = $product->thumbnail;
                $orderDetail->save();

                // Cập nhật số lượng sản phẩm
                if ($product->qty < $item['qty']) {
                    throw new \Exception("Sản phẩm {$item['name']} không đủ số lượng");
                }
                $product->qty -= $item['qty'];
                $product->save();
            }

            DB::commit();

            // Xóa giỏ hàng
            Session::forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Đặt hàng thành công',
                'redirect' => route('shop.thanks')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function thanks()
    {
        return view('shop.thanks');
    }

    public function userOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('shop.login')
                           ->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        $orders = Order::where('user_id', Auth::user()->id)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('shop.orders', compact('orders'));
    }

    public function orderDetail($id)
    {
        if (!Auth::check()) {
            return redirect()->route('shop.login')
                           ->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        $order = Order::with(['orderDetails.product'])
                     ->where('user_id', Auth::user()->id)
                     ->findOrFail($id);
        
        return view('shop.order-detail', compact('order'));
    }
} 