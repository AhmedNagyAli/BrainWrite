@extends('layouts.app')

@section('title', 'المحفوظات')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">📚 المقالات المحفوظة</h1>

    @if ($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                @include('components.post-card', ['post' => $post])
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center">لا توجد مقالات محفوظة حتى الآن.</p>
    @endif
</div>
@endsection
