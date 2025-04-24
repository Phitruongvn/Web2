<x-layout-site>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-white-600">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <h2 class="text-2xl font-bold text-center text-gray-800">Đăng Nhập</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Chào mừng bạn trở lại! Hãy đăng nhập để tiếp tục.</p>

                <div id="alert-message" class="hidden mb-4"></div>

                <form id="login-form" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Tên đăng nhập hoặc Email</label>
                        <input type="text" id="username" name="username" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" 
                            required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                        <input type="password" id="password" name="password" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" 
                            required>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                            <span class="ml-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-600 hover:underline">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold rounded-lg py-3 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Đăng Nhập
                    </button>
                </form>
            </div>

            <div class="bg-gray-50 text-center py-4">
                <p class="text-sm text-gray-600">
                    Chưa có tài khoản? 
                    <a href="{{route('shop.registration')}}" class="text-indigo-600 font-medium hover:underline">Đăng ký ngay</a>
                </p>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const alertMessage = document.getElementById('alert-message');
        
        fetch('{{ route("shop.dologin") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Lưu thông tin user vào localStorage
                localStorage.setItem('user', JSON.stringify(data.user));
                
                // Hiển thị thông báo thành công
                alertMessage.innerHTML = `
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        ${data.message}
                    </div>`;
                alertMessage.classList.remove('hidden');
                
                // Chuyển hướng sau 1 giây
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            // Hiển thị thông báo lỗi
            alertMessage.innerHTML = `
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    ${error.message}
                </div>`;
            alertMessage.classList.remove('hidden');
        });
    });
    </script>
</x-layout-site>
