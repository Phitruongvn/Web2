<x-layout-site>
    <x-slot:title>
        Tìm kiếm: {{ $query }} | Sudes Fashion
    </x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Kết quả tìm kiếm: "{{ $query }}"</h1>

        @if($results->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($results as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <a href="{{ route('shop.product.detail', $product->slug) }}">
                            <img src="{{ asset('images/product/' . $product->thumbnail) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-80 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                <a href="{{ route('shop.product.detail', $product->slug) }}" 
                                   class="hover:text-blue-500">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-red-500 font-bold">
                                {{ number_format($product->price_buy, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Không tìm thấy kết quả phù hợp với từ khóa "{{ $query }}".</p>
        @endif
    </div>
</x-layout-site>
