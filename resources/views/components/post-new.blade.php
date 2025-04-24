<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Bài viết mới</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($posts->take(4) as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('shop.post.detail', $post->slug) }}" class="block relative">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('images/post/' . $post->thumbnail) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-64 object-cover">
                    </div>
                </a>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2 line-clamp-2">
                        <a href="{{ route('shop.post.detail', $post->slug) }}" 
                           class="hover:text-blue-500 transition-colors duration-200">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                    <a href="{{ route('shop.post.detail', $post->slug) }}" 
                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-sm transition-colors duration-200">
                        Đọc thêm
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>  
