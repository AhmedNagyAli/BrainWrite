{{-- Right Sidebar - Most Visited (hidden on mobile) --}}
            <aside class="hidden md:block md:col-span-3 space-y-4">
                <div class="bg-white p-4 shadow ">
                    {{-- <h2 class="text-base font-bold mb-4">Most Visited</h2> --}}
                    <div class="grid grid-cols-1 gap-4">
                        @foreach (\App\Models\Post::orderByDesc('visited')->limit(5)->get() as $popularPost)
                            <a href="{{ route('posts.show', $popularPost->slug) }}" class="block group">
                                <div class="w-full aspect-video overflow-hidden  shadow-md">
                                    @if ($popularPost->image)
                                        <img src="{{ asset('storage/' . $popularPost->image) }}"
                                             alt="{{ $popularPost->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @endif
                                </div>
                                <p class="text-sm mt-2 font-medium leading-tight group-hover:text-blue-600">
                                    {{ Str::limit($popularPost->title, 50) }}
                                </p>
                                {{-- <p class="text-xs text-gray-500 mt-1">{{ $popularPost->visited }} views</p> --}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
