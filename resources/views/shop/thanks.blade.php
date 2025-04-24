<x-layout-site>
    <x-slot:title>
        Đặt hàng thành công
    </x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-8">
                <svg class="w-20 h-20 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Cảm ơn bạn đã đặt hàng!</h1>
            <p class="text-gray-600 mb-8">Đơn hàng của bạn đã được xác nhận. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
            
            <a href="{{ route('shop.home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</x-layout-site>
