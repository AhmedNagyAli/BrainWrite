<nav class="fixed top-0 right-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center flex-row-reverse text-right">
        {{-- Toggle Button (Mobile) --}}
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                ☰
            </button>
        </div>

        {{-- Right: Auth Links --}}
        <div class="hidden md:flex items-center space-x-4 space-x-reverse text-lg font-bold">
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">إنشاء حساب</a>
            @else
                <span class="text-gray-700">مرحبًا، {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-gray-700 hover:text-indigo-600" type="submit">تسجيل الخروج</button>
                </form>
            @endguest
        </div>

        {{-- Left: Categories --}}
        <div class="hidden md:flex items-center space-x-4 space-x-reverse text-lg font-bold">
            @foreach(\App\Models\Category::limit(4)->get() as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                   class="text-gray-700 hover:text-indigo-600">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 text-right">
        <div class="space-y-2 mb-2 font-bold">
            @foreach(\App\Models\Category::limit(4)->get() as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="block text-gray-700 hover:text-indigo-600">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        <div class="space-y-2 text-lg font-bold">
            @guest
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-indigo-600">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="block text-gray-700 hover:text-indigo-600">إنشاء حساب</a>
            @else
                <span class="block text-gray-700">مرحبًا، {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-gray-700 hover:text-indigo-600" type="submit">تسجيل الخروج</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');

        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush

