<article class="bg-white shadow p-2">
    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">

    <h2 class="text-xl font-extrabold mt-4">
        <a href="{{ route('posts.show', $post->slug) }}" class="text-black hover:underline">
            {{ $post->title }}
        </a>
    </h2>

    <p class="text-sm text-gray-600 mt-2">{{ $post->excerpt }}</p>
</article>
