    {{-- Main Grid Layout --}}
<div class="grid md:grid-cols-12 gap-6">

    {{-- Unified Sidebar (Categories, Tags, Most Visited) --}}
    <aside class="hidden md:block md:col-span-3 space-y-6">
        {{-- Most Visited --}}
        @include('components.most-visited')

        {{-- Categories
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-base font-bold mb-2">Categories</h2>
            <ul class="flex flex-wrap gap-2 text-sm text-blue-600">
                @foreach (\App\Models\Category::limit(10)->get() as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}"
                           class="block truncate hover:text-blue-800 hover:underline">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div> --}}

        {{-- Tags --}}
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-base font-bold mb-2">Tags</h2>
            <div class="flex flex-wrap gap-2 text-sm">
                @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->paginate(25) as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                       class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 truncate">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </aside>

    @include('layouts.partials.header')



</div>
