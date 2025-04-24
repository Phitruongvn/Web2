<x-layout-site>
    <x-slot:title>
        Chi tiết sản phẩm
    </x-slot:title>
    <div class="container mx-auto py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="flex justify-center">
                <img 
                    src="{{ asset('images/product/' . $product->thumbnail) }}" 
                    alt="{{ $product->name }}" 
                    class="w-full max-w-lg object-cover rounded-lg shadow-lg"
                />
            </div>
            
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6">{{ $product->name }}</h1>
                
                <p class="text-2xl font-semibold text-red-600 mb-4">
                    {{ number_format($product->price_sale, 0, ',', '.') }} ₫
                    <span class="line-through text-gray-500 text-lg ml-4">
                        {{ number_format($product->price_buy, 0, ',', '.') }} ₫
                    </span>
                </p>
                
                <!-- Product Description -->
                <p class="text-gray-700 text-lg mb-6 leading-relaxed">
                    {{ $product->description }}
                </p>
                
                <!-- Color Options -->
                <div class="mt-4">
                    <h3 class="text-gray-800 font-medium text-lg mb-2">Màu sắc:</h3>
                    <div class="flex items-center space-x-3">
                        <span class="w-6 h-6 bg-green-600 rounded-full border border-gray-200"></span>
                        <span class="w-6 h-6 bg-blue-600 rounded-full border border-gray-200"></span>
                        <span class="w-6 h-6 bg-gray-600 rounded-full border border-gray-200"></span>
                    </div>
                </div>

                <!-- Quantity Selection -->
                <form action="{{ route('shop.addcart', ['id' => $product->id]) }}" method="POST">
                    @csrf <!-- Quan trọng để bảo mật và đảm bảo form hoạt động -->
                    
                    <h3 class="text-gray-800 font-medium text-lg mb-2">Số lượng:</h3>
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="this.nextElementSibling.stepDown()"
                            class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg hover:bg-gray-300">-</button>
                
                        <input 
                            type="number" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            class="w-16 text-center border border-gray-300 rounded-lg p-2"
                        />
                
                        <button type="button" onclick="this.previousElementSibling.stepUp()"
                            class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg hover:bg-gray-300">+</button>
                    </div>
                
                    <button
                        type="submit"
                        class="mt-8 w-full bg-blue-500 text-white text-lg font-medium py-3 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300"
                    >
                        Thêm vào giỏ hàng
                    </button>
                </form>
                
                
                
            </div>
        </div>
    </div>
</x-layout-site>
