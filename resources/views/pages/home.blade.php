@extends('layouts.app')

@section('title', 'Welcome to My Blog')
@section('meta_description', 'Read the latest posts on various topics.')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        {{-- Mobile Dropdowns (shown only on small screens) --}}
        <div class="md:hidden space-y-4 mb-6">
            {{-- Categories Dropdown --}}
            <details class="bg-white p-4 shadow rounded">
                <summary class="text-lg font-bold mb-2 cursor-pointer">Categories</summary>
                <ul class="space-y-1 text-sm text-blue-600 mt-2">
                    @foreach (\App\Models\Category::limit(10)->get() as $category)
                        <li>
                            <a class="hover:text-blue-800 hover:underline">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>

            {{-- Tags Dropdown --}}
            <details class="bg-white p-4 shadow rounded">
                <summary class="text-lg font-bold mb-2 cursor-pointer">Tags</summary>
                <div class="flex flex-wrap gap-2 text-sm mt-2">
                    @foreach (\App\Models\Tag::limit(15)->get() as $tag)
                        <a class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200">
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
                        @foreach (\App\Models\Category::limit(10)->get() as $category)
                            <li>
                                <a class="hover:text-blue-800 hover:underline">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Tags --}}
                <div class="bg-white p-4 shadow rounded">
                    <h2 class="text-base font-bold mb-2">Tags</h2>
                    <div class="flex flex-wrap gap-2 text-sm">
                        @foreach (\App\Models\Tag::limit(15)->get() as $tag)
                            <a class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Main Content Area --}}
            <div class="md:col-span-7">
                <h1 class="text-3xl font-bold mb-6">Latest Blogs</h1>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($posts as $post)
                        @include('components.post-card', ['post' => $post])
                    @endforeach
                </div>
            </div>

            {{-- Right Sidebar - Most Visited (hidden on mobile) --}}
            <aside class="hidden md:block md:col-span-3 space-y-4">
                <div class="bg-white p-4 shadow rounded">
                    <h2 class="text-base font-bold mb-4">Most Visited</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach (\App\Models\Post::orderByDesc('visited')->limit(5)->get() as $popularPost)
                            <a href="{{ route('posts.show', $popularPost->slug) }}" class="block group">
                                <div class="w-full aspect-video overflow-hidden rounded-lg shadow-md">
                                    @if ($popularPost->image)
                                        <img src="{{ asset('storage/' . $popularPost->image) }}"
                                             alt="{{ $popularPost->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @endif
                                </div>
                                <p class="text-sm mt-2 font-medium leading-tight group-hover:text-blue-600">
                                    {{ Str::limit($popularPost->title, 50) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $popularPost->visited }} views</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
