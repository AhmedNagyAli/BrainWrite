@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="w-full  mb-4" alt="{{ $post->title }}">
    @endif

    <p class="text-sm text-gray-500 mb-2">
        By {{ $post->user->name }} · {{ $post->published_at?->format('F j, Y') }}
    </p>

    <p class="text-lg mb-6 text-gray-700">{{ $post->excerpt }}</p>

    <hr class="my-6">

    @foreach ($post->sections as $section)
        <div class="mb-8">
            @if ($section->title)
                <h2 class="text-2xl font-semibold mb-2">{{ $section->title }}</h2>
            @endif

            @if ($section->image)
                <img src="{{ asset('storage/' . $section->image) }}" class="w-full  mb-4" alt="Section Image">
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

            <p class="text-gray-800 leading-relaxed">{{ $section->content }}</p>

            @if ($section->link)
                <p class="mt-2">
                    <a href="{{ $section->link }}" class="text-blue-600 underline" target="_blank">Read more</a>
                </p>
            @endif
        </div>
    @endforeach
</div>
@endsection
