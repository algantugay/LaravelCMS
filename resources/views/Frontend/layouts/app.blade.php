<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Frontend')</title>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>
<body>
    @include('frontend.partials.header') <!-- Header -->
    
    <main class="container mt-4">
        @yield('content') <!-- İçerik -->
    </main>

    @include('frontend.partials.footer') <!-- Footer -->

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
</body>
</html>
