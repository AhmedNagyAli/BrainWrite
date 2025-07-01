@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-5xl mx-auto p-4">
    <div id="visit-tracker" data-slug="{{ $post->slug }}" data-url="{{ route('posts.incrementVisitBySlug', $post->slug) }}"></div>

    <!-- Article Header -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 text-black">{{ $post->title }}</h1>

        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="w-full rounded-lg shadow-md mb-4" alt="{{ $post->title }}">
        @endif

        <div class="flex items-center text-lg text-gray-800 mb-6">
            <span>بواسطة {{ $post->user->name }}</span>
            <span class="mx-2">•</span>
            <span>{{ $post->created_at?->format('F j, Y') }}</span>
            <span class="mx-2">•</span>
            {{-- <span>{{ $post->visited }} زيارة</span> --}}
        </div>

        @if($post->meta_title)
            <p class="text-lg text-black mb-6 leading-relaxed">{{ $post->meta_title }}</p>
        @endif
    </div>

    <hr class="my-6 border-gray-300">

    <!-- Article Content -->
    <article class="prose prose-lg max-w-none text-gray-800">
        @foreach ($post->sections as $section)
            <div class="mb-10">
                @if ($section->title)
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-black">{{ $section->title }}</h2>
                @endif

                @if ($section->video)
                    <div class="mb-6 rounded-lg overflow-hidden">
                        <video controls class="w-full">
                            <source src="{{ asset('storage/' . $section->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif

                <div class="text-2xl leading-relaxed text-gray-900 font-semibold">
                    {!! nl2br(e($section->content)) !!}
                </div>

                @if ($section->image)
                    <img src="{{ asset('storage/' . $section->image) }}" class="w-full rounded-lg shadow-md my-6" alt="Section Image">
                @endif

                @if ($section->link)
                    <p class="mt-4">
                        <a href="{{ $section->link }}" class="text-blue-600 hover:underline font-medium" target="_blank">قراءة المزيد</a>
                    </p>
                @endif
            </div>
        @endforeach
    </article>

    <!-- In-Article Recommended Post -->
    @if($generalRecommendedPost)
    <div class="my-12 bg-gray-50 p-6 rounded-xl border border-gray-200">
        {{-- <h3 class="text-xl font-bold mb-4 text-gray-800">مقالة ذات صلة</h3> --}}
        <a href="{{ route('posts.show', $generalRecommendedPost->slug) }}" class="block group">
            <div class="flex flex-col md:flex-row gap-6">
                @if($generalRecommendedPost->image)
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/' . $generalRecommendedPost->image) }}"
                         alt="{{ $generalRecommendedPost->title }}"
                         class="w-full h-48 object-cover rounded-lg shadow-sm group-hover:shadow-md transition">
                </div>
                @endif
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded">
                            {{ $generalRecommendedPost->category->name ?? '' }}
                        </span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition">
                        {{ $generalRecommendedPost->title }}
                    </h4>
                    <p class="text-gray-800 mt-2 line-clamp-2">
                        {{ $generalRecommendedPost->excerpt ?? Str::limit(strip_tags($generalRecommendedPost->sections->first()->content ?? ''), 150) }}
                    </p>
                </div>
            </div>
        </a>
    </div>
    @endif
</div>

<!-- Bottom Recommended Posts -->
@if($recommendedPosts->count())
<div class="max-w-4xl mx-auto px-4 pb-12">
    <div class="border-t border-gray-200 pt-8">
        <h3 class="text-2xl font-bold mb-6 text-gray-900">مقالات أخرى قد تعجبك</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recommendedPosts as $recommended)
            <a href="{{ route('posts.show', $recommended->slug) }}" class="block group">
                <div class="flex flex-col h-full border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">
                    @if($recommended->image)
                    <img src="{{ asset('storage/' . $recommended->image) }}"
                         alt="{{ $recommended->title }}"
                         class="w-full h-40 object-cover">
                    @endif
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-medium text-blue-600">
                                {{ $recommended->category->name ?? '' }}
                            </span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $recommended->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">
                            {{ $recommended->title }}
                        </h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tracker = document.getElementById('visit-tracker');
        if (!tracker) return;

        const slug = tracker.dataset.slug;
        const url = tracker.dataset.url;
        const sessionKey = `session_visit_${slug}`;

        if (!sessionStorage.getItem(sessionKey)) {
            setTimeout(() => {
                if (document.visibilityState === 'visible') {
                    fetch(url, {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        credentials: "same-origin"
                    }).then(response => {
                        if (response.ok) {
                            sessionStorage.setItem(sessionKey, 'true');
                        }
                    }).catch(error => {
                        console.error('Error counting visit:', error);
                    });
                }
            }, 5000);
        }
    });
</script>
@endpush
