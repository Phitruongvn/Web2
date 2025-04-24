<aside class="w-64 bg-blue-800 text-white shadow-md h-screen">
    <div class="p-4">
        <ul class="space-y-4">
            <!-- Product Section -->
            <li class="nav-section">
                <a href="#" class="flex items-center p-2 text-gray-200 hover:bg-blue-600 rounded-md">
                    <i class="fab fa-product-hunt mr-2"></i>
                    <span>Sản phẩm</span>
                </a>
                <ul class="ml-4 mt-2 space-y-1">
                    <li><a href="{{ route('admin.product.index') }}" class="block p-2 text-gray-300 hover:text-white">Tất cả sản phẩm</a></li>
                    <li><a href="{{ route('admin.category.index') }}" class="block p-2 text-gray-300 hover:text-white">Danh mục</a></li>
                    <li><a href="{{ route('admin.brand.index') }}" class="block p-2 text-gray-300 hover:text-white">Thương hiệu</a></li>
                </ul>
            </li>
            
            <!-- Post Section -->
            <li class="nav-section">
                <a href="#" class="flex items-center p-2 text-gray-200 hover:bg-blue-600 rounded-md">
                    <i class="fa-solid fa-book"></i>
                    <span>Bài Viết</span>
                </a>
                <ul class="ml-4 mt-2 space-y-1">
                    <li><a href="{{ route('admin.post.index') }}" class="block p-2 text-gray-300 hover:text-white">Tất cả Bài Viết</a></li>
                    <li><a href="{{ route('admin.topic.index') }}" class="block p-2 text-gray-300 hover:text-white">Chủ Đề</a></li>
                </ul>
            </li>
            
            <!-- Interface Section -->
            <li class="nav-section">
                <a href="#" class="flex items-center p-2 text-gray-200 hover:bg-blue-600 rounded-md">
                    <i class="fa-sharp fa-solid fa-tv"></i>
                    <span>Giao diện</span>
                </a>
                <ul class="ml-4 mt-2 space-y-1">
                    <li><a href="{{ route('admin.menu.index') }}" class="block p-2 text-gray-300 hover:text-white">Menu</a></li>
                    <li><a href="{{ route('admin.banner.index') }}" class="block p-2 text-gray-300 hover:text-white">Banner</a></li>
                </ul>
            </li>
            
            <!-- Other Sections -->
            <li class="nav-section">
                <a href="#" class="flex items-center p-2 text-gray-200 hover:bg-blue-600 rounded-md">
                    <i class="fa-sharp fa-solid fa-address-card"></i>
                    <span>Mục Khác</span>
                </a>
                <ul class="ml-4 mt-2 space-y-1">
                    <li><a href="{{ route('admin.order.index') }}" class="block p-2 text-gray-300 hover:text-white">Đơn Hàng</a></li>
                    <li><a href="{{ route('admin.contact.index') }}" class="block p-2 text-gray-300 hover:text-white">Liên Hệ</a></li>
                    <li><a href="{{ route('admin.user.index') }}" class="block p-2 text-gray-300 hover:text-white">User</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
