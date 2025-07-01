<div id="posts-container">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @foreach ($posts as $post)
            @include('components.post-card', ['post' => $post])
        @endforeach
    </div>

    <div class="mt-6 flex justify-center gap-4" id="posts-pagination">
        @if ($posts->onFirstPage() === false)
            <button
                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
                onclick="loadPosts('{{ $posts->previousPageUrl() }}')">← السابق</button>
        @endif

        @if ($posts->hasMorePages())
            <button
                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
                onclick="loadPosts('{{ $posts->nextPageUrl() }}')">التالي →</button>
        @endif
    </div>
</div>
