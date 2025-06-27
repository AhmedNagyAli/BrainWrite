<article class="bg-white shadow rounded p-4">
    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded">
    <h2 class="text-xl font-semibold mt-4">
        <a href="">{{ $post->title }}</a>
    </h2>
    <p class="text-sm text-gray-600 mt-2">{{ $post->excerpt }}</p>
</article>
