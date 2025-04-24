<x-layout-site>
    <x-slot:title>
        Chi tiết đơn hàng #{{ $order->id }}
    </x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-2">Chi tiết đơn hàng #{{ $order->id }}</h1>
            <p class="text-gray-600">Đặt ngày: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Thông tin giao hàng</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Người nhận:</p>
                    <p class="font-medium">{{ $order->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Số điện thoại:</p>
                    <p class="font-medium">{{ $order->phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email:</p>
                    <p class="font-medium">{{ $order->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Địa chỉ:</p>
                    <p class="font-medium">{{ $order->address }}</p>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sản phẩm
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Giá
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Số lượng
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tổng
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-20 w-20">
                                        @if($detail->thumbnail)
                                            <img class="h-20 w-20 object-cover" 
                                                 src="{{ asset('images/product/' . $detail->thumbnail) }}" 
                                                 alt="{{ $detail->product->name }}">
                                        @else
                                            <div class="h-20 w-20 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $detail->product->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ number_format($detail->price) }}đ
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detail->qty }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ number_format($detail->amount) }}đ
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium">
                            Tổng cộng:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-bold text-gray-900">
                                {{ number_format($order->orderDetails->sum('amount')) }}đ
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layout-site> 