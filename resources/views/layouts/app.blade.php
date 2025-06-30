<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    @include('layouts.partials.head')
        @stack('styles')
</head>

<body class="bg-gray-100 text-gray-900">

    @include('layouts.partials.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    @yield('script')
    @stack('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('navbar-search');
        const resultsBox = document.getElementById('search-results');

        input.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length < 2) {
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            fetch(`/search/posts?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(posts => {
                    if (!posts.length) {
                        resultsBox.innerHTML = `<div class="px-4 py-2 text-red-700 text-sm">لا توجد نتائج</div>`;
                    } else {
                        resultsBox.innerHTML = posts.map(post => `
    <a href="/posts/${post.slug}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 ">
        <img src="/storage/${post.image}" alt="${post.title}" class="w-18 h-18 object-cover flex-shrink-0 ">
        <div class="text-lg font-medium text-gray-800 truncate">${post.title}</div>
    </a>
`).join('');

                    }

                    resultsBox.classList.remove('hidden');
                })
                .catch(() => {
                    resultsBox.classList.add('hidden');
                });
        });

        // Hide on outside click
        document.addEventListener('click', (e) => {
            const target = e.target;
            if (!input.contains(target) && !resultsBox.contains(target)) {
                resultsBox.classList.add('hidden');
            }
        });
    });
</script>
</body>

</html>
