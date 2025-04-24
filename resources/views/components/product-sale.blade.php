@props(['products'])

<div class="product-sale py-12 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="flex items-center justify-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 relative">
                Sản phẩm giảm giá
                
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products->where('price_sale', '<', 'price_buy')->take(4) as $product)
            <div class="group relative bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                <!-- Badge giảm giá -->
                @if($product->price_sale < $product->price_buy)
                    @php
                        $discount = round((($product->price_buy - $product->price_sale) / $product->price_buy) * 100);
                    @endphp
                    <div class="absolute top-4 right-4 z-10 bg-red-500 text-white text-sm font-bold px-2 py-1 rounded-md">
                        -{{ $discount }}%
                    </div>
                @endif

                <!-- Ảnh sản phẩm -->
                <div class="relative overflow-hidden aspect-w-1 aspect-h-1">
                    <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}">
                        <img 
                            src="{{ asset('images/product/' . $product->thumbnail) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-64 object-cover object-center transform group-hover:scale-110 transition-transform duration-500"
                        />
                    </a>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-800 mb-2 h-14 line-clamp-2 hover:text-blue-600 transition">
                        <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}">
                            {{ $product->name }}
                        </a>
                    </h3>

                    <div class="flex items-baseline mb-4">
                        <span class="text-xl font-bold text-red-600">
                            {{ number_format($product->price_sale, 0, ',', '.') }}₫
                        </span>
                        <span class="ml-2 text-sm text-gray-500 line-through">
                            {{ number_format($product->price_buy, 0, ',', '.') }}₫
                        </span>
                    </div>

                    <!-- Nút thao tác -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}" 
                           class="p-2 text-blue-600 hover:text-blue-700 transition-colors duration-200"
                           title="Xem chi tiết">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <form action="{{ route('shop.addcart', ['id' => $product->id]) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="p-2 text-green-600 hover:text-green-700 transition-colors duration-200"
                                title="Thêm vào giỏ hàng">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>