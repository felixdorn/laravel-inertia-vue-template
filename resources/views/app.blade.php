<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    @vite('resources/css/app.css')
    @vite('resources/js/app.ts')
    @inertiaHead
</head>
<body class="font-sans antialiased h-full">
@inertia
</body>
</html>
