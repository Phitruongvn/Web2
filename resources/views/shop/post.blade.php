<x-layout-site>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Tiêu đề và tìm kiếm -->
            <div class="mb-8 flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">
                    Danh sách bài viết
                </h1>
                <form action="{{ route('shop.post') }}" method="GET" class="w-full md:w-1/3">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Tìm kiếm bài viết..." 
                            class="w-full p-2 pl-10 border border-gray-300 rounded-md"
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>

            <!-- Danh sách bài viết -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                        <a href="{{ route('shop.post.detail', ['slug' => $post->slug]) }}">
                            <img 
                            src="{{ file_exists(public_path('images/post/' . $post->thumbnail)) ? asset('images/post/' . $post->thumbnail) : asset('images/default-thumbnail.jpg') }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-auto object-cover"
                        />
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-gray-600">
                                <a href="{{ route('shop.post.detail', ['slug' => $post->slug]) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div class="text-sm text-gray-500 mb-2">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ $post->created_at->format('d/m/Y') }}
                            </div>
                            <p class="text-gray-700 text-sm line-clamp-3">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-layout-site>
