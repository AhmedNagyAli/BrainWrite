{{-- Categories --}}
            <div class="bg-white p-4 shadow rounded">
                <h2 class="text-base font-bold mb-2">Categories</h2>
                <ul class="space-y-1 text-sm text-blue-600">
                    @foreach (\App\Models\Category::limit(10)->get() as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat->slug) }}"
                               class="hover:text-blue-800 hover:underline {{ $cat->id === $category->id ? 'font-bold text-blue-800' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
