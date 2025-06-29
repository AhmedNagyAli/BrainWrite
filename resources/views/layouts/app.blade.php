<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    @include('layouts.partials.head')
        @stack('styles')
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.partials.navbar')

    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    @yield('script')
    <script>
    document.getElementById('darkModeToggle').addEventListener('click', function () {
        document.documentElement.classList.toggle('dark');
        // Optional: store preference
        if (localStorage.getItem('theme') === 'dark') {
            localStorage.removeItem('theme');
        } else {
            localStorage.setItem('theme', 'dark');
        }
    });

    // Load saved theme on page load
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>

</body>

</html>
