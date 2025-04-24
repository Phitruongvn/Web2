<?php

namespace App\Http\Controllers\admin;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::orderBy('created_at', 'DESC')
            ->paginate(5);
    
        return view('admin.topic.index', compact('topics'));
        
     
    }
    public function create()
    {
        $topics = Topic::orderBy('sort_order', 'ASC')
            ->select('id', 'name', 'sort_order')
            ->get();
        
        return view('admin.topic.create', compact('topics'));
    }

    public function store(StoreTopicRequest $request)
    {
        try {
            // Debug thông tin request
            \Log::info('Topic Data:', $request->all());
            
            $topic = new Topic();
            $topic->name = $request->name;
            $topic->slug = $request->slug;
            $topic->description = $request->description;
            $topic->sort_order = $request->sort_order;
            $topic->created_by = Auth::id() ?? 1;
            $topic->status = $request->status;
            
            // Debug thông tin topic trước khi lưu
            \Log::info('Topic Object before save:', $topic->toArray());
            
            if($topic->save()) {
                \Log::info('Topic saved successfully with ID: ' . $topic->id);
                return redirect()->route('admin.topic.index')->with('success', 'Thêm chủ đề thành công');
            } else {
                \Log::error('Failed to save topic');
                return back()->with('error', 'Không thể lưu chủ đề');
            }
        } catch (\Exception $e) {
            \Log::error('Error in store method: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $topics = Topic::where('id', $id)->first();
        if ($topics == null) {
            return redirect()->back()->with('error', 'Không tồn tại mẫu tin');
        }
        return view('admin.topic.show', compact('topics'));
    }

    public function edit(string $slug)
    {
        $topic = Topic::where('slug', $slug)->first();
        $topics = Topic::orderBy('sort_order', 'ASC')
            ->select("id", "name", "sort_order", "status")
            ->get();
        
        return view('admin.topic.edit', compact('topic', 'topics'));
    }

    public function update(UpdateTopicRequest $request, string $slug)
    {
        $topic = Topic::where('slug', $slug)->first();
        $topic->name = $request->name;
        $topic->slug = $request->slug;
        $topic->description = $request->description;
        $topic->sort_order = $request->sort_order;
        $topic->updated_by = Auth::id() ?? 1;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->status = $request->status;
        if ($topic->save()) {
            return redirect()->route('admin.topic.index')->with('success', 'Topic update successfully');
        }
        return redirect()->back()->with('error', 'Failed to update topic');
    }

    public function destroy(string $id)
    {
        $topics = Topic::withTrashed()->where('id', $id)->first();
        if ($topics != null) {
            //Xóa hình
            if ($topics->image && File::exists(public_path("images/topic/" . $topics->image))) {
                File::delete(public_path("images/topic/" . $topics->image));
            }
            $topics->forceDelete();
            return redirect()->route('admin.topic.trash')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.topic.trash')->with('error', 'Mẫu tin không tồn tại');
    }
    public function trash() {
        $topics = Topic::onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        return view('admin.topic.trash', compact('topics'));
    }

    public function status(string $id)
    {
        $topic = Topic::find($id);
        if($topic == null) {
            return redirect()->route('admin.topic.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }

        // Chuyển đổi trạng thái
        $topic->status = ($topic->status == 1) ? 2 : 1;
        $topic->updated_by = Auth::id() ?? 1;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->save();

        return redirect()->route('admin.topic.index')
            ->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
    }

    public function delete(string $id) {
        $topics = Topic::find($id);
        if($topics == null) {
            return redirect()->route('admin.topic.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $topics->delete();
        return redirect()->route('admin.topic.index')->with('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công!']);
    }

    public function restore(string $id)
    {
        $topics = Topic::withTrashed()->where('id', $id);
        if ($topics->first() != null) {
            $topics->restore();
            return redirect()->route('admin.topic.trash')->with('success', 'Khôi phục thành công');
        }
        return redirect()->route('admin.topic.trash')->with('error', 'Mẫu tin không tồn tại');
    }
}
