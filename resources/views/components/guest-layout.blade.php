<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'الموقع' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">    @vite('resources/css/app.css')
</head>
<body class="font-arabic bg-gray-50 text-gray-800">
    {{ $slot }}
</body>
</html>
