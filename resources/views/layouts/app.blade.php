<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

</body>

</html>
