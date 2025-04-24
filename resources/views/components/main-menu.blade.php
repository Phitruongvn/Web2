@php
    $menus = App\Models\Menu::where('status', 1)
        ->where('position', 'mainmenu')
        ->where('parent_id', 0)  // Chỉ lấy menu cha
        ->orderBy('sort_order', 'asc')
        ->get();
@endphp

<nav class="bg-white">
    <ul class="flex">
        @foreach ($menus as $menu)
            @php
                $submenus = App\Models\Menu::where('status', 1)
                    ->where('parent_id', $menu->id)
                    ->orderBy('sort_order', 'asc')
                    ->get();
            @endphp
            <li class="relative group">
                <a class="inline-block px-4 py-2 text-gray-700 hover:text-blue-600" href="{{ url($menu->link) }}">
                    {{ $menu->name }}
                </a>
                @if($submenus->count() > 0)
                    <ul class="absolute left-0 hidden group-hover:block bg-white shadow-lg min-w-[200px] z-50">
                        @foreach($submenus as $submenu)
                            <li>
                                <a href="{{ url($submenu->link) }}" 
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                                    {{ $submenu->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>