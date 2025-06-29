{{-- Tags --}}
                <div class="bg-white p-4 shadow rounded">
    <h2 class="text-base font-bold mb-2">Tags</h2>
    <div class="flex flex-wrap gap-2 text-sm">
        @foreach (\App\Models\Tag::limit(15)->get() as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}"
               class="bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 whitespace-nowrap max-w-full truncate {{ $tag->id === $currentTag->id ? 'font-bold text-blue-800' : ''  }}">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>
