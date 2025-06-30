{{-- Top Navbar --}}
<nav class="bg-white text-black w-full fixed top-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-0 flex justify-between items-center flex-row-reverse">

        {{-- Left: User Avatar --}}
        <div class="relative group hidden md:block">
            @auth
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                     class="w-10 h-10 rounded-full border border-gray-400 cursor-pointer"
                     alt="User Avatar">
                <div class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 text-right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full px-4 py-2 text-sm text-black hover:bg-gray-100">
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            @else
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="text-white hover:text-gray-300">إنشاء حساب</a>
                </div>
            @endauth
        </div>

        {{-- Center: Search Box --}}
        <div class="hidden md:block w-full max-w-md relative text-left">
            <input type="text"
                   id="navbar-search"
                   placeholder="ابحث في المقالات..."
                   class="w-full bg-white text-black border border-gray-600 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring focus:border-gray-400"
            >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 absolute right-3 top-2.5 text-gray-400 pointer-events-none"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z"/>
            </svg>

            {{-- Search Results --}}
            <div id="search-results"
                 class="absolute mt-1 w-full bg-white border border-gray-200 rounded-lg shadow z-50 hidden max-h-80 overflow-y-auto text-right text-sm">
            </div>
        </div>


        {{-- Right: Logo --}}
        <div class="text-2xl font-bold text-black">BrainWrite</div>
    </div>
</nav>

{{-- Category Navbar (Second bar) --}}
<nav class="bg-white text-black mt-[60px]">
    <div class="max-w-7xl mx-auto px-4 py-3 text-center flex flex-wrap justify-center gap-8 text-lg font-bold">
        @foreach(\App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->limit(9)->get() as $category)
            <a href="{{ route('category.show', $category->slug) }}"
               class="hover:text-indigo-900 transition">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</nav>

{{-- Tags Navbar (Third bar) --}}
<nav class="bg-white text-black border-t border-gray-700">
    <div class="max-w-7xl mx-auto px-4 py-2 overflow-x-auto whitespace-nowrap text-right text-sm">
        @foreach(\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(12)->get() as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}"
               class="inline-block bg-gray-100 text-blue-950 font-semibold px-3 py-1 rounded-full hover:bg-gray-300 hover:text-black mx-1 mb-1">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>
</nav>
