<!DOCTYPE html>
<html lang="fr">

<head>
    @section('meta')
    <meta charset="utf-8">
    <meta name="google-site-verification" content="u6Q3jftadcv6uAc_nla0Nk38Je3fXVXpUpVeyMSwXQk" />
    <meta name="author" lang="fr" content="Salaha Sokhona pour DiaShop-b">
    <meta name="keywords" content="prêt-à-porter, mode, vêtements, tendance, style, habillement">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @show

    <title>@yield('title')DiaShop-b</title>

    @section('links')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Truculenta:opsz,wght@12..72,100..900&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    @vite(['resources/css/app/app.css', 'resources/css/app/navigation.css'])
    @show

</head>

<body class="font-sans antialiased">

    <!-- Page Loader -->
    <div id="loader-container">
        <div class="left-layer"></div>
        <div class="left-layer left-layer--2"></div>
        <div class="left-layer left-layer--3"></div>
        <div class="right-layer"></div>
        <div class="right-layer right-layer--2"></div>
        <div class="right-layer right-layer--3"></div>
    </div>

    <div id="main-container">
        @if(Route::is('home') || Route::is('catalog') || Route::is('category') || Route::is('product') || Route::is('basket'))
        <x-banner-top />
        @endif

        <!-- Page Heading -->
        <header id="navbar-container" class="h-[80px]">
            @section('header')
            @include('layouts.navigation')
            @include('components.search-product')
            @include('components.basket')
            @show
        </header>

        <!-- Page Content -->
        <main>
            @yield('main')
        </main>

    </div>

    <!-- Page Footer -->
    <footer>
        @section('footer')
        @include('layouts.footer')
        @show
    </footer>

    <!-- Page Scripts -->
    @section('scripts')
    @vite(['resources/js/app.js', 'resources/js/search-product.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.js"></script>
    @show
</body>

</html>
