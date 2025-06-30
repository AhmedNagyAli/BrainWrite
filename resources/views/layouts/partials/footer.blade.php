<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm text-right">
        {{-- About --}}
        <div>
            <h3 class="font-bold text-lg mb-4">من نحن</h3>
            <p class="text-gray-400">
                مرحبًا بك في مدونتنا حيث نشارك أحدث المقالات في مختلف المواضيع التقنية والثقافية. هدفنا هو تقديم محتوى عالي الجودة ومفيد للقارئ العربي.
            </p>
        </div>

        {{-- Most Visited (static or dynamic partial) --}}
        <div>
            <h3 class="font-bold text-lg mb-4">الأكثر زيارة</h3>
            <ul class="space-y-2 text-gray-300">
                @foreach ($mostVisitedPosts ?? [] as $post)
                    <li>
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">
                            {{ Str::limit($post->title, 40) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Categories --}}
        <div>
            <h3 class="font-bold text-lg mb-4">التصنيفات</h3>
            <ul class="space-y-2 text-gray-300">
                @foreach (\App\Models\Category::limit(10)->get() as $cat)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}" class="hover:underline">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Tags --}}
        <div>
            <h3 class="font-bold text-lg mb-4">الوسوم</h3>
            <div class="flex flex-wrap gap-2">
                @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->paginate(15) as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                       class="bg-blue-700 text-white px-2 py-1 rounded hover:bg-blue-600">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="border-t border-gray-800 mt-8">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-500 text-xs">
            © {{ now()->year }} مدونتي. جميع الحقوق محفوظة.
        </div>
    </div>
</footer>
