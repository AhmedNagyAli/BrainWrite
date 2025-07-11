@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-4 py-4 flex flex-col md:flex-row gap-6">
    {{-- Mobile menu button (hidden on desktop) --}}
    <button id="mobile-menu-button" class="md:hidden flex items-center justify-between w-full bg-gray-100 rounded-lg mb-4">
        <span class="font-bold">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-align-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M10 12l10 0" /><path d="M6 18l14 0" /></svg>
        </span>
        {{-- <span class="font-bold text-underline">{{ Auth::user()->name ?? '' }}</span> --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    {{-- Sidebar --}}
    <aside id="sidebar" class="hidden md:block w-full md:w-1/4 bg-white p-4 shadow-lg rounded-lg">
        <div class="flex flex-col items-center text-center">
            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                 class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover mb-3" alt="User Avatar">

            <h2 class="text-base md:text-lg font-bold flex items-center gap-2 justify-center">
                {{ Auth::user()->name }}
                @if (Auth::user()->is_email_verified)
                    <span class="text-green-600 bg-green-100 text-xs px-2 py-0.5 rounded-full font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                        </svg>
                    </span>
                @else
                    <span class="text-red-600 bg-red-100 text-xs px-2 py-0.5 rounded-full font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2l1.5 -1.5m2 -2l.5 -.5" />
                            <path d="M8.887 4.89a2.2 2.2 0 0 0 .863 -.53l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.528 .858m-.757 3.248a2.193 2.193 0 0 1 -1.555 .644h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1c0 -.604 .244 -1.152 .638 -1.55" />
                            <path d="M3 3l18 18" />
                        </svg>
                    </span>
                @endif
            </h2>
        </div>

        <nav class="mt-6 space-y-2 text-right">
            <a href="{{ route('user.profile.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 truncate {{ request()->routeIs('user.profile.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                ✏️ تعديل المعلومات
            </a>
            <a href="{{ route('user.avatar.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 truncate {{ request()->routeIs('user.avatar.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                🖼️ تعديل الصورة الشخصية
            </a>
            <a href="{{ route('user.password.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 truncate {{ request()->routeIs('user.password.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                🔐 تغيير كلمة المرور
            </a>
            <a href="{{ route('user.saved') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 truncate {{ request()->routeIs('user.saved') ? 'bg-gray-100 font-semibold' : '' }}">
                🔖 المقالات المحفوظة
            </a>
            <div class="block px-3 py-2 rounded hover:bg-gray-100 truncate">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-right hover:text-red-700">
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 bg-white p-4 md:p-6 rounded-lg shadow-lg">
        @yield('user-content')
    </main>
</div>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const icon = mobileMenuButton.querySelector('svg');

        mobileMenuButton.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });
</script>
@endsection
