<div id="posts-container">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @foreach ($posts as $post)
            @include('components.post-card', ['post' => $post])
        @endforeach
    </div>

    <div class="mt-6 flex justify-end gap-4" id="posts-pagination">
        @if ($posts->onFirstPage() === false)
            <button
                class="w-10 h-10 flex items-center justify-center bg-gray-300 text-black rounded-lg hover:bg-gray-500 transition"
                onclick="loadPosts('{{ $posts->previousPageUrl() }}')"
                aria-label="السابق">
                {{-- Right Arrow --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7" />
                </svg>

            </button>
        @endif

        @if ($posts->hasMorePages())
            <button
                class="w-10 h-10 flex items-center justify-center bg-gray-300 text-black rounded-lg hover:bg-gray-500 transition"
                onclick="loadPosts('{{ $posts->nextPageUrl() }}')"
                aria-label="التالي">
                {{-- Left Arrow --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>

            </button>
        @endif
    </div>
</div>
