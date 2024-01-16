<!DOCTYPE html>
<html lang="fr">

<head>
    @section('meta')
    <meta charset="utf-8">
    <meta name="author" lang="fr" content="Salaha Sokhona pour DiaShop">
    <meta name="keywords" content="prêt-à-porter, mode, vêtements, tendance, style, habillement">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @show

    <title>@yield('title')</title>

    @section('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    @vite(['resources/css/app/app.css', 'resources/css/app/navigation.css', 'resources/css/app/footer.css'])
    @show

</head>

<body class="font-sans antialiased">

    <!-- Page Loader -->
    <div id="loader-container">
        <div class="spinner"></div>
    </div>

    <div class="main-container min-h-screen" style="opacity: 0;">

        <!-- Page Heading -->
        <header>
            @section('header')
            @include('layouts.navigation')
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
        @include('components.footer')
        @show
    </footer>

    <!-- Page Scripts -->
    @section('scripts')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        /* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.querySelector("header").style.top = "0%";
            } else {
                document.querySelector("header").style.top = "-10%";
            }
            prevScrollpos = currentScrollPos;
        }

        // Loader des pages
        window.addEventListener("load", () => {
            document.querySelector("#loader-container").style.display = "none";
            document.querySelector(".main-container").style.opacity = "1";
        });
    </script>
    @show
</body>

</html>