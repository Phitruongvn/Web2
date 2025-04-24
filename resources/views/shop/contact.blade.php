<x-layout-site>
    <x-slot:title>
        Liên hệ | Sudes Fashion
    </x-slot:title>
    <x-slot:header>

    </x-slot:header>
    <x-slot:fotter>
        
    </x-slot:fotter>
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-white py-16">
            <div class="absolute inset-0 overflow-hidden">
                <div class="h-full w-full bg-gradient-to-r from-blue-50 to-white"></div>
            </div>
            <div class="relative container mx-auto text-center px-4">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Liên hệ</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Chúng tôi luôn sẵn sàng hỗ trợ bạn.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">
                            Gửi tin nhắn cho chúng tôi
                        </h2>
                        <form action="#" method="POST" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên của bạn</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    required />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    required />
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Tin nhắn</label>
                                <textarea id="message" name="message" rows="5"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    required></textarea>
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 transform hover:scale-[1.02]">
                                Gửi tin nhắn
                            </button>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-gray-50 rounded-2xl p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">
                            Thông tin liên hệ
                        </h2>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Địa chỉ</h3>
                                    <p class="text-gray-600">123 Đường Thời Trang, Quận 1, TP. Hồ Chí Minh</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Email</h3>
                                    <p class="text-gray-600">support@sudesfashion.com</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Hotline</h3>
                                    <p class="text-gray-600">0909 123 456</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Giờ làm việc</h3>
                                    <p class="text-gray-600">Thứ 2 - Thứ 6, 8:00 - 17:00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                Theo dõi chúng tôi
                            </h3>
                            <div class="flex space-x-4">
                                <a href="#" class="p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition duration-200">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4A5.26,5.26,0,0,0,9.82,6V7.46H7v3.4h2.82V20.5h4.68V10.86h3.27Z"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition duration-200">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2.2A9.8,9.8,0,1,0,21.8,12,9.8,9.8,0,0,0,12,2.2Zm5,7.5H15.7a7.5,7.5,0,0,0-.7-2.4,6,6,0,0,1,2,2.4ZM12,4.2a8.7,8.7,0,0,1,1.8,3.5H10.2A8.7,8.7,0,0,1,12,4.2ZM4.2,12a7.8,7.8,0,0,1,.2-1.8H7a15.4,15.4,0,0,0-.1,3.6H4.4A7.8,7.8,0,0,1,4.2,12ZM7,15.7H4.4a6,6,0,0,1-2-2.4H4.7A7.5,7.5,0,0,0,7,15.7Zm3.2,2.1a8.7,8.7,0,0,1-1.8-3.5h3.6A8.7,8.7,0,0,1,10.2,17.8ZM12,19.8a8.7,8.7,0,0,1-1.8-3.5h3.6A8.7,8.7,0,0,1,12,19.8Zm2.8-5.7H9.2a13.6,13.6,0,0,1-.1-3.6h6a13.6,13.6,0,0,1-.1,3.6ZM17,15.7a7.5,7.5,0,0,0,.7-2.4h2.3a6,6,0,0,1-2,2.4ZM19.8,12H17a15.4,15.4,0,0,0-.1-3.6h2.5a7.8,7.8,0,0,1,.2,1.8A7.8,7.8,0,0,1,19.8,12Z"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-full transition duration-200">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.46,6c-.77.35-1.6.58-2.46.69.88-.53,1.56-1.37,1.88-2.38-.83.5-1.75.85-2.72,1.05C18.37,4.5,17.26,4,16,4c-2.35,0-4.27,1.92-4.27,4.29,0,.34.04.67.11.98C8.28,9.09,5.11,7.38,3,4.79c-.37.63-.58,1.37-.58,2.15,0,1.49.75,2.81,1.91,3.56-.71,0-1.37-.2-1.95-.5v.03c0,2.08,1.48,3.82,3.44,4.21a4.22,4.22,0,0,1-1.93.07,4.28,4.28,0,0,0,4,2.98,8.521,8.521,0,0,1-5.33,1.84c-.34,0-.68-.02-1.02-.06C3.44,20.29,5.7,21,8.12,21,16,21,20.33,14.46,20.33,8.79c0-.19,0-.37-.01-.56.84-.6,1.56-1.36,2.14-2.23Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout-site>
