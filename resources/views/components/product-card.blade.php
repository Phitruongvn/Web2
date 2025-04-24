<div class="productcard border bg-white">
    <div class="group overflow-hidden relative">
        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
            <img class="group-hover:scale-105 w-full" 
            src="{{ asset('images/product/product.webp') }}" 
            alt="hinh">
    </a>
    </div>
    <div class="p-2">
        <h2 class="text-purple-500 text-xl text-center">{{ $product->name }}</h2>
        <div class="flex justify-between items-center">
            <h3 class="text-purple-500 font-bold">{{$product->price}}</h3>
        <a href="{{ route('shop.product.detail', ['slug' => $product->slug]) }}">Chi tiết</a>
        </div>
    </div>
</div>