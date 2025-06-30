@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-[1800px] mx-auto px-2 sm:px-4 py-6 space-y-8 font-almarai">

    {{-- Mobile: Categories & Tags as Dropdown --}}
    <div class="md:hidden space-y-4">
        <details class="bg-white p-4 shadow rounded">
            <summary class="text-lg font-semibold cursor-pointer">📂 التصنيفات</summary>
            <ul class="mt-2 space-y-2 text-sm text-blue-700">
                @foreach (\App\Models\Category::limit(10)->get() as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="hover:underline hover:text-blue-900 {{ $cat->id === $category->id ? 'font-bold text-blue-900' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        <details class="bg-white p-4 shadow rounded">
            <summary class="text-lg font-semibold cursor-pointer">🏷️ الوسوم</summary>
            <div class="mt-2 flex flex-wrap gap-2 text-sm">
                @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->get() as $tag)
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

        {{-- Sidebar (Categories, Tags, Most Visited) --}}
        <aside class="hidden md:block md:col-span-3 space-y-6">
            {{-- Most Visited --}}
            @include('components.most-visited')

            {{-- Categories --}}
            {{-- <div class="bg-white p-4 shadow rounded">
                <h2 class="text-base font-bold mb-2">التصنيفات</h2>
                <ul class="space-y-1 text-sm text-blue-600">
                    @foreach (\App\Models\Category::limit(10)->get() as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat->slug) }}"
                               class="block truncate hover:text-blue-800 hover:underline {{ $cat->id === $category->id ? 'font-bold text-blue-800' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}

            {{-- Tags --}}
            <div class="bg-white p-4 shadow rounded">
                <h2 class="text-base font-bold mb-2">الوسوم</h2>
                <div class="flex flex-wrap gap-2 text-sm">
                    @foreach (\App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(15)->get() as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}"
                           class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 truncate">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="md:col-span-9 space-y-6">
            <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

            @if ($posts->count())
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        @include('components.post-card', ['post' => $post])
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            @else
                <p class="text-gray-600">لا توجد مقالات في هذا التصنيف.</p>
            @endif
        </main>

    </div>
</div>
@endsection
