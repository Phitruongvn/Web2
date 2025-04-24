<!-- resources/views/shop/profile.blade.php -->

<x-layout-site>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-semibold mb-4">Thông tin cá nhân</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-lg font-medium">Tên: {{ $user->fullname }}</p>
            <p class="text-lg font-medium">Email: {{ $user->email }}</p>
            <p class="text-lg font-medium">Số điện thoại: {{ $user->phone }}</p>
            <p class="text-lg font-medium">Địa chỉ: {{ $user->address }}</p>
        </div>
    </div>
</x-layout-site>
