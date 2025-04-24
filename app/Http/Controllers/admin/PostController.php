<?php

namespace App\Http\Controllers\admin;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')
            ->select("id",  "topic_id", "title", "slug", "thumbnail", "status","type")
            ->with(['topic'])
            ->paginate(5);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy danh sách posts để sắp xếp
        $posts = Post::orderBy('created_at', 'ASC')
            ->select('id', 'title')
            ->get();
        
        // Lấy danh sách topics để hiển thị trong dropdown
        $topics = Topic::orderBy('name', 'ASC')
            ->select('id', 'name')
            ->get();

        // Lấy các loại post không trùng lặp
        $types = Post::select('type')
            ->distinct()
            ->pluck('type');

        return view('admin.post.create', compact('posts', 'topics', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            // Debug thông tin request
            \Log::info('Post Data:', $request->all());
            
            $post = new Post();
            
            // Kiểm tra và xử lý thumbnail
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->extension();
                $filename = date('YmdHis') . "." . $extension;
                $file->move(public_path('images/post'), $filename);
                $post->thumbnail = $filename;
            } else {
                \Log::error('No thumbnail uploaded');
                return back()->with('error', 'Chưa chọn hình');
            }
            
            // Gán các trường dữ liệu
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->type = $request->type;
            $post->topic_id = $request->topic_id;
            $post->content = $request->content;
            $post->description = $request->description;
            $post->created_by = Auth::id() ?? 1;
            $post->status = $request->status;
            
            // Debug thông tin post trước khi lưu
            \Log::info('Post Object before save:', $post->toArray());
            
            // Lưu và kiểm tra kết quả
            if($post->save()) {
                \Log::info('Post saved successfully with ID: ' . $post->id);
                return redirect()->route('admin.post.index')->with('success', 'Thêm thành công');
            } else {
                \Log::error('Failed to save post');
                return back()->with('error', 'Không thể lưu bài viết');
            }
        } catch (\Exception $e) {
            \Log::error('Error in store method: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $posts = Post::where('id', $id)->first();
        if ($posts == null) {
            return redirect()->back()->with('error', 'Không tồn tại mẫu tin');
        }
        return view('admin.post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $posts = Post::orderBy('created_at', 'ASC')
            ->select('id', 'title')
            ->get();
        $topics = Topic::orderBy('name', 'ASC')
            ->select('id', 'name')
            ->get();
        $types = Post::select('type')
            ->distinct()
            ->pluck('type');
        
        return view('admin.post.edit', compact('post', 'posts', 'topics', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->type = $request->type;
        $post->topic_id = $request->topic_id;
        $post->content = $request->content;
        $post->description = $request->description;
        //upload file
        if ($request->hasFile('thumbnail')) {
            //Xóa hình cũ
            if ($post->thumbnail && File::exists(public_path("images/post/" . $post->thumbnail))) {
                File::delete(public_path("images/post/" . $post->thumbnail));
            }
            $file = $request->file('thumbnail');
            $extension = $file->extension();
            $filename = date('YmdHis') . "." . $extension;
            $file->move(public_path('images/post'), $filename);
            $post->thumbnail = $filename;
        }
        //end upload file
        $post->updated_by = Auth::id() ?? 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->status = $request->status;
        if ($post->save()) {
            return redirect()->route('admin.post.index')->with('success', 'Post update successfully');
        }
        return redirect()->back()->with('error', 'Failed to update post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
{
    $posts = Post::withTrashed()->where('id', $id)->first();
    if ($posts != null) {
        //Xóa hình
        if ($posts->image && File::exists(public_path("images/post/" . $posts->image))) {
            File::delete(public_path("images/post/" . $post->image));
        }
        $posts->forceDelete();
        return redirect()->route('admin.post.trash')->with('success', 'Xóa thành công');
    }
    return redirect()->route('admin.post.trash')->with('error', 'Mẫu tin không tồn tại');
}

    public function trash() {
        $posts = Post::onlyTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        return view('admin.post.trash', compact('posts'));
    }

    public function status(string $id)
    {
        $post = Post::find($id);
        if($post == null) {
            return redirect()->route('admin.post.index')
                ->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }

        // Chuyển đổi trạng thái
        $post->status = ($post->status == 1) ? 2 : 1;
        $post->updated_by = Auth::id() ?? 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();

        return redirect()->route('admin.post.index')
            ->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
    }

    public function delete(string $id) {
        $posts = Post::find($id);
        if($posts == null) {
            return redirect()->route('admin.post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $posts->delete();
        return redirect()->route('admin.post.index')->with('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công!']);
    }

    public function restore(string $id)
    {
        $posts = Post::withTrashed()->where('id', $id);
        if ($posts->first() != null) {
            $posts->restore();
            return redirect()->route('admin.post.trash')->with('success', 'Khôi phục thành công');
        }
        return redirect()->route('admin.post.trash')->with('error', 'Mẫu tin không tồn tại');
    }
}
