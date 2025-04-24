<x-layout-site>
    <x-slot:title>
        Thanh toán
    </x-slot:title>

    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Thanh toán</h1>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Form thông tin khách hàng -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Thông tin giao hàng</h2>
                        
                        <!-- Alert Messages -->
                        <div id="alert-container" class="mb-4 hidden">
                            <div id="alert-content" class="p-4 rounded"></div>
                        </div>

                        <form id="checkout-form" class="space-y-4">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id">
                            
                            <!-- Hidden inputs for cart items thumbnails -->
                            @foreach($cart as $item)
                                <input type="hidden" name="thumbnails[{{ $item['id'] }}]" value="{{ $item['thumbnail'] }}">
                            @endforeach

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên <span class="text-red-500">*</span></label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                <span class="error-message text-red-500 text-sm"></span>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                <span class="error-message text-red-500 text-sm"></span>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                <span class="error-message text-red-500 text-sm"></span>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ giao hàng <span class="text-red-500">*</span></label>
                                <textarea 
                                    id="address" 
                                    name="address" 
                                    rows="3" 
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                ></textarea>
                                <span class="error-message text-red-500 text-sm"></span>
                            </div>

                            <div class="mt-8">
                                <button type="submit" id="submit-button" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition">
                                    Đặt hàng
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Thông tin đơn hàng -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Thông tin đơn hàng</h2>
                        
                        <div class="space-y-4">
                            @foreach($cart as $item)
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-20 h-20">
                                        <img 
                                            src="{{ asset('images/product/' . $item['thumbnail']) }}" 
                                            alt="{{ $item['name'] }}"
                                            class="w-full h-full object-contain bg-gray-100 rounded-md"
                                        >
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Số lượng: {{ $item['qty'] }}</p>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ number_format($item['price_buy'], 0, ',', '.') }}₫
                                        </p>
                                        <input type="hidden" name="thumbnails[{{ $item['id'] }}]" value="{{ $item['thumbnail'] }}">
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ number_format($item['price_buy'] * $item['qty'], 0, ',', '.') }}₫
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="border-t border-gray-200 pt-4 mt-6">
                                <div class="flex justify-between">
                                    <p class="text-sm text-gray-600">Tạm tính</p>
                                    <p class="text-sm font-medium text-gray-900">{{ number_format($total, 0, ',', '.') }}₫</p>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <p class="text-sm text-gray-600">Phí vận chuyển</p>
                                    <p class="text-sm font-medium text-gray-900">0₫</p>
                                </div>
                                <div class="flex justify-between mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-base font-medium text-gray-900">Tổng cộng</p>
                                    <p class="text-base font-medium text-gray-900">{{ number_format($total, 0, ',', '.') }}₫</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy thông tin user từ localStorage
        const userStr = localStorage.getItem('user');
        if (userStr) {
            try {
                const user = JSON.parse(userStr);
                if (user) {
                    document.getElementById('user_id').value = user.id;
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                }
            } catch (e) {
                console.error('Error parsing user data:', e);
            }
        }

        const form = document.getElementById('checkout-form');
        const submitButton = document.getElementById('submit-button');
        const alertContainer = document.getElementById('alert-container');
        const alertContent = document.getElementById('alert-content');

        function showAlert(message, type = 'error') {
            alertContainer.classList.remove('hidden');
            alertContent.className = `p-4 rounded ${type === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}`;
            alertContent.textContent = message;
        }

        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
            alertContainer.classList.add('hidden');
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();

            // Disable submit button
            submitButton.disabled = true;
            submitButton.textContent = 'Đang xử lý...';

            const formData = new FormData(this);

            fetch('{{ route("shop.placeorder") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Đặt hàng thành công! Đang chuyển hướng...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '{{ route("shop.thanks") }}';
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra khi đặt hàng');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(error.message || 'Có lỗi xảy ra khi đặt hàng');
                
                // Re-enable submit button
                submitButton.disabled = false;
                submitButton.textContent = 'Đặt hàng';
            });
        });
    });
    </script>
</x-layout-site> 