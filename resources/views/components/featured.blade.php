@if($featuredPosts->count())
<div class="flex justify-center">
    <div class="w-full max-w-[15cm] md:max-w-full relative">
        <div class="swiper featured-posts-slider overflow-hidden shadow-lg">
            <div class="swiper-wrapper">
                @foreach ($featuredPosts as $post)
                    <div class="swiper-slide">
                        <a href="{{ route('posts.show', $post->slug) }}" class="relative block group">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="w-full h-40 sm:h-56 md:h-144 object-cover"
                                 alt="{{ $post->title }}">

                            {{-- Overlay text at the bottom --}}
                            <div class="absolute bottom-0 left-0 w-full bg-black/60 px-4 py-2">
                                <h3 class="text-white font-almarai font-bold text-base sm:text-xl md:text-2xl">
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
