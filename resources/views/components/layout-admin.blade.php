<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Quản lý Admin' }}</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    {{-- Gọi CSS nếu có --}}
    {{ $header ?? "" }}
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <header class="bg-gradient-to-r from-blue-800 to-blue-600 text-white shadow-md">
            @include('admin.home.navbar')
        </header>

        <div class="flex flex-1">
            {{-- Sidebar --}}
            <aside class="w-64 bg-gradient-to-b from-blue-900 to-gray-900 text-white hidden lg:block shadow-lg">
                @include('admin.home.sidebar')
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 p-6 lg:p-8 bg-gray-100 rounded-lg shadow-md mx-4 lg:mx-0">
                {{ $slot }} {{-- Đây là nơi nội dung các trang con sẽ được đưa vào --}}
            </main>
        </div>

        {{-- Footer --}}
        <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-gray-400 text-center py-4">
            <p class="text-sm">&copy; {{ date('Y') }} Quản lý Admin. Tất cả các quyền được bảo lưu.</p>
        </footer>
    </div>

    {{ $footer ?? "" }}
</body>

</html>
