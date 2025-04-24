<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo và Tên --}}
            <div class="flex items-center">
                <a href="{{ route('admin.home') }}" class="flex items-center text-gray-800 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
                    <span class="text-xl font-semibold">Quản Lý Admin</span>
                </a>
            </div>

            {{-- Menu --}}
            <div class="flex items-center space-x-6">
                {{-- Toggle Sidebar --}}
                <button id="sidebar-toggle" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>

                {{-- Links --}}
                <a href="{{ route('admin.home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Trang Chủ</a>
                <a href="{{ route('admin.contact.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Liên Hệ</a>

                {{-- User Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <span class="text-sm font-medium">Xin chào, {{ session('admin_fullname') }}</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" 
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <div class="px-4 py-2 text-sm text-gray-500 border-b">
                            {{ session('admin_email') }}
                        </div>
                        
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Add Alpine.js for dropdown functionality --}}
<script src="//unpkg.com/alpinejs" defer></script>
