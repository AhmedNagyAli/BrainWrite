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
            class="w-10 h-10 flex items-center justify-center bg-gray-800 text-white rounded-full hover:bg-gray-700 transition"
            onclick="loadSportsPosts('{{ $sportsPosts->previousPageUrl() }}')"
            aria-label="السابق">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
    @endif

    @if ($sportsPosts->hasMorePages())
        <button
            class="w-10 h-10 flex items-center justify-center bg-gray-800 text-white rounded-full hover:bg-gray-700 transition"
            onclick="loadSportsPosts('{{ $sportsPosts->nextPageUrl() }}')"
            aria-label="التالي">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    @endif
</div>
