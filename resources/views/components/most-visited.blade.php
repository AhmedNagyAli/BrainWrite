{{-- Right Sidebar - Most Visited (hidden on mobile) --}}
<aside class="hidden md:block md:col-span-3 space-y-4">
    <div class="bg-white p-4 shadow rounded text-right">
        <h2 class="text-base font-bold mb-4">الأكثر زيارة</h2>
        <div class="space-y-6">
            @foreach (\App\Models\Post::orderByDesc('visited')->paginate(6) as $popularPost)
                <a href="{{ route('posts.show', $popularPost->slug) }}" class="block group">
                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                        @if ($popularPost->image)
                            <img src="{{ asset('storage/' . $popularPost->image) }}"
                                 alt="{{ $popularPost->title }}"
                                 class="w-24 h-16 object-cover rounded shadow-md group-hover:scale-105 transition duration-300">
                        @endif
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-medium group-hover:text-black truncate">
                                {{ $popularPost->title }}
                            </p>
                        </div>
                    </div>
                    <hr class="mt-4">
                </a>
            @endforeach
        </div>
    </div>
</aside>
