@extends('layouts.app')

@section('title', 'Welcome to My Blog')
@section('meta_description', 'Read the latest posts on various topics.')
@push('styles')
    <style>
        .custom-pagination {
            position: absolute;
            bottom: 0.5rem;
            right: 10px;
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .custom-pagination .swiper-pagination-bullet {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            background-color: white;
            color: black;
            font-weight: bold;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .custom-pagination .swiper-pagination-bullet-active {
            background-color: #2563eb;
            color: white;
        }
    </style>
@endpush
@section('content')
<div class="max-w-[1800px] mx-auto px-2 sm:px-4 py-6 space-y-8 font-almarai">  <!-- Changed max-width and padding -->
    {{-- Mobile: Categories & Tags as Dropdown --}}
    <div class="md:hidden space-y-4">
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
                @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->paginate(15) as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                       class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </details>
    </div>

    {{-- Main Grid Layout --}}
<div class="grid md:grid-cols-12 gap-6">

    {{-- Unified Sidebar (Categories, Tags, Most Visited) --}}
    <aside class="hidden md:block md:col-span-3 space-y-6">
        {{-- Most Visited --}}
        @include('components.most-visited')

        {{-- Categories --}}
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-base font-bold mb-2">Categories</h2>
            <ul class="space-y-1 text-sm text-blue-600">
                @foreach (\App\Models\Category::limit(10)->get() as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}"
                           class="block truncate hover:text-blue-800 hover:underline">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Tags --}}
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-base font-bold mb-2">Tags</h2>
            <div class="flex flex-wrap gap-2 text-sm">
                @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->paginate(15) as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                       class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 truncate">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="md:col-span-9 space-y-8">

        {{-- Horizontal Separator --}}
        <hr class="border-gray-300 my-4">

        {{-- Featured Slider --}}
        @include('components.featured')

        {{-- Latest Blogs --}}
        <div>
            <h1 class="text-2xl font-bold mb-4">📘 أحدث المقالات</h1>
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($featuredPosts as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            </div>
        </div>

    </main>



</div>
<div>
     {{-- Horizontal Separator --}}
        <hr class="border-gray-300 my-4">
        <div>
            <h1 class="text-4xl font-extrabold mb-4"> الاحداث </h1>
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                @foreach ($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            </div>
        </div>

</div>

</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.featured-posts-slider', {
            loop: false,
            autoplay: false,
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return `<span class="${className}">${index + 1}</span>`;
                },
            },
        });
    });
</script>

@endsection




