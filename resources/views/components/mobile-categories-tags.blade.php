{{-- components/mobile-categories-tags.blade.php --}}
<details class="bg-white p-4 shadow rounded">
    <summary class="text-lg font-semibold cursor-pointer">📂 التصنيفات</summary>
    <ul class="mt-2 space-y-2 text-sm text-blue-700">
        @foreach (\App\Models\Category::limit(10)->get() as $cat)
            <li>
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="hover:underline hover:text-blue-900">
                    {{ $cat->name }}
                </a>
            </li>
        @endforeach
    </ul>
</details>

<details class="bg-white p-4 shadow rounded">
    <summary class="text-lg font-semibold cursor-pointer">🏷️ الوسوم</summary>
    <div class="mt-2 flex flex-wrap gap-2 text-sm">
        @foreach (\App\Models\Tag::limit(15)->get() as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}"
               class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>
</details>
