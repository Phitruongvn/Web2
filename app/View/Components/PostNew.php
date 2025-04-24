<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostNew extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Lấy bài viết mới nhất (giới hạn 5 bài viết)
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('components.post-new', compact('posts'));
    }
}
