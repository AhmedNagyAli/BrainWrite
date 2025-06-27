@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-4xl mx-auto p-6">
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
        <p>No posts found in this category.</p>
    @endif
</div>
@endsection
