<x-layout-admin>
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Chỉnh sửa Menu</h2>
                <div class="space-x-2">
                    <a href="{{ route('admin.menu.index') }}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 inline-flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Quay lại
                    </a>
                </div>
            </div>
        </div>

        <div class="p-4">
            <form action="{{ route('admin.menu.update', ['id' => $menu->id]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-4">
                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tên Menu</label>
                        <input type="text" name="name" value="{{ old('name', $menu->name) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Link --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="text" name="link" value="{{ old('link', $menu->link) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('link')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kiểu Menu</label>
                        <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="custom" {{ old('type', $menu->type) == 'custom' ? 'selected' : '' }}>Tùy chỉnh</option>
                            <option value="category" {{ old('type', $menu->type) == 'category' ? 'selected' : '' }}>Danh mục</option>
                            <option value="page" {{ old('type', $menu->type) == 'page' ? 'selected' : '' }}>Trang</option>
                        </select>
                        @error('type')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Position --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vị trí</label>
                        <select name="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="mainmenu" {{ old('position', $menu->position) == 'mainmenu' ? 'selected' : '' }}>Menu chính</option>
                            <option value="footermenu" {{ old('position', $menu->position) == 'footermenu' ? 'selected' : '' }}>Menu footer</option>
                        </select>
                        @error('position')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Table ID --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ID Bảng liên kết</label>
                        <input type="number" name="table_id" value="{{ old('table_id', $menu->table_id) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('table_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thứ tự sắp xếp</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('sort_order')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="1" {{ old('status', $menu->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                            <option value="2" {{ old('status', $menu->status) == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                        </select>
                        @error('status')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
