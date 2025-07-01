{{-- Sports Posts Grid --}}
<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
    @foreach ($sportsPosts as $post)
        @include('components.post-card', ['post' => $post])
    @endforeach
</div>

{{-- Sports Pagination --}}
<div class="mt-6 flex justify-center gap-4" id="sports-pagination">
    @if ($sportsPosts->onFirstPage() === false)
        <button
            class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
            onclick="loadSportsPosts('{{ $sportsPosts->previousPageUrl() }}')">← السابق</button>
    @endif

    @if ($sportsPosts->hasMorePages())
        <button
            class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
            onclick="loadSportsPosts('{{ $sportsPosts->nextPageUrl() }}')">التالي →</button>
    @endif
</div>
