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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    
    <!-- Gestion du panier -->
    <script>
        const hasBasket = {{ session()->has("basket") ? true : false }};
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
        window.addEventListener("beforeunload", function () {
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
                    .then((response) => response.json())
                    .then((data) => {
                        // Peut-être supprimer le dernier .then ?
                    })
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
        if(hasBasket) {
            document.querySelector('#basket_timeout').innerHTML = localStorage.getItem('basket_timeout') / 60000;

            setInterval(() => {
                // J'enlève 1 minute
                localStorage.setItem(
                    'basket_timeout', localStorage.getItem('basket_timeout') - 60000
                );

                // Me donne le temps restant en minutes
                document.querySelector('#basket_timeout').innerHTML = localStorage.getItem('basket_timeout') / 60000;
            }, localStorage.getItem('basket_timeout') / 60); // Se lance toutes les minutes

            setTimeout(() => {
                // Je supprime le panier et je recrédite la quantité dans la BDD
                const request = new Request("/basket/destroy", {
                    method: "DELETE",
                    // body: JSON.stringify(data),
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('[name="csrf-token"]')
                            .getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                });

                fetch(request)
                    .then((response) => response.json())
                    .then((data) => {
                        alert('Panier supprimé.');

                        // Suppression du tableau côté client
                        document.querySelector('#summary-container').innerHTML = `
                            <div id="basket-empty" class="h-full w-full">
                                <h3 class="absolute top-1/2 left-0 right-0 px-1 text-center text-balance">Vous n'avez pas de produits dans votre panier</h3>
                            </div>`;
                        
                        // Actualisation du compteur
                        document.querySelectorAll(".basket-counter").forEach((counter) => {
                            counter.innerHTML = 0;
                        });

                        // Ajouter une ligne qui effacera le décompte également
                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            }, localStorage.getItem('basket_timeout'));
        }
    </script>
    @show
</body>

</html>