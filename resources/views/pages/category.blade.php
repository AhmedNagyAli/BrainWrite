@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    {{-- Mobile Dropdowns (shown only on small screens) --}}
    <div class="md:hidden space-y-4 mb-6">
        {{-- Categories Dropdown --}}
        <details class="bg-white p-4 shadow rounded">
            <summary class="text-lg font-bold mb-2 cursor-pointer">Categories</summary>
            <ul class="space-y-1 text-sm text-blue-600 mt-2">
                @foreach (\App\Models\Category::limit(10)->get() as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="hover:text-blue-800 hover:underline {{ $cat->id === $category->id ? 'font-bold text-blue-800' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        {{-- Tags Dropdown --}}
        <details class="bg-white p-4 shadow rounded">
            <summary class="text-lg font-bold mb-2 cursor-pointer">Tags</summary>
            <div class="flex flex-wrap gap-2 text-sm mt-2">
                @foreach (\App\Models\Tag::limit(15)->get() as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                   class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200">
                    #{{ $tag->name }}
                </a>
                @endforeach
            </div>
        </details>
    </div>

    {{-- Desktop Layout --}}
    <div class="grid md:grid-cols-12 gap-6">
        {{-- Left Sidebar (hidden on mobile) --}}
        <aside class="hidden md:block md:col-span-2 space-y-4">
            {{-- Categories --}}
            <div class="bg-white p-4 shadow rounded">
    <h2 class="text-base font-bold mb-2">Categories</h2>
    <ul class="space-y-1 text-sm text-blue-600">
        @foreach (\App\Models\Category::limit(10)->get() as $cat)
            <li>
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="block max-w-full overflow-hidden whitespace-nowrap truncate hover:text-blue-800 hover:underline {{ $cat->id === $category->id ? 'font-bold text-blue-800' : '' }}">
                    {{ $cat->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


            {{-- Tags --}}
                <div class="bg-white p-4 shadow rounded">
    <h2 class="text-base font-bold mb-2">Tags</h2>
    <div class="flex flex-wrap gap-2 text-sm">
        @foreach (\App\Models\Tag::limit(15)->get() as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}"
               class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 whitespace-nowrap max-w-full truncate">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>
        </aside>

        {{-- Main Content Area --}}
        <div class="md:col-span-7">
            <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

            @if ($posts->count())
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($posts as $post)
                        @include('components.post-card', ['post' => $post])
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            @else
                <p class="text-gray-600">No posts found in this category.</p>
            @endif
        </div>

        {{-- Right Sidebar - Most Visited (hidden on mobile) --}}
        @include('components.most-visited')
    </div>
</div>
@endsection
