<nav class="fixed top-0 left-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        {{-- Left: Auth links --}}
        <div class="flex items-center space-x-4 text-sm font-medium">
            @guest
                <a  class="text-gray-700 hover:text-indigo-600">Login</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600">Register</a>
            @else
                <span class="text-gray-700">Hi, {{ Auth::user()->name }}</span>
                {{-- action="{{ route('logout') }}" --}}
                <form method="POST" >
                    @csrf
                    <button class="text-gray-700 hover:text-indigo-600" type="submit">Logout</button>
                </form>
            @endguest
        </div>

        {{-- Right: Category links --}}
        <div class="flex items-center space-x-4 text-sm font-medium">
            @foreach(\App\Models\Category::limit(4)->get() as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                   class="text-gray-700 hover:text-indigo-600">
                    {{ $category->name }}
                </a>
            @endforeach

            {{-- <a href="{{ route('contact') }}" class="text-gray-700 hover:text-indigo-600">Contact</a> --}}
        </div>
    </div>
</nav>
