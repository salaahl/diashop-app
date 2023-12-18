<!DOCTYPE html>
<html lang="fr">

<head>
    @section('meta')
    <meta charset="utf-8">
    <meta name="author" lang="fr" content="Salaha SOKHONA">
    <meta name="copyright" content="Salaha SOKHONA pour Diashop.">
    <meta name="description" content="Vente de prêt à porter.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @show

    <title>@yield('title')</title>

    @section('links')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    @vite(['resources/css/app/app.css', 'resources/css/app/navigation.css', 'resources/css/app/footer.css'])
    @show

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">

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

        <!-- Page Footer -->
        <footer>
            @section('footer')
            @include('components.footer')
            @show
        </footer>

        <!-- Page Scripts -->
        @section('scripts')
        @vite(['resources/js/app.js', 'node_modules/flowbite/dist/flowbite.min.js'])
        @show

    </div>
</body>

</html>