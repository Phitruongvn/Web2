<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $posts = Post::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'LIKE', "%$search%")
                  ->orWhere('description', 'LIKE', "%$search%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(9);

    return view('shop.post', compact('posts', 'search'));
}

    public function new()
    {
        
        return view('shop.postnew');
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('status', 1)
                    ->firstOrFail();
        
        $related_posts = Post::where('status', 1)
                            ->where('id', '!=', $post->id)
                            ->limit(3)
                            ->get();
                    
        return view('shop.post-detail', compact('post', 'related_posts'));
    }
}
