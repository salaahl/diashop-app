<nav id="navbar">
    <div class="h-full w-full flex flex-wrap items-center justify-end lg:justify-between mx-auto xl:p-0">
        <a href="/" class="h-[10vh] flex flex-col justify-center items-center absolute top-0 left-2/4 right-2/4">
            <span class="self-center uppercase font-semibold whitespace-nowrap">Diashop-b</span>
            <span class="self-center m-0 text-sm uppercase whitespace-nowrap">Paris</span>
        </a>
        <div class="h-[10vh] flex items-center">
            <button id="navbar-dropdown-btn" data-collapse-toggle="navbar-dropdown" type="button" class="relative inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="hidden h-[15px]">
                    <path fill="#000000" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                </svg>
            </button>
        </div>
        <div class="h-full w-full" id="navbar-dropdown">
            <div class="h-full flex max-lg:flex-col lg:justify-between items-center">
                <ul class="lg:h-full max-lg:w-full flex flex-col items-center font-medium p-4 lg:p-0 max-lg:rounded-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @foreach(\App\Models\Catalog::all() as $catalog)
                    <li class="h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('catalog', $catalog->gender) }}" class="dropdownNavbarLinkCatalog hidden lg:flex items-center justify-between w-full py-2 text-sm uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">
                            <span>{{ ucfirst($catalog->gender) }}</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button data-collapse-toggle="dropdownNavbar{{ ucfirst($catalog->gender) }}" type="button" class="dropdownNavbarLinkCatalogBtn lg:hidden flex items-center justify-between w-full p-2 text-sm uppercase text-gray-900 rounded-t-lg hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">
                            <span>{{ ucfirst($catalog->gender) }}</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown catalog menu -->
                        <div id="dropdownNavbar{{ ucfirst($catalog->gender) }}" class="dropdownNavbarCatalog hidden z-10 lg:flex align-center w-full max-lg:rounded-b-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="lg:hidden self-center">
                                    <a href="{{ route('catalog', $catalog->gender) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">Tout</a>
                                </li>
                                @if(\App\Models\Category::where("catalog_id", $catalog->id)->first())
                                @foreach(\App\Models\Category::where("catalog_id", $catalog->id)->get() as $category)
                                <li class="self-center">
                                    <a href="{{ route('category', [$category->catalog->gender, $category->name]) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 whitespace-nowrap transition-all">
                                        {{ ucfirst($category->name) }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endforeach
                    <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                        <button id="search-btn" class="w-full flex justify-between items-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0 lg:p-0">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Rechercher</span>
                        </button>
                    </li>
                </ul>
                <ul class="lg:h-full max-lg:w-full flex flex-col lg:items-center font-medium p-4 lg:p-0 mt-4 max-lg:rounded-b-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                    @auth
                    <li class="lg:h-full w-full lg:flex lg:justify-center lg:items-center">
                        <a href="{{ route('dashboard') }}" id="dropdownDashboardLink" class="hidden lg:flex max-lg:justify-between items-center w-full p-2 whitespace-nowrap text-gray-900 text-sm uppercase rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span>Mon profil</span>
                            <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <button id="dropdownDashboardBtn" data-collapse-toggle="dropdownDashboard" type="button" class="lg:hidden flex items-center justify-between w-full p-2 text-gray-900 rounded-t-lg hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">
                            <span class="text-sm uppercase">Mon profil</span>
                            <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDashboard" class="hidden z-10 lg:flex align-center w-full max-lg:rounded-b-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                            <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li class="self-center">
                                    <a href="{{ route('favorites.show') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">
                                        Mes favoris
                                    </a>
                                </li>
                                <li class="self-center">
                                    <a href="{{ route('orders') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">
                                        Mes commandes
                                    </a>
                                </li>
                                <li class="self-center">
                                    <a href="{{ route('profile.edit') }}" class="block my-2 lg:mr-4 px-4 py-2 whitespace-nowrap rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">
                                        Modifier mes informations
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endauth
                    <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                        <a href="{{ route('basket.show') }}" class="flex justify-between items-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Panier</span>
                            @php
                            if(session()->has('basket')) {
                                $count = 0;
                                foreach(session()->get('basket') as $item) {
                                    $count += count($item);
                                }
                            }
                            @endphp
                            <span id="basket-counter">{{ $count }}</span>
                        </a>
                    </li>
                    @guest
                    <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                        <a href="{{ route('login') }}" class="flex justify-between items-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0">
                            <span class="text-sm uppercase whitespace-nowrap lg:m-0">Se connecter</span>
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                        <form method="POST" action="/logout">
                            @csrf
                            <a href="#" class="flex justify-between align-center p-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0" onclick="event.preventDefault(); this.closest('form').submit();">
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
