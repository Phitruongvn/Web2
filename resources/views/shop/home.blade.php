<x-layout-site>
    <x-slot:title>
        Tiêu đề trang chủ
    </x-slot:title>
    <x-slot:header>

    </x-slot:header>
    <x-slot:fotter>
        
    </x-slot:fotter>
    <div>
        <section id="home" class="relative w-full h-96 bg-center bg-cover" style="background-image: url('https://bizweb.dktcdn.net/100/456/491/themes/864044/assets/slider_1.jpg?1708522613834');">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Discover Your Style</h1>
                    <p class="text-lg md:text-xl mb-6">Explore our latest collections</p>
                    <a href="#categories" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 rounded text-white text-lg">Shop Now</a>
                </div>
            </div>
        </section>
       
    
        <section id="products" class="py-16 bg-gray-50">
            {{-- <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Sản phẩm mới</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="bg-white p-6 shadow-lg rounded hover:shadow-xl transition">
                        <img src="https://bizweb.dktcdn.net/thumb/large/100/491/897/products/10s23shl036-beige-1-1.png" 
                             alt="New Product 1" class="w-full h-48 object-cover rounded mb-4">
                        <h3 class="font-medium text-lg text-gray-700">Product 1</h3>
                        <p class="text-gray-500 mt-2">$100</p>
                        <a href="#" class="block mt-4 text-blue-500 hover:underline text-center">Xem chi tiết</a>
                    </div>
                    <div class="bg-white p-6 shadow-lg rounded hover:shadow-xl transition">
                        <img src="https://bizweb.dktcdn.net/thumb/large/100/491/897/products/10s23shl035-navy-white-ao-so-mi.png" 
                             alt="New Product 2" class="w-full h-48 object-cover rounded mb-4">
                        <h3 class="font-medium text-lg text-gray-700">Product 2</h3>
                        <p class="text-gray-500 mt-2">$120</p>
                        <a href="#" class="block mt-4 text-blue-500 hover:underline text-center">Xem chi tiết</a>
                    </div>
                </div>
            </div> --}}
            <x-product-new />
            <x-product-sale :products="$products" />
        </section>
        <section id="posts" class="py-16 bg-gray-50">
            {{-- <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Sản phẩm mới</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="bg-white p-6 shadow-lg rounded hover:shadow-xl transition">
                        <img src="https://bizweb.dktcdn.net/thumb/large/100/491/897/products/10s23shl036-beige-1-1.png" 
                             alt="New Product 1" class="w-full h-48 object-cover rounded mb-4">
                        <h3 class="font-medium text-lg text-gray-700">Product 1</h3>
                        <p class="text-gray-500 mt-2">$100</p>
                        <a href="#" class="block mt-4 text-blue-500 hover:underline text-center">Xem chi tiết</a>
                    </div>
                    <div class="bg-white p-6 shadow-lg rounded hover:shadow-xl transition">
                        <img src="https://bizweb.dktcdn.net/thumb/large/100/491/897/products/10s23shl035-navy-white-ao-so-mi.png" 
                             alt="New Product 2" class="w-full h-48 object-cover rounded mb-4">
                        <h3 class="font-medium text-lg text-gray-700">Product 2</h3>
                        <p class="text-gray-500 mt-2">$120</p>
                        <a href="#" class="block mt-4 text-blue-500 hover:underline text-center">Xem chi tiết</a>
                    </div>
                </div>
            </div> --}}
            <x-post-new />
        </section>
    </div>
</x-layout-site>