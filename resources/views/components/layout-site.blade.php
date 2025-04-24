<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Fashion Store' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .header-nav li:hover .dropdown {
            display: block;
        }
        .dropdown {
            display: none;
            position: absolute;
            background: white;
            min-width: 200px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .dropdown a {
            color: #333;
            padding: 12px 16px;
            display: block;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .dropdown a:hover {
            background-color: #f8f9fa;
            color: #3b82f6;
        }
        .nav-link {
            font-weight: 500;
            color: #374151;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link:hover {
            color: #3b82f6;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .hero-banner {
            background-size: cover;
            background-position: center;
            height: 600px;
            position: relative;
        }
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 2;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm w-full">
        <div class="container mx-auto px-4">
            <div class="flex items-center h-28">
                <!-- Logo -->
                <div class="flex items-center flex-grow justify-end pr-8">
                    <a href="{{ route('shop.home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/banner/logo3.jpg') }}" 
                             alt="Fashion Store Logo" class="h-28 w-auto object-contain">
                    </a>
                </div>

                <!-- Main Menu -->
                <nav class="hidden md:block flex-grow px-8 flex justify-center">
                    <x-main-menu />
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-6 ml-auto">
                    <!-- Search -->
                    <form action="{{ route('shop.search') }}" method="GET" class="hidden md:flex items-center">
                        <input type="text" 
                               name="query" 
                               placeholder="Tìm kiếm..." 
                               class="w-40 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-blue-500">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- User -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 flex items-center space-x-2" id="userButton">
                            <i class="fas fa-user text-xl"></i>
                            <span id="userName" class="hidden"></span>
                        </button>
                        <div class="absolute right-0 w-48 py-2 bg-white rounded-md shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div id="authMenu" class="hidden">
                                <a href="{{ route('shop.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tài khoản của tôi
                                </a>
                                <a href="{{ route('shop.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Đơn hàng của tôi
                                </a>
                              
                                <form action="{{ route('shop.logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                            <div id="guestMenu">
                                <a href="{{ route('shop.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Đăng nhập
                                </a>
                                <a href="{{ route('shop.registration') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Đăng ký
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Cart -->
                    <a href="{{ route('shop.cart') }}" class="relative text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @php
                            // Lấy giỏ hàng từ session
                            $cart = session('cart', []);
                            // Tính tổng số lượng sản phẩm
                            $totalQuantity = 0;
                            foreach ($cart as $item) {
                                // Kiểm tra nếu item có key 'qty'
                                if (isset($item['qty'])) {
                                    $totalQuantity += $item['qty'];
                                } 
                                // Giả định nếu không có 'qty' thì mỗi item là 1 sản phẩm
                                // Hoặc bạn có thể bỏ qua item đó nếu cấu trúc không đồng nhất
                                // else {
                                //     $totalQuantity += 1; 
                                // }
                            }
                        @endphp
                        @if($totalQuantity > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $totalQuantity }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Hero Banner -->
      
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-menu-footer />

    <!-- Mobile Menu Button -->
    <button class="md:hidden fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const userButton = document.getElementById('userButton');
        const userName = document.getElementById('userName');
        const userIcon = userButton.querySelector('.fas');
        const authMenu = document.getElementById('authMenu');
        const guestMenu = document.getElementById('guestMenu');
        const logoutForm = document.getElementById('logoutForm');

        // Kiểm tra user trong localStorage
        function checkUserAuth() {
            const userStr = localStorage.getItem('user');
            if (userStr) {
                try {
                    const user = JSON.parse(userStr);
                    if (user && user.name) {
                        // Hiển thị tên user
                        userName.textContent = user.name;
                        userName.classList.remove('hidden');
                        userIcon.classList.add('hidden');
                        
                        // Hiển thị menu cho user đã đăng nhập
                        authMenu.classList.remove('hidden');
                        guestMenu.classList.add('hidden');

                        // Lưu user_id vào session thông qua AJAX
                        fetch('{{ route("shop.store-user-session") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                user_id: user.id
                            })
                        });
                        return;
                    }
                } catch (e) {
                    console.error('Error parsing user data:', e);
                }
            }
            
            // Nếu không có user hoặc có lỗi
            userName.classList.add('hidden');
            userIcon.classList.remove('hidden');
            authMenu.classList.add('hidden');
            guestMenu.classList.remove('hidden');

            // Xóa user_id khỏi session
            fetch('{{ route("shop.clear-user-session") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        }

        // Kiểm tra ngay khi trang load
        checkUserAuth();

        // Xử lý logout
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                localStorage.removeItem('user');
                // Xóa user_id khỏi session khi logout
                fetch('{{ route("shop.clear-user-session") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            });
        }

        // Kiểm tra mỗi khi localStorage thay đổi
        window.addEventListener('storage', function(e) {
            if (e.key === 'user') {
                checkUserAuth();
            }
        });
    });
    </script>
</body>
</html>
