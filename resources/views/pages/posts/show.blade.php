@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <div id="visit-tracker" data-slug="{{ $post->slug }}" data-url="{{ route('posts.incrementVisitBySlug', $post->slug) }}"></div>
    <h1 class="text-5xl font-extrabold mb-4">{{ $post->title }}</h1>

    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="w-full  mb-4" alt="{{ $post->title }}">
    @endif

    <p class="text-sm text-gray-500 mb-2">
        By {{ $post->user->name }} · {{ $post->created_at?->format('F j, Y') }}
    </p>

    <p class="text-lg mb-6 text-gray-900">{{ $post->meta_title }}</p>

    <hr class="my-6">

    @foreach ($post->sections as $section)
        <div class="mb-8">
            @if ($section->title)
                <h2 class="text-4xl font-bold mb-2">{{ $section->title }}</h2>
            @endif

            @if ($section->video)
                <div class="mb-4">
                    <video controls class="w-full ">
                        <source src="{{ asset('storage/' . $section->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            {{-- @elseif ($section->video_url)
                <div class="mb-4">
                    <iframe
                        src="{{ $section->video_url }}"
                        class="w-full h-64 rounded"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                </div> --}}
            @endif

            <p class="text-3xl text-black leading-relaxed">{{ $section->content }}</p>
             @if ($section->image)
                <img src="{{ asset('storage/' . $section->image) }}" class="w-full  mb-4" alt="Section Image">
            @endif
            @if ($section->link)
                <p class="mt-2">
                    <a href="{{ $section->link }}" class="text-blue-600 underline" target="_blank">قراءة المزيد</a>
                </p>
            @endif
        </div>
    @endforeach
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const tracker = document.getElementById('visit-tracker');
    if (!tracker) return;

    const slug = tracker.dataset.slug;
    const url = tracker.dataset.url;

    // Session-based tracking (will reset when browser closes)
    const sessionKey = `session_visit_${slug}`;

    // Check if we've already counted this visit in current session
    if (!sessionStorage.getItem(sessionKey)) {
        // Wait 5 seconds before counting to prevent quick refreshes
        setTimeout(() => {
            // Only count if page is still visible after 5 seconds
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
                        // Mark as counted in this session
                        sessionStorage.setItem(sessionKey, 'true');
                        console.log('Visit counted for this session');
                    }
                }).catch(error => {
                    console.error('Error counting visit:', error);
                });
            }
        }, 5000); // 5-second delay
    }
});
</script>
@endpush
