<x-layout-admin>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Chào mừng {{ session('admin_fullname') }} đã đăng nhập
            </h2>
            
            <div class="mt-4 text-gray-600">
                <p>Bạn có thể quản lý:</p>
                <ul class="list-disc list-inside mt-2 space-y-2">
                    <li>Sản phẩm</li>
                    <li>Danh mục</li>
                    <li>Đơn hàng</li>
                    <li>Người dùng</li>
                    <li>Và nhiều chức năng khác...</li>
                </ul>
            </div>
        </div>
    </div>
</x-layout-admin>
</body>
</html>

