<x-layout-admin>
    <div class="bg-white rounded-lg shadow-md">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Quản lý Liên Hệ</h2>
                <div class="space-x-2">
                    <a href="{{ route('admin.contact.create') }}" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 inline-flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Thêm
                    </a>
                    <a href="{{ route('admin.contact.trash') }}" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 inline-flex items-center">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Thùng rác
                    </a>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-12 px-4 py-3 text-center">#</th>
                        <th class="px-4 py-3 text-left">Họ Tên</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Điện Thoại</th>
                        <th class="px-4 py-3 text-left">Tiêu Đề</th>
                        <th class="w-48 px-4 py-3 text-center">Chức năng</th>
                        <th class="w-20 px-4 py-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($contacts as $contact)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-4 py-3">{{ $contact->name }}</td>
                        <td class="px-4 py-3">{{ $contact->email }}</td>
                        <td class="px-4 py-3">{{ $contact->phone }}</td>
                        <td class="px-4 py-3">{{ $contact->title }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            {{-- Status button --}}
                            @if ($contact->status==1)
                                <a href="{{ route('admin.contact.status', ['contact'=>$contact->id]) }}" class="inline-flex p-1 bg-green-600 py-1 px-1.5 text-white mx-0.5">
                                    <i class="fa-solid fa-toggle-on"></i>
                                </a>
                            @else
                                <a href="{{ route('admin.contact.status', ['contact'=>$contact->id]) }}" class="inline-flex p-1 bg-red-600 py-1 px-1.5 text-white mx-0.5">
                                    <i class="fa-solid fa-toggle-off"></i>
                                </a>
                            @endif

                            {{-- Show button --}}
                            <a href="{{ route('admin.contact.show', ['contact' => $contact->id]) }}" 
                                class="inline-flex p-1 bg-green-600 text-white rounded hover:opacity-75">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            {{-- Edit button --}}
                            <a href="{{ route('admin.contact.edit', ['id' => $contact->id]) }}" 
                                class="inline-flex p-1 bg-yellow-600 text-white rounded hover:opacity-75">
                                <i class="fa-solid fa-edit"></i>
                            </a>

                            {{-- Delete button --}}
                            <a href="{{ route('admin.contact.delete', ['id' => $contact->id]) }}" 
                                class="inline-flex p-1 bg-red-600 text-white rounded hover:opacity-75"
                                onclick="return confirm('Bạn có chắc muốn xóa liên hệ này?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                        <td class="px-4 py-3 text-center">{{ $contact->id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t border-gray-200">
            {{ $contacts->links() }}
        </div>
    </div>
</x-layout-admin>
