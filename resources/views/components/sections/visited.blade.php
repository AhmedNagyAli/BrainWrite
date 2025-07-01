{{-- Reusable Section Template --}}
<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
    @foreach ($posts as $post)
        @include('components.post-card', ['post' => $post])
    @endforeach
</div>

<div class="mt-6 flex justify-center gap-4">
    @if ($posts->onFirstPage() === false)
        <button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
                onclick="loadSection('{{ $posts->previousPageUrl() }}', '{{ $sectionId }}')">← السابق</button>
    @endif

    @if ($posts->hasMorePages())
        <button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
                onclick="loadSection('{{ $posts->nextPageUrl() }}', '{{ $sectionId }}')">التالي →</button>
    @endif
</div>
