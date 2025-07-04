{{-- Top Navbar --}}
<nav class="bg-white text-black w-full fixed top-2 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-0 flex justify-between items-center flex-row-reverse">
        {{-- Left Side: User Avatar + Mobile Search --}}
        <div class="flex items-center gap-4">
            {{-- Mobile Search Icon - Visible on mobile only --}}
            <div class="md:hidden relative" x-data="{ searchOpen: false }">
                <button @click="searchOpen = !searchOpen" class="p-2 text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                {{-- Mobile Search Dropdown - Fixed positioning --}}
                <div x-show="searchOpen"
                     @click.away="searchOpen = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="fixed left-4 right-4 top-16 bg-white rounded-lg shadow-lg z-50 p-2 border border-gray-200"
                     x-cloak>
                    <div class="relative">
                        <input type="text"
                               id="mobile-navbar-search"
                               placeholder="ابحث في المقالات..."
                               class="w-full bg-white text-black border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring focus:border-gray-400 text-sm"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 absolute right-3 top-2.5 text-gray-400 pointer-events-none"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z"/>
                        </svg>
                    </div>
                    {{-- Mobile Search Results --}}
                    <div id="mobile-search-results"
                         class="absolute mt-1 w-full bg-white border border-gray-200 rounded-lg shadow z-50 hidden max-h-80 overflow-y-auto text-right text-sm">
                    </div>
                </div>
            </div>

            {{-- user saved --}}
            @auth
<div class="relative" x-data="{ openSaved: false }">
    <button @click="openSaved = !openSaved"
            class="text-gray-600 transition"
            aria-label="Saved Posts">
        <svg xmlns="http://www.w3.org/2000/svg"
             :fill="openSaved ? '#E5E7EB' : 'transparent'"
             viewBox="0 0 24 24"
             stroke="currentColor"
             class="w-7 h-7 transition">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 5v16l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
        </svg>
    </button>

    <div x-show="openSaved"
         @click.away="openSaved = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="fixed sm:absolute inset-x-4 sm:right-0 sm:left-auto sm:w-[320px] mt-2 bg-white rounded-lg shadow-lg border border-gray-200 z-50 max-h-[60vh] overflow-y-auto"
         x-cloak>
        <div class="p-3">
            <h3 class="text-right text-base font-bold text-gray-800 border-b pb-1 mb-3">المحفوظات</h3>

            @php
                $savedPosts = Auth::user()->savedPosts()->latest()->take(5)->get();
            @endphp

            @forelse($savedPosts as $post)
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-14 h-14 flex-shrink-0 rounded overflow-hidden">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('storage/defaults/post-default.png') }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover rounded">
                    </div>
                    <div class="flex-1 text-right">
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="block text-sm font-semibold text-gray-800 hover:text-blue-600 leading-snug line-clamp-2">
                            {{ $post->title }}
                        </a>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $post->created_at->format('Y-m-d') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-600 text-center mt-4">لا توجد مقالات محفوظة</p>
            @endforelse

            <div class="text-center mt-3">
                <a href="{{ route('user.savedPosts') }}"
                   class="inline-block text-sm text-blue-600 hover:underline font-semibold">
                    عرض الكل
                </a>
            </div>
        </div>
    </div>
</div>
@endauth


            {{-- User Avatar - Visible on all screens --}}
            <div class="relative" x-data="{ userMenuOpen: false }">
                @auth
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                         class="w-10 h-10 rounded-full border border-gray-400 cursor-pointer"
                         alt="User Avatar"
                         @click="userMenuOpen = !userMenuOpen">
                    <div x-show="userMenuOpen"
                         @click.away="userMenuOpen = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md z-50 text-right origin-top-right border border-gray-200"
                         x-cloak>

                        <a href="{{ route('user.profile.edit') }}"
   class="block w-full px-4 py-2 text-lg text-black hover:bg-gray-100 text-center">
 لوحة التحكم
</a>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
            class="block w-full px-4 py-2 text-sm text-black hover:text-red-700 hover:bg-gray-100">
        تسجيل الخروج
    </button>
</form>
                    </div>
                @else
                    <div class="text-sm">
                        <a href="{{ route('login') }}" class="text-black hover:text-gray-600">تسجيل الدخول</a>
                    </div>
                @endauth
            </div>



        </div>

        {{-- Center: Search Box - Desktop only --}}
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

            {{-- Desktop Search Results --}}
            <div id="search-results"
                 class="absolute mt-1 w-full bg-white border border-gray-200 rounded-lg shadow z-50 hidden max-h-80 overflow-y-auto text-right text-sm">
            </div>
        </div>

        {{-- Right: Logo --}}
        <a href="{{ route('home') }}" class="text-2xl font-bold text-black hover:text-blue-700 transition">
    BrainWrite
</a>

    </div>
</nav>

{{-- Mobile Categories/Tags Dropdown --}}
<div class="md:hidden bg-white mt-[60px] border-b border-gray-200 px-4 py-2">
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-2 bg-gray-100 rounded-lg">
            <span class="font-bold">التصنيفات والوسوم</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" @click.away="open = false" class="absolute z-50 w-full mt-1 bg-white rounded-lg shadow-lg border border-gray-200 max-h-96 overflow-y-auto">
            <div class="p-2">
                <h3 class="font-bold px-2 py-1 border-b border-gray-200">التصنيفات</h3>
                <div class="grid grid-cols-2 gap-1 p-2">
                    @foreach(\App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->where('is_active',true)->paginate(6) as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="text-sm font-bold px-2 py-1 hover:bg-gray-100 rounded">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <h3 class="font-bold px-2 py-1 border-b border-gray-200 mt-2">الوسوم</h3>
                <div class="flex flex-wrap gap-1 p-2">
                    @foreach(\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->where('is_active', true)->limit(10)->get() as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" class="text-sm bg-gray-100 px-2 py-1 rounded-full hover:bg-gray-200">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Desktop Category Navbar --}}
<nav class="hidden md:block bg-white text-black mt-[60px]">
    <div class="max-w-7xl mx-auto px-4 py-3 text-center flex flex-wrap justify-center gap-8 text-2xl font-bold">
        @foreach(\App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->where('is_active',true)->paginate(12) as $category)
            <a href="{{ route('category.show', $category->slug) }}"
               class="hover:text-indigo-900 transition">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</nav>

{{-- Desktop Tags Navbar --}}
<nav class="hidden md:block w-full bg-white text-black border-t border-gray-200">
    <div class="w-full overflow-x-auto text-center px-4 py-3">
        <div class="inline-flex flex-wrap justify-center gap-2 text-sm rtl:text-right">
            @foreach(\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->where('is_active', true)->paginate(15) as $tag)
                <a href="{{ route('tag.show', $tag->slug) }}"
                   class="inline-block bg-gray-100 text-blue-950 font-semibold px-4 py-1 rounded-full hover:bg-gray-300 hover:text-black transition">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<!-- Alpine JS -->
<style>
    [x-cloak] { display: none !important; }
</style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
<script src="{{ asset('js/home.js') }}"></script>
@endpush
