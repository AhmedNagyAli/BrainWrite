{{-- layouts/user.blade.php --}}
@extends('layouts.app') {{-- or your base layout --}}

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 flex gap-6">
    {{-- Sidebar --}}
    <aside class="w-full md:w-1/4 bg-white p-4 shadow-lg">
        <div class="flex flex-col items-center text-center">
            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                 class="w-24 h-24 rounded-full object-cover mb-3" alt="User Avatar">

            <h2 class="text-lg font-bold flex items-center gap-2 justify-center">
    {{ Auth::user()->name }}

    @if (Auth::user()->is_email_verified)
        <span class="text-green-600 bg-green-100 text-xs px-2 py-0.5 rounded-full font-semibold">✔️ verified</span>
    @else
        <span class="text-red-600 bg-red-100 text-xs px-2 py-0.5 rounded-full font-semibold">not verified</span>
    @endif
</h2>
        </div>

        <nav class="mt-6 space-y-2 text-right">
            <a href="{{ route('user.profile.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.profile.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                ✏️ تعديل المعلومات
            </a>
            <a href="{{ route('user.avatar.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.avatar.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                🖼️ تعديل الصورة الشخصية
            </a>
            <a href="{{ route('user.password.edit') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.password.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                🔐 تغيير كلمة المرور
            </a>
            <a href="{{ route('user.saved') }}"
               class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.saved') ? 'bg-gray-100 font-semibold' : '' }}">
                🔖 المقالات المحفوظة
            </a>
        </nav>
    </aside>

    {{-- Main content --}}
    <main class="flex-1">
        @yield('user-content')
    </main>
</div>
@endsection
