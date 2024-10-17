<nav id="navbar">
    <div class="h-full w-full flex flex-wrap items-center justify-between mx-auto xl:p-0">
        <a href="/" id="logo" class="h-full flex flex-col justify-center items-center absolute top-0 left-2/4 right-2/4">
            <span class="self-center uppercase font-semibold whitespace-nowrap">DiaShop-B</span>
            <span class="self-center m-0 text-sm uppercase whitespace-nowrap">Paris</span>
        </a>
        <div class="has-mobile-nav-btn">
            <button
                data-modal-target="basket-modal"
                data-modal-toggle="basket-modal"
                class="basket-btn nav-btn has-basket-counter relative inline-flex items-center p-1 w-8 h-8 justify-center text-sm text-gray-500 lg:hidden"
                type="button">
                <svg class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="none">
                    <path fill="currentColor" d="M236.67-50.67q-43.83 0-74.92-31.08-31.08-31.09-31.08-74.92V-630q0-44.1 31.08-75.38 31.09-31.29 74.92-31.29h70.66v-6.66q2.34-69.67 52.3-118.17Q409.6-910 479.98-910t120.7 48.5Q651-813 653.33-743.33v6.66h70q44.1 0 75.39 31.29Q830-674.1 830-630v473.33q0 43.83-31.28 74.92-31.29 31.08-75.39 31.08H236.67Zm0-106h486.66V-630h-70v66.67q0 22.1-15.83 37.71Q621.67-510 599.88-510q-21.5 0-37.02-15.62-15.53-15.61-15.53-37.71V-630h-134v66.67q0 22.1-15.83 37.71Q381.67-510 359.88-510q-21.5 0-37.02-15.62-15.53-15.61-15.53-37.71V-630h-70.66v473.33Zm177.66-580h132v-6.66Q544-768 525.18-785.67q-18.81-17.66-45.33-17.66T435-785.67q-18.33 17.67-20.67 42.34v6.66Zm-177.66 580V-630v473.33Z"/>
                </svg>
            </button>
            <button
                class="search-btn nav-btn relative inline-flex items-center ml-2 p-1 w-8 h-8 justify-center text-sm text-gray-500 lg:hidden"
                type="button">
                    <svg class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="none">
                        <path fill="currentColor" d="M372.63-306.33q-117.45 0-198.21-80.87-80.75-80.87-80.75-196.67 0-115.8 80.87-196.46Q255.41-861 371.2-861q115.8 0 196.47 80.81 80.66 80.81 80.66 196.62 0 46.24-12.5 83.9-12.5 37.67-35.83 70l229.33 228.34q15 15.7 15 37.99 0 22.3-15.33 38.01Q812.84-110 791.04-110q-21.81 0-37.71-15.67L526.47-353.33q-30.14 21.61-69.11 34.3-38.97 12.7-84.73 12.7Zm-1.47-106q72.85 0 122.01-49.2 49.16-49.19 49.16-121.73 0-72.53-49.2-122.13Q443.93-755 371.22-755q-73.28 0-122.41 49.61-49.14 49.6-49.14 122.13 0 72.54 49.04 121.73 49.04 49.2 122.45 49.2Z"/>
                    </svg>
            </button>
        </div>
        <div class="has-mobile-nav-btn">
            <button id="navbar-dropdown-btn" data-collapse-toggle="navbar-dropdown" type="button" class="relative inline-flex items-center p-1 w-8 h-8 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="hidden h-[15px]">
                    <path fill="currentColor" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                </svg>
            </button>
        </div>
        <div class="h-full w-full" id="navbar-dropdown">
            <div class="h-full flex max-lg:flex-col lg:justify-between items-center overflow-auto">
                <ul class="lg:h-full max-lg:w-full flex flex-col items-center font-medium p-4 lg:p-0 max-lg:rounded-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @foreach(\App\Models\Catalog::all() as $catalog)
                    <li class="has-dropdown h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('catalog', $catalog->name) }}" class="dropdownNavbarLinkCatalog hidden lg:flex items-center justify-between w-full py-2 text-sm uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">
                            <span>{{ ucfirst($catalog->name) }}</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button data-collapse-toggle="dropdownNavbar{{ ucfirst($catalog->name) }}" type="button" class="dropdownNavbarBtn lg:hidden flex items-center justify-between w-full mb-2 p-2 text-sm uppercase text-gray-900 rounded-lg hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span>{{ ucfirst($catalog->name) }}</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown catalog menu -->
                        <div id="dropdownNavbar{{ ucfirst($catalog->name) }}" class="dropdownNavbar hidden z-10 lg:flex align-center w-full max-lg:mb-2 max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="lg:hidden self-center">
                                    <a href="{{ route('catalog', $catalog->name) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">Tout</a>
                                </li>
                                @if(\App\Models\Category::where("catalog_id", $catalog->id)->first())
                                @foreach(\App\Models\Category::where("catalog_id", $catalog->id)->get() as $category)
                                <li class="self-center">
                                    <a href="{{ route('category', [$category->catalog->name, $category->name]) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 whitespace-nowrap transition duration-500">
                                        {{ ucfirst($category->name) }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endforeach
                    <li class="h-full w-full hidden lg:flex lg:items-center lg:align-center">
                        <button class="search-btn nav-btn w-full flex justify-between items-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0 lg:p-0">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Rechercher</span>
                        </button>
                    </li>
                </ul>
                <ul class="lg:h-full max-lg:w-full flex flex-col lg:items-center font-medium p-4 lg:p-0 mt-4 max-lg:rounded-b-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @auth
                    <li class="has-dropdown lg:h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('dashboard') }}" id="dropdownDashboardLink" class="hidden lg:flex max-lg:justify-between items-center w-full p-2 whitespace-nowrap text-gray-900 text-sm uppercase rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span>Mon profil</span>
                            <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button id="dropdownDashboardBtn" data-collapse-toggle="dropdownDashboard" type="button" class="dropdownNavbarBtn lg:hidden flex items-center justify-between w-full mb-2 p-2 text-sm uppercase text-gray-900 rounded-lg hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span class="text-sm uppercase">Mon profil</span>
                            <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDashboard" class="dropdownNavbar hidden z-10 lg:flex align-center w-full max-lg:mb-2 max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex max-w-screen-xl max-lg:mb-2 lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="self-center">
                                    <a href="{{ route('favorites') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                                        Mes favoris
                                    </a>
                                </li>
                                <li class="self-center">
                                    <a href="{{ route('orders') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
                                        Mes commandes
                                    </a>
                                </li>
                                <li class="self-center">
                                    <a href="{{ route('profile.edit') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition duration-500">
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
                            @if(session()->has('basket'))
                            @php
                            $count = 0;
                            foreach(session()->get('basket') as $item) {
                            $count += count($item);
                            }
                            @endphp
                            <span id="basket-counter">{{ $count }}</span>
                            @endif
                        </button>
                    </li>
                    @guest
                    <li class="h-full w-full lg:flex lg:items-center lg:align-center">
                        <a href="{{ route('login') }}" class="nav-btn flex justify-between items-center max-lg:mb-2 p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Se connecter</span>
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="h-full w-full lg:flex lg:items-center lg:align-center">
                        <form method="POST" action="/logout">
                            @csrf
                            <a href="#" class="nav-btn flex justify-between align-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="text-sm uppercase whitespace-nowrap lg:m-0">Se déconnecter</span>
                            </a>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
