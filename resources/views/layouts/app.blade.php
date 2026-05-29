<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Glad Moments & Co | Wedding, Photobooth & Events')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Global Liquid Gradient Page Transition curtains -->
    <div class="page-transition-overlay-container">
        <div class="transition-curtain curtain-1"></div>
        <div class="transition-curtain curtain-2"></div>
    </div>

    @section('navbar')
        @include('components.navbar')
    @show

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script src="{{ asset('js/index.js') }}"></script>
    @yield('scripts')
</body>
</html>