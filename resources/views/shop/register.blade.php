<x-layout-site>
    
    
        <div class="flex justify-center items-center min-h-screen">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Đăng ký tài khoản</h2>
    
                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif
    
                @if (session('error'))
                    <div class="bg-red-500 text-white p-3 mb-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif
    
                <form action="{{ route('shop.doregistration') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('fullname')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('address')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Giới tính</label>
                        <select name="gender" id="gender" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700">Ảnh đại diện</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
                        @error('thumbnail')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
    
                    <div class="mb-6">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none">Đăng ký</button>
                    </div>
    
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Bạn đã có tài khoản? <a href="{{ route('shop.login') }}" class="text-blue-500 hover:underline">Đăng nhập ngay</a></p>
                    </div>
                </form>
            </div>
        </div>
    
    
    </x-layout-site>
    