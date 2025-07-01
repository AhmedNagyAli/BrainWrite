@extends('layouts.app')

@section('title', 'BrainWrite')
@section('meta_description', 'Read the latest posts on various topics.')
@push('styles')
   <style>
    /* Modified pagination styling for left side */
    .custom-pagination {
        position: absolute;
        bottom: 0.5rem;
        left: 10px; /* Changed from right to left */
        display: flex;
        gap: 0.5rem;
        z-index: 10;
        flex-direction: row-reverse; /* Reverse order for RTL */
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

    /* Swiper fixes */
    .swiper {
        width: 100%;
        height: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        width: 100% !important;
        height: auto;
        position: relative;
    }
</style>
@endpush
@section('content')
<div class="max-w-[1800px] mx-auto px-2 sm:px-4 py-2 space-y-8 font-almarai">
    @include('layouts.partials.sidebar-left')

    <hr class="border-gray-500 my-4">

    <div>
        <h1 class="text-5xl font-extrabold mb-4"> الاخبار </h1>

        <div id="posts-wrapper">
    @include('components.sections.main', ['posts' => $posts])
</div>

<hr class="border-gray-500 my-8">

<h2 class="text-4xl font-extrabold mb-4">رياضة</h2>

<div id="sports-wrapper">
    @include('components.sections.sports', ['sportsPosts' => $sportsPosts])
</div>

    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection




