<nav id="navbar">
    <div class="h-full w-full flex flex-wrap items-center justify-between mx-auto xl:p-0">
        <a href="/" id="logo" class="h-full flex flex-col justify-center items-center absolute top-0 left-2/4 right-2/4">
            <span class="self-center uppercase font-semibold whitespace-nowrap">{{ env("APP_NAME") }}</span>
        </a>
        <div class="has-mobile-nav-btn flex lg:hidden">
            <button
                data-modal-target="search-modal"
                data-modal-toggle="search-modal"
                class="search-btn nav-btn has-search-counter relative inline-flex items-center w-6 h-6 mr-4 justify-center text-sm text-gray-500"
                type="button">
                <svg class="w-[21px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="none">
                    <path fill="rgb(0, 0, 0, 0.6)" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
            </button>
            <button
                data-modal-target="basket-modal"
                data-modal-toggle="basket-modal"
                class="basket-btn nav-btn has-basket-counter relative inline-flex items-center w-6 h-6 justify-center text-sm text-gray-500"
                type="button">
                <svg class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="none">
                    <path fill="rgb(0, 0, 0, 0.6)" d="M236.67-50.67q-43.83 0-74.92-31.08-31.08-31.09-31.08-74.92V-630q0-44.1 31.08-75.38 31.09-31.29 74.92-31.29h70.66v-6.66q2.34-69.67 52.3-118.17Q409.6-910 479.98-910t120.7 48.5Q651-813 653.33-743.33v6.66h70q44.1 0 75.39 31.29Q830-674.1 830-630v473.33q0 43.83-31.28 74.92-31.29 31.08-75.39 31.08H236.67Zm0-106h486.66V-630h-70v66.67q0 22.1-15.83 37.71Q621.67-510 599.88-510q-21.5 0-37.02-15.62-15.53-15.61-15.53-37.71V-630h-134v66.67q0 22.1-15.83 37.71Q381.67-510 359.88-510q-21.5 0-37.02-15.62-15.53-15.61-15.53-37.71V-630h-70.66v473.33Zm177.66-580h132v-6.66Q544-768 525.18-785.67q-18.81-17.66-45.33-17.66T435-785.67q-18.33 17.67-20.67 42.34v6.66Zm-177.66 580V-630v473.33Z" />
                </svg>
            </button>
            @php
            $count = 0;
            if(session()->has('basket')) {
            foreach(session()->get('basket') as $item) {
            $count += count($item);
            }
            }
            @endphp
            <span class="basket-counter">{{ $count }}</span>
        </div>
        <button id="navbar-dropdown-btn" data-collapse-toggle="navbar-dropdown" type="button" class="relative inline-flex items-center w-6 h-6 justify-center text-sm text-gray-500 rounded-lg lg:hidden" aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 14" fill="none">
                <path stroke="rgb(0, 0, 0, 0.6)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
            <svg class="hidden w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="none">
                <path fill="rgb(0, 0, 0, 0.6)" d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
            </svg>
        </button>
        <div class="h-full w-full" id="navbar-dropdown">
            <div class="h-full flex max-lg:flex-col lg:justify-between justify-center items-center overflow-auto">
                <ul class="lg:h-full max-lg:w-full flex flex-col items-center max-lg:mt-[-100px] p-4 lg:p-0 max-lg:rounded-lg lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @foreach(\App\Models\Catalog::all() as $catalog)
                    <li class="has-dropdown h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('catalog', $catalog->name) }}" class="dropdownNavbarLinkCatalog hidden lg:flex items-center justify-between w-full py-2 text-sm uppercase text-gray-900 rounded hover:bg-gray-200 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">
                            <span>{{ ucfirst($catalog->name) }}</span>
                            <svg class="hidden lg:block w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button data-collapse-toggle="dropdownNavbar{{ ucfirst($catalog->name) }}" type="button" class="dropdownNavbarBtn lg:hidden flex items-center justify-center w-full mb-2 p-2 text-sm uppercase text-gray-900 rounded-lg hover:bg-gray-200 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span class="text-2xl font-bold">{{ ucfirst($catalog->name) }}</span>
                            <svg class="hidden lg:block w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown catalog menu -->
                        <div id="dropdownNavbar{{ ucfirst($catalog->name) }}" class="dropdownNavbar hidden z-10 lg:flex align-center w-full max-lg:mb-2 max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="lg:hidden self-center">
                                    <a href="{{ route('catalog', $catalog->name) }}" class="block my-2 lg:mr-4 px-4 py-2 font-bold text-lg w-fit mx-auto rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">Tout</a>
                                </li>
                                @if(\App\Models\Category::where("catalog_id", $catalog->id)->first())
                                @foreach(\App\Models\Category::where("catalog_id", $catalog->id)->get() as $category)
                                <li class="self-center">
                                    <a href="{{ route('category', [$category->catalog->name, $category->name]) }}" class="block my-2 lg:mr-4 px-4 py-2 max-lg:font-bold max-lg:text-lg w-fit mx-auto rounded-[5px] lg:rounded-full hover:bg-gray-200 whitespace-nowrap transition duration-500">
                                        {{ ucfirst($category->name) }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endforeach
                    <li class="h-full w-full hidden lg:flex lg:items-center lg:align-center">
                        <button
                            data-modal-target="search-modal"
                            data-modal-toggle="search-modal"
                            class="basket-btn nav-btn has-basket-counter flex justify-between items-center max-lg:mb-2 p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0 lg:p-0"
                            type="button">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Rechercher</span>
                        </button>
                    </li>
                </ul>
                <ul class="lg:h-full max-lg:w-full flex flex-col lg:items-center font-medium p-4 lg:p-0 mt-[-2rem] max-lg:rounded-lg lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @auth
                    <li class="has-dropdown lg:h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('dashboard') }}" id="dropdownDashboardLink" class="hidden lg:flex max-lg:justify-between items-center w-full p-2 whitespace-nowrap text-gray-900 text-sm uppercase rounded hover:bg-gray-200 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span>Mon profil</span>
                            <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button id="dropdownDashboardBtn" data-collapse-toggle="dropdownDashboard" type="button" class="dropdownNavbarBtn lg:hidden flex items-center justify-center w-full mb-2 p-2 text-sm uppercase text-gray-900 rounded-lg hover:bg-gray-200 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span class="text-2xl font-bold lg:text-normal lg:font-normal uppercase">Mon profil</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDashboard" class="dropdownNavbar hidden z-10 lg:flex align-center w-full max-lg:mb-2 max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex items-center max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="lg:hidden self-center">
                                    <a href="{{ route('dashboard') }}" class="block my-2 lg:mr-4 px-4 py-2 max-lg:font-bold max-lg:text-lg w-fit mx-auto whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                                        Tableau de bord
                                    </a>
                                </li>
                                <a href="{{ route('favorites') }}" class="block my-2 lg:mr-4 px-4 py-2 max-lg:font-bold max-lg:text-lg w-fit mx-auto whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                                    Mes favoris
                                </a>
                    </li>
                    <li class="self-center">
                        <a href="{{ route('orders') }}" class="block my-2 lg:mr-4 px-4 py-2 max-lg:font-bold max-lg:text-lg w-fit mx-auto whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                            Mes commandes
                        </a>
                    </li>
                    <li class="self-center">
                        <a href="{{ route('profile.edit') }}" class="block my-2 lg:mr-4 px-4 py-2 max-lg:font-bold max-lg:text-lg w-fit mx-auto whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                            Modifier mes informations
                        </a>
                    </li>
                </ul>
            </div>
            </li>
            @endauth
            <li class="h-full w-full hidden lg:flex lg:items-center lg:align-center">
                <button
                    data-modal-target="basket-modal"
                    data-modal-toggle="basket-modal"
                    class="basket-btn nav-btn has-basket-counter flex justify-between items-center max-lg:mb-2 p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0 lg:p-0"
                    type="button">
                    <span class="text-sm uppercase whitespace-nowrap lg:m-0">Panier</span>
                </button>
                @php
                $count = 0;
                if(session()->has('basket')) {
                foreach(session()->get('basket') as $item) {
                $count += count($item);
                }
                }
                @endphp
                <span class="basket-counter">{{ $count }}</span>
            </li>
            @guest
            <li class="h-full w-full lg:flex lg:items-center lg:align-center">
                <a href="{{ route('login') }}" class="nav-btn flex justify-center items-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0 lg:p-0">
                    <span class="text-2xl lg:text-sm font-bold lg:font-normal uppercase whitespace-nowrap lg:m-0">Se connecter</span>
                </a>
            </li>
            @endguest
            @auth
            <li class="h-full w-full lg:flex lg:items-center lg:align-center">
                <form method="POST" action="/logout">
                    @csrf
                    <a href="#" class="nav-btn flex justify-center align-center p-2 text-gray-900 rounded hover:bg-gray-200 lg:hover:bg-transparent lg:border-0 lg:p-0" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="text-2xl lg:text-sm font-bold lg:font-normal uppercase whitespace-nowrap lg:m-0">Se déconnecter</span>
                    </a>
                </form>
            </li>
            @endauth
            </ul>
        </div>
    </div>
    </div>
</nav>