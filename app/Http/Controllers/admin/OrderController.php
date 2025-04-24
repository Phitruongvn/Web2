<?php

namespace App\Http\Controllers\admin;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')
            ->select("id","user_id","name", "email", "phone", "address", "status")
            ->with(['user'])
            ->paginate(5);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // xử lý thêm
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $orders = Order::where('id', $id)->first();
        if ($orders == null) {
            return redirect()->back()->with('error', 'Không tồn tại mẫu tin');
        }
        return view('admin.order.show', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        return view('admin.order.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        // xử lý cập nhật
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $orders = Order::withTrashed()->where('id', $id)->first();
        if ($orders != null) {
            //Xóa hình
            if ($orders->image && File::exists(public_path("images/order/" . $orders->image))) {
                File::delete(public_path("images/order/" . $orders->image));
            }
            $orders->forceDelete();
            return redirect()->route('admin.order.trash')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.order.trash')->with('error', 'Mẫu tin không tồn tại');
    }

    public function trash() {
        $orders = Order::onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        return view('admin.order.trash', compact('orders'));
    }

    public function status(string $id)
    {
        $order = Order::find($id);
        if($order == null) {
            return redirect()->route('admin.order.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }

        // Chuyển đổi trạng thái
        $order->status = ($order->status == 1) ? 2 : 1;
        $order->updated_by = Auth::id() ?? 1;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();

        return redirect()->route('admin.order.index')
            ->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
    }
    public function delete(string $id) {
        $orders = Order::find($id);
        if($orders == null) {
            return redirect()->route('admin.order.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $orders->delete();
        return redirect()->route('admin.order.index')->with('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công!']);
    }

    public function restore(string $id)
    {
        $orders = Order::withTrashed()->where('id', $id);
        if ($orders->first() != null) {
            $orders->restore();
            return redirect()->route('admin.order.trash')->with('success', 'Khôi phục thành công');
        }
        return redirect()->route('admin.order.trash')->with('error', 'Mẫu tin không tồn tại');
    }
}
