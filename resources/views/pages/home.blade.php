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
<div class="max-w-[1800px] mx-auto px-2 sm:px-4 py-2 space-y-8 font-almarai">  <!-- Changed max-width and padding -->
@include('layouts.partials.sidebar-left')
<div>
     {{-- Horizontal Separator --}}
        <hr class="border-gray-500 my-4">
        <div>
            <h1 class="text-5xl font-extrabold mb-4"> الاخبار </h1>
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
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.featured-posts-slider', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: false,
        autoHeight: false,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            renderBullet: function (index, className) {
                return `<span class="${className}">${index + 1}</span>`;
            },
        },
        observer: true,
        observeParents: true,
        observeSlideChildren: true
    });

    // Force update after images load
    const images = document.querySelectorAll('.featured-posts-slider img');
    images.forEach(img => {
        img.addEventListener('load', () => {
            swiper.update();
        });
    });
});
</script>

@endsection




