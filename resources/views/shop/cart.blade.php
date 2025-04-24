<x-layout-site>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Giỏ Hàng</h1>
        @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Danh sách sản phẩm -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thành tiền</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $total = 0; @endphp
                                @foreach(session('cart') as $id => $item)
                                    @php
                                        $price = ($item['price_sale'] ?? 0) > 0 ? $item['price_sale'] : ($item['price_buy'] ?? 0);
                                        $subtotal = $price * $item['qty'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-20 w-20">
                                                    <img class="h-20 w-20 object-contain rounded-md" 
                                                         src="{{ asset('images/product/' . $item['thumbnail']) }}" 
                                                         alt="{{ $item['name'] }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item['name'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(($item['price_sale'] ?? 0) > 0)
                                                <div class="text-sm text-red-600 font-semibold">{{ number_format($item['price_sale'], 0, ',', '.') }}₫</div>
                                                <div class="text-xs text-gray-500 line-through">{{ number_format($item['price_buy'] ?? 0, 0, ',', '.') }}₫</div>
                                            @else
                                                <div class="text-sm text-gray-900">{{ number_format($item['price_buy'] ?? 0, 0, ',', '.') }}₫</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('shop.updatecart') }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <div class="flex items-center border border-gray-300 rounded-md">
                                                    <button type="button" 
                                                            onclick="const qtyInput = this.nextElementSibling; if (parseInt(qtyInput.value) > 1) { qtyInput.value = parseInt(qtyInput.value) - 1; this.closest('form').submit(); }"
                                                            class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <input type="number" 
                                                           name="qty" 
                                                           value="{{ $item['qty'] }}" 
                                                           min="1"
                                                           class="w-12 text-center border-x border-gray-300 py-1 focus:outline-none"
                                                           onchange="this.closest('form').submit()">
                                                    <button type="button" 
                                                            onclick="const qtyInput = this.previousElementSibling; qtyInput.value = parseInt(qtyInput.value) + 1; this.closest('form').submit();"
                                                            class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ number_format($subtotal, 0, ',', '.') }}₫
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('shop.delcart', ['id' => $id]) }}" 
                                               class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tổng tiền và thanh toán -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Tổng giỏ hàng</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tạm tính</span>
                                <span class="text-gray-900 font-medium">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phí vận chuyển</span>
                                <span class="text-gray-900 font-medium">0₫</span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-900 font-semibold">Tổng cộng</span>
                                    <span class="text-2xl font-bold text-blue-600">{{ number_format($total, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                            <a href="{{ route('shop.checkout') }}" 
                               class="block w-full bg-blue-600 text-white text-center py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 mt-6">
                                Tiến hành thanh toán
                            </a>
                            <a href="{{ route('shop.product') }}" 
                               class="block w-full bg-gray-100 text-gray-700 text-center py-3 px-4 rounded-md hover:bg-gray-200 transition duration-200">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-5xl text-gray-400 mb-4">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <p class="text-xl text-gray-600 mb-8">Giỏ hàng của bạn đang trống</p>
                <a href="{{ route('shop.product') }}" 
                   class="inline-block bg-blue-600 text-white py-3 px-8 rounded-md hover:bg-blue-700 transition duration-200">
                    Mua sắm ngay
                </a>
            </div>
        @endif
    </div>
</x-layout-site>
