<?php

namespace App\Http\Controllers\admin;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')
            ->select("id", "name","link", "status","type","position")
            ->paginate(5);
    
        return view('admin.menu.index', compact('menus'));
        
     
    }


    public function create() {
        return view('admin.menu.create');
    }

    public function store(Request $request) {
        // xử lý thêm
    }

    public function show(string $id)
    {
        $menus = Menu::where('id', $id)->first();
        if ($menus == null) {
            return redirect()->back()->with('error', 'Không tồn tại mẫu tin');
        }
        return view('admin.menu.show', compact('menus'));
    }

    public function edit(string $id)
    {
        $menu = Menu::where('id', $id)->first();
        if ($menu == null) {
            return redirect()->route('admin.menu.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Menu không tồn tại!']);
        }
        
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, string $id)
    {
        $menu = Menu::where('id', $id)->first();
        if ($menu == null) {
            return redirect()->route('admin.menu.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Menu không tồn tại!']);
        }

        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->table_id = $request->table_id;
        $menu->position = $request->position;
        $menu->sort_order = $request->sort_order;
        $menu->updated_by = Auth::id() ?? 1;
        $menu->status = $request->status;
        
        if ($menu->save()) {
            return redirect()->route('admin.menu.index')
                ->with('message', ['type' => 'success', 'msg' => 'Cập nhật menu thành công!']);
        }
        return redirect()->back()
            ->with('message', ['type' => 'danger', 'msg' => 'Cập nhật menu thất bại!']);
    }

    public function destroy(string $id)
    {
        $menus = Menu::withTrashed()->where('id', $id)->first();
        if ($menus != null) {
            //Xóa hình
            if ($menus->image && File::exists(public_path("images/menu/" . $menus->image))) {
                File::delete(public_path("images/post/" . $post->image));
            }
            $menus->forceDelete();
            return redirect()->route('admin.menu.trash')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.menu.trash')->with('error', 'Mẫu tin không tồn tại');
    }

    public function trash() {
        $menus = Menu::onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        return view('admin.menu.trash', compact('menus'));
    }

    public function status(string $id)
    {
        $menu = Menu::find($id);
        if($menu == null) {
            return redirect()->route('admin.menu.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }

        // Chuyển đổi trạng thái
        $menu->status = ($menu->status == 1) ? 2 : 1;
        $menu->updated_by = Auth::id() ?? 1;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->save();

        return redirect()->route('admin.menu.index')
            ->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
    }

    public function delete(string $id) {
        $menus = Menu::find($id);
        if($menus == null) {
            return redirect()->route('admin.menu.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $menus->delete();
        return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công!']);
    }

    public function restore(string $id)
    {
        $menus = Menu::withTrashed()->where('id', $id);
        if ($menus->first() != null) {
            $menus->restore();
            return redirect()->route('admin.menu.trash')->with('success', 'Khôi phục thành công');
        }
        return redirect()->route('admin.menu.trash')->with('error', 'Mẫu tin không tồn tại');
    }
}
