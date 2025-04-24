<x-layout-site>
    <x-slot:title>
        {{ $category->name }} - Sản phẩm
    </x-slot:title>

    <div class="bg-gray-50">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-50 to-indigo-100 text-gray-800 py-10">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
            </div>
        </section>

        <div class="container mx-auto py-8 px-4">
            <!-- Filter Section -->
            <section aria-labelledby="filter-heading" class="mb-8">
                <h2 id="filter-heading" class="sr-only">Bộ lọc sản phẩm</h2>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <form action="{{ request()->url() }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                        <!-- Price Min -->
                        <div>
                            <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Giá từ</label>
                            <input 
                                type="number" 
                                id="price_min"
                                name="price_min" 
                                value="{{ request('price_min') }}" 
                                placeholder="0" 
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                        </div>
                        <!-- Price Max -->
                        <div>
                            <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Giá đến</label>
                            <input 
                                type="number" 
                                id="price_max"
                                name="price_max" 
                                value="{{ request('price_max') }}" 
                                placeholder="Không giới hạn" 
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                        </div>
                        <!-- Brand -->
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Thương hiệu</label>
                            <select id="brand" name="brand" class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Tất cả</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->slug }}" {{ request('brand') == $brand->slug ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <div>
                             <input type="hidden" name="view" value="{{ request('view', 'grid') }}" id="viewTypeInput"> {{-- Keep view type on submit --}}
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                <i class="fas fa-filter mr-2"></i> Lọc
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Product Listing Section -->
            <section aria-labelledby="product-heading">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="product-heading" class="text-xl font-semibold text-gray-900">{{ $products->total() }} Kết quả</h2>
                    <!-- View Mode Toggle -->
                    <div class="flex space-x-1 border border-gray-300 rounded-md p-0.5">
                        <button id="toggle-grid" class="px-3 py-1 rounded-md text-sm transition" aria-label="Chế độ lưới">
                            <i class="fas fa-th"></i>
                        </button>
                        <button id="toggle-list" class="px-3 py-1 rounded-md text-sm transition" aria-label="Chế độ danh sách">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Product Grid / List -->
                <div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <div class="product-item group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
                            <!-- Ảnh sản phẩm với tỷ lệ cố định -->
                            <div class="relative w-full pt-[100%]">
                                <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}" class="absolute top-0 left-0 w-full h-full z-20">
                                    <img 
                                        src="{{ asset('images/product/' . $product->thumbnail) }}" 
                                        alt="{{ $product->name }}" 
                                        class="absolute top-0 left-0 w-full h-full object-contain bg-gray-100"
                                    />
                                </a>
                                <!-- Overlay khi hover -->
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-opacity duration-300 z-10"></div>
                            </div>
                            <!-- Thông tin sản phẩm -->
                            <div class="p-4">
                                <h3 class="text-sm font-medium text-gray-900 line-clamp-2">
                                    <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}" class="hover:text-blue-600">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <div class="mt-2">
                                    @if($product->price_sale > 0 && $product->price_sale < $product->price_buy)
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ number_format($product->price_sale, 0, ',', '.') }}₫
                                        </p>
                                        <p class="text-sm text-gray-500 line-through">
                                            {{ number_format($product->price_buy, 0, ',', '.') }}₫
                                        </p>
                                    @else
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ number_format($product->price_buy, 0, ',', '.') }}₫
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <!-- Bottom overlay khi hover -->
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 flex justify-between items-center z-20">
                                <div>
                                    @if($product->price_sale > 0 && $product->price_sale < $product->price_buy)
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ number_format($product->price_sale, 0, ',', '.') }}₫
                                        </p>
                                        <p class="text-sm text-gray-500 line-through">
                                            {{ number_format($product->price_buy, 0, ',', '.') }}₫
                                        </p>
                                    @else
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ number_format($product->price_buy, 0, ',', '.') }}₫
                                        </p>
                                    @endif
                                </div>
                                <form action="{{ route('shop.addcart', ['id' => $product->id]) }}" method="POST" class="flex-shrink-0">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">Không tìm thấy sản phẩm nào phù hợp.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </section>
        </div>
    </div>

    <!-- Toggle Script -->
    <script>
        // Giữ nguyên script từ product.blade.php để xử lý Lưới/Danh sách và localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const toggleGrid = document.getElementById('toggle-grid');
            const toggleList = document.getElementById('toggle-list');
            const productContainer = document.getElementById('product-container');
            const productItems = productContainer.querySelectorAll('.product-item');
            let currentView = localStorage.getItem('productView') || 'grid'; 
            const viewTypeInput = document.getElementById('viewTypeInput'); // Get hidden input

            function applyView(view) {
                viewTypeInput.value = view; // Update hidden input value when view changes
                
                if (view === 'list') {
                    productContainer.classList.remove('grid', 'sm:grid-cols-2', 'lg:grid-cols-4', 'gap-x-6', 'gap-y-10');
                    productContainer.classList.add('flex', 'flex-col', 'gap-y-4');
                    productItems.forEach(item => {
                        item.classList.remove('flex-col');
                        item.classList.add('flex-row');
                        const imageLink = item.querySelector('a[href*="product-detail"]');
                        const textDiv = item.querySelector('.px-4.pt-4.pb-5');
                        if (imageLink) {
                            imageLink.classList.remove('aspect-w-1', 'aspect-h-1', 'rounded-t-lg');
                            imageLink.classList.add('w-40', 'h-40', 'flex-shrink-0', 'rounded-l-lg');
                            imageLink.querySelector('img').classList.add('rounded-l-lg');
                            imageLink.querySelector('img').classList.remove('rounded-t-lg');
                            const overlay = imageLink.querySelector('.absolute.inset-0');
                            if(overlay) overlay.classList.add('hidden');
                        }
                        if (textDiv) {
                            textDiv.classList.add('flex-grow');
                        }
                    });
                    toggleList.classList.add('bg-blue-600', 'text-white');
                    toggleList.classList.remove('bg-gray-100', 'text-gray-500');
                    toggleGrid.classList.add('bg-gray-100', 'text-gray-500');
                    toggleGrid.classList.remove('bg-blue-600', 'text-white');
                } else { // Grid view
                    productContainer.classList.remove('flex', 'flex-col', 'gap-y-4');
                    productContainer.classList.add('grid', 'sm:grid-cols-2', 'lg:grid-cols-4', 'gap-x-6', 'gap-y-10');
                    productItems.forEach(item => {
                        item.classList.add('flex-col');
                        item.classList.remove('flex-row');
                        const imageLink = item.querySelector('a[href*="product-detail"]');
                        const textDiv = item.querySelector('.px-4.pt-4.pb-5');
                        if (imageLink) {
                            imageLink.classList.add('aspect-w-1', 'aspect-h-1', 'rounded-t-lg');
                            imageLink.classList.remove('w-40', 'h-40', 'flex-shrink-0', 'rounded-l-lg');
                            imageLink.querySelector('img').classList.remove('rounded-l-lg');
                            imageLink.querySelector('img').classList.add('rounded-t-lg');
                            const overlay = imageLink.querySelector('.absolute.inset-0');
                            if(overlay) overlay.classList.remove('hidden');
                        }
                        if (textDiv) {
                            textDiv.classList.remove('flex-grow');
                        }
                    });
                    toggleGrid.classList.add('bg-blue-600', 'text-white');
                    toggleGrid.classList.remove('bg-gray-100', 'text-gray-500');
                    toggleList.classList.add('bg-gray-100', 'text-gray-500');
                    toggleList.classList.remove('bg-blue-600', 'text-white');
                }
                localStorage.setItem('productView', view);
            }

            applyView(currentView);

            toggleGrid.addEventListener('click', () => applyView('grid'));
            toggleList.addEventListener('click', () => applyView('list'));
        });
    </script>

</x-layout-site>
