@if($featuredPosts->count())
<div class="flex justify-center">
    <div class="w-full max-w-[15cm] md:max-w-full relative">
        <div class="swiper featured-posts-slider overflow-hidden shadow-lg">
            <div class="swiper-wrapper">
                @foreach ($featuredPosts as $post)
                    <div class="swiper-slide">
                        <a href="{{ route('posts.show', $post->slug) }}" class="relative block group">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="w-full h-40 sm:h-56 md:h-64 object-cover"
                                 alt="{{ $post->title }}">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                <h3 class="text-white text-sm sm:text-lg font-bold text-center px-4">
                                    {{ $post->title }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination custom-pagination"></div>
        </div>
    </div>
</div>
@endif
