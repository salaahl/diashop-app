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
    @vite(['resources/css/app/app.css', 'resources/css/app/navigation.css', 'resources/css/app/basket.css'])
    @show

</head>

<body class="font-sans antialiased">

    <noscript>
        <style>
            body {
                display: none;
            }
        </style>
        <div>
            <p>Votre navigateur ne supporte pas JavaScript ou il est désactivé. Veuillez activer JavaScript pour accéder à ce site.</p>
        </div>
    </noscript>

    <!-- Page Loader -->
    <div id="loader-container">
        <div class="left-layer left-layer--1"></div>
        <div class="left-layer left-layer--2"></div>
        <div class="left-layer left-layer--3"></div>
        <div class="right-layer right-layer--1">
            @include('components.clothes-animation')
        </div>
        <div class="right-layer right-layer--2"></div>
        <div class="right-layer right-layer--3"></div>
    </div>

    <div id="main-container" class="min-h-full flex flex-col justify-between">
        @if(Route::is('home') || Route::is('catalog') || Route::is('category') || Route::is('product') || Route::is('basket'))
        @include('components.banner-top')
        @endif

        <!-- Page Heading -->
        <header id="navbar-container" class="h-[80px]">
            @section('header')
            @include('layouts.navigation')
            @include('components.search-product')
            @show
        </header>

        <aside>
            @include('components.basket')
        </aside>

        <!-- Page Content -->
        <main>
            <div id="popup"></div>
            @if(session('error'))
            <script>
                const popUp = document.getElementById("popup");
                popUp.innerHTML = "{{ session('error') }}";
                popUp.classList.add("show");

                setTimeout(function() {
                    popUp.classList.remove("show");
                }, 5000);
            </script>
            @endif
            @yield('main')
        </main>

        <!-- Page Footer -->
        <footer>
            @section('footer')
            @include('layouts.footer')
            @show
        </footer>
    </div>

    <!-- Page Scripts -->
    @section('scripts')
    @vite(['resources/js/app.js', 'resources/js/search-product.js', 'resources/js/basket.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Gestion du panier -->
    <script>
        const hasBasket = "{{ session()->has('basket') ? true : false }}";

        /*
         * Cas de figure 1 : tous les onglets sont fermés :
         */

        // Fonction pour mettre à jour le compteur d'onglets
        const updateTabCount = (increment) => {
            const currentCount = parseInt(localStorage.getItem('tabCount')) || 0;
            const newCount = currentCount + increment;
            localStorage.setItem('tabCount', newCount);
        };

        // Ajouter un onglet
        updateTabCount(1);

        // Retirer un onglet lors de la fermeture
        window.addEventListener("beforeunload", function() {
            updateTabCount(-1);
        });

        // Fonction pour supprimer le panier si tous les onglets sont fermés
        const checkAndDeleteBasket = () => {
            const count = parseInt(localStorage.getItem('tabCount'));

            // Si aucun onglet n'est ouvert et que le panier existe
            if (count <= 0 && hasBasket) {
                // Supprimer le panier immédiatement
                const request = new Request("/basket/destroy", {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('[name="csrf-token"]')
                            .getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                });

                fetch(request)
                    .catch((error) => {
                        console.log(error.message);
                    });
            }
        };

        // Vérifie l'état lors du chargement de la page
        window.addEventListener("load", checkAndDeleteBasket);


        /*
         * Cas de figure 2 : l'onglet est laissé ouvert
         */
        let basketTimeout = parseInt(localStorage.getItem('basket_timeout')) || 3600000;
        let basketStartTime = parseInt(localStorage.getItem('basket_start_time')) || Date.now();

        // Met à jour le compteur d'affichage et localStorage avec le temps réel restant
        const updateBasketTimeout = () => {
            const currentTime = Date.now();
            const timeElapsed = currentTime - basketStartTime;
            const timeRemaining = basketTimeout - timeElapsed;

            if (hasBasket && timeRemaining <= 0) {
                clearInterval(intervalID);
                deleteBasket();
            } else if (hasBasket) {
                document.querySelector('#basket-timeout').innerHTML = Math.floor(timeRemaining / 60000); // Temps en minutes
            }

            localStorage.setItem('basket_timeout', basketTimeout);
            localStorage.setItem('basket_start_time', basketStartTime);
        };

        // Supprimer le panier lorsque le temps est écoulé
        const deleteBasket = () => {
            const request = new Request("/basket/destroy", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
            });

            fetch(request)
                .then((response) => {
                    if (response.ok) {
                        // Mettre à jour l'interface utilisateur
                        document.querySelector('#summary-container').innerHTML = `
                            <div id="basket-empty" class="h-full w-full">
                                <h3 class="absolute top-1/2 left-0 right-0 px-1 text-center text-balance">Vous n'avez pas de produits dans votre panier</h3>
                            </div>`;
                        // Remettre le compteur à zéro
                        document.querySelectorAll(".basket-counter").forEach((counter) => {
                            counter.innerHTML = 0;
                        });
                    }
                })
                .catch((error) => {
                    console.log(error.message);
                });
        };

        const intervalID = setInterval(updateBasketTimeout, 60000);

        updateBasketTimeout();
    </script>
    @show
</body>

</html>