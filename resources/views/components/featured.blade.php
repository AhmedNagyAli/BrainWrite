@if($featuredPosts->count())
<div class="w-full overflow-hidden">
    <div class="swiper featured-posts-slider w-full">
        <div class="swiper-wrapper">
            @foreach ($featuredPosts as $post)
                <div class="swiper-slide">
                    <a href="{{ route('posts.show', $post->slug) }}" class="relative block w-full h-full">
                        <!-- Image container with aspect ratio -->
                        <div class="w-full h-0 pb-[56.25%] relative overflow-hidden">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="absolute inset-0 w-full h-full object-cover"
                                 alt="{{ $post->title }}"
                                 loading="lazy">
                        </div>

                        <!-- Overlay text at the bottom -->
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 via-black/50 to-transparent px-4 py-3">
                            <h3 class="text-white font-almarai font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl line-clamp-2">
                                {{ $post->title }}
                            </h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <!-- Custom pagination moved to left side -->
        <div class="custom-pagination swiper-pagination"></div>
    </div>
</div>
@endif
