{{-- Main Content --}}
<main class="md:col-span-9 space-y-6">
    {{-- Horizontal Separator --}}
    <hr class="border-gray-300 my-2">

    {{-- Featured Slider --}}
    @include('components.featured')

    {{-- Latest Blogs --}}
    <div>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($latestPosts as $post)
                @include('components.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</main>

@push('scripts')
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

@endpush
