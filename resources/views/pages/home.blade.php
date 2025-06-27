@extends('layouts.app')

@section('title', 'Welcome to My Blog')
@section('meta_description', 'Read the latest posts on various topics.')

@section('content')
    <section class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Latest Posts</h1>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                @include('components.post-card', ['post' => $post])
            @endforeach
        </div>
    </section>
@endsection
