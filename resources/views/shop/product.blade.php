<x-layout-site>
  <x-slot:title>
      Tất cả Sản phẩm
  </x-slot:title>
  <x-slot:header></x-slot:header>
  <x-slot:footer></x-slot:footer>
  
  <div>
      <!-- Hero Section -->
      <section class="bg-white text-black py-12">
          <div class="container mx-auto text-center">
              <h1 class="text-4xl font-bold mb-4">Tất cả Sản phẩm</h1>
              <p class="text-lg text-gray-600">
                  Khám phá tất cả các sản phẩm thời trang mới nhất của chúng tôi.
              </p>
          </div>
      </section>

      <!-- Filter Form -->
      <form action="{{ route('shop.product') }}" method="GET" class="flex space-x-4 mb-6">
          <input 
              type="text" 
              name="search" 
              value="{{ request('search') }}" 
              placeholder="Tìm kiếm sản phẩm" 
              class="p-2 border rounded w-full"
          >
          <input 
              type="number" 
              name="price_min" 
              value="{{ request('price_min') }}" 
              placeholder="Giá từ" 
              class="p-2 border rounded w-full"
          >
          <input 
              type="number" 
              name="price_max" 
              value="{{ request('price_max') }}" 
              placeholder="Giá đến" 
              class="p-2 border rounded w-full"
          >
          <select name="brand" class="p-2 border rounded w-full">
              <option value="">Chọn thương hiệu</option>
              @foreach($brands as $brand)
                  <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                      {{ $brand->name }}
                  </option>
              @endforeach
          </select>
          <select name="category" class="p-2 border rounded w-full">
              <option value="">Chọn danh mục</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                  </option>
              @endforeach
          </select>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lọc</button>
      </form>

      <!-- View Mode Toggle -->
      <div class="container mx-auto flex justify-end mb-6">
          <button id="toggle-grid" class="bg-blue-500 text-white px-4 py-2 rounded-l">
              <i class="fas fa-th"></i> Lưới
          </button>
          <button id="toggle-list" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-r">
              <i class="fas fa-list"></i> Danh sách
          </button>
      </div>

      <!-- Product Listing Section -->
      <section class="py-16 bg-gray-100">
          <div class="container mx-auto">
              <h2 class="text-2xl font-bold text-gray-800 mb-6">Danh sách sản phẩm</h2>
              <div id="product-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                  @foreach ($products as $item)
                  <div class="product-card bg-white border rounded-lg shadow-sm hover:shadow-lg transition">
                      <!-- Product Link -->
                      <a href="{{ route('shop.product.detail', ['slug' => $item->slug]) }}" class="block">
                          <img 
                              src="{{ asset('images/product/' . $item->thumbnail) }}" 
                              alt="{{ $item->name }}" 
                              class="w-full h-80 object-cover rounded-t-lg transition-transform hover:scale-105 duration-300"
                          />
                      </a>
                      <div class="p-4">
                          <!-- Product Name -->
                          <h3 class="text-lg font-semibold text-gray-800 mb-2">
                              <a href="{{ route('shop.product.detail', ['slug' => $item->slug]) }}">
                                  {{ $item->name }}
                              </a>
                          </h3>
                          <!-- Product Price -->
                          <p class="text-2xl font-semibold text-red-600 mb-4">
                              {{ number_format($item->price_sale, 0, ',', '.') }} ₫
                              <span class="line-through text-gray-500 text-lg ml-4">
                                  {{ number_format($item->price_buy, 0, ',', '.') }} ₫
                              </span>
                          </p>
                          <!-- Add to Cart Button -->
                          <!-- Add to Cart Button -->
                        <form action="{{ route('shop.addcart', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="block w-full bg-blue-500 text-white text-sm font-medium mt-4 py-2 rounded-lg hover:bg-blue-600 transition"
                            >
                                Thêm vào giỏ hàng
                            </button>
                        </form>

                      </div>
                  </div>
                  @endforeach
                  
              </div>
              <div class="mt-8">
                {{ $products->links('pagination::tailwind') }}
            </div>
          </div>
      </section>
  </div>

  <!-- Toggle Script -->
  <script>
      const toggleGrid = document.getElementById('toggle-grid');
      const toggleList = document.getElementById('toggle-list');
      const productContainer = document.getElementById('product-container');

      toggleGrid.addEventListener('click', () => {
          productContainer.classList.remove('flex', 'flex-col');
          productContainer.classList.add('grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4');
          toggleGrid.classList.add('bg-blue-500', 'text-white');
          toggleList.classList.remove('bg-blue-500', 'text-white');
      });

      toggleList.addEventListener('click', () => {
          productContainer.classList.remove('grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4');
          productContainer.classList.add('flex', 'flex-col');
          toggleList.classList.add('bg-blue-500', 'text-white');
          toggleGrid.classList.remove('bg-blue-500', 'text-white');
      });
  </script>
</x-layout-site>
