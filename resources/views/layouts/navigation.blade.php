<nav id="navbar" class="bg-white">
    <div class="h-full w-full max-w-screen-xl flex flex-wrap items-center justify-end lg:justify-between mx-auto max-[1023px]-px-4 xl:p-0">
        <a href="/" class="h-[10vh] flex flex-col justify-center items-center absolute top-0 left-2/4 right-2/4">
            <span class="self-center text-sm uppercase font-semibold whitespace-nowrap">Diashop-b</span>
            <span class="self-center m-0 text-sm uppercase whitespace-nowrap">Paris</span>
        </a>
        <div class="h-[10vh] flex items-center">
            <button id="navbar-dropdown-btn" data-collapse-toggle="navbar-dropdown" type="button" class="relative inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="h-full w-full lg:flex lg:justify-between" id="navbar-dropdown">
            <ul class="flex flex-col items-center font-medium p-4 lg:p-0 max-lg:rounded-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                <li class="h-full w-full flex items-center">
                    <a href="{{ route('woman.catalog') }}" id="dropdownNavbarLinkWoman" class="hidden lg:flex items-center justify-between w-full py-2 uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">Femme</a>
                    <button id="dropdownNavbarLinkWomanBtn" data-collapse-toggle="dropdownNavbarWoman" type="button" class="lg:hidden flex items-center justify-between w-full py-2 uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">Femme
                    </button>
                    <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarWoman" class="z-10 hidden lg:flex align-center w-full max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                        <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            @if(\App\Models\Catalog::where("gender", "femme")->first())
                            @foreach(\App\Models\Category::where("catalog_id",
                            \App\Models\Catalog::where("gender", "femme")->first()->id
                            )->get() as $category)
                            <li class="self-center">
                                <a href="{{ route('woman.category', $category->name) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">{{
                    $category->name }}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="h-full w-full flex items-center">
                    <a href="{{ route('men.catalog') }}" id="dropdownNavbarLinkMen" class="hidden lg:flex items-center justify-between w-full py-2 uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">Homme</a>
                    <button id="dropdownNavbarLinkMenBtn" data-collapse-toggle="dropdownNavbarMen" type="button" class="lg:hidden flex items-center justify-between w-full py-2 uppercase text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">Homme
                    </button>
                    <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarMen" class="z-10 hidden lg:flex align-center w-full max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                        <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            @if(\App\Models\Catalog::where("gender", "homme")->first())
                            @foreach(\App\Models\Category::where("catalog_id",
                            \App\Models\Catalog::where("gender", "homme")->first()->id
                            )->get() as $category)
                            <li class="self-center">
                                <a href="{{ route('men.category', $category->name) }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">{{
                    $category->name }}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="flex flex-col lg:items-center font-medium p-4 lg:p-0 mt-4 max-lg:rounded-lg border border-gray-100 max-lg:bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0">
                @auth
                <li class="h-full w-full flex items-center">
                    <a href="{{ route('dashboard') }}" id="dashboardLink" class="hidden lg:flex items-center justify-between w-full py-2 whitespace-nowrap text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:p-0 lg:w-auto">Mon profil</a>
                    <button id="dashboardBtn" data-collapse-toggle="dropdownDashboard" type="button" class="lg:hidden flex items-center justify-between w-full py-2 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0  lg:p-0 lg:w-auto">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="18" viewBox="0 0 448 512" class="lg:hidden">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                            <span class="ml-5">Mon profil<span>
                        </div>
                        <svg class="w-2.5 h-2.5 lg:ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownDashboard" class="z-10 hidden lg:flex align-center w-full max-lg:rounded-lg overflow-hidden bg-gray-100 divide-y divide-gray-100 lg:absolute">
                        <ul class="lg:flex max-w-screen-xl lg:p-4 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li class="self-center">
                                <a href="{{ route('favorites.show') }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">
                                    Mes favoris
                                </a>
                            </li>
                            <li class="self-center">
                                <a href="{{ route('profile.edit') }}" class="block my-2 lg:mr-4 px-4 py-2 rounded-[5px] lg:rounded-full hover:bg-gray-200 transition-all">
                                    Modifier mes informations
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endauth
                <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                    <button id="search-btn" class="w-full flex py-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 512 512" class="lg:hidden">

                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg><span class="whitespace-nowrap ml-5 lg:m-0">Rechercher</span></button>
                </li>
                <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                    <a href="{{ route('basket.show') }}" class="flex py-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 576 512" class="lg:hidden">

                            <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                        </svg><span class="whitespace-nowrap ml-5 lg:m-0">Panier</span></a>
                </li>
                @guest
                <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                    <a href="{{ route('login') }}" class="flex align-center py-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="18" viewBox="0 0 448 512" class="lg:hidden">

                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                        </svg><span class="whitespace-nowrap ml-5 lg:m-0">Se connecter</span></a>
                </li>
                @endguest
                @auth
                <li class="h-full w-full lg:flex lg:items-center lg:flex lg:align-center">
                    <form method="POST" action="/logout">
                        @csrf
                        <a href="#" class="flex align-center py-2 text-gray-900 rounded hover:bg-gray-300 lg:hover:bg-transparent lg:border-0  lg:p-0" onclick="event.preventDefault(); this.closest('form').submit();"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512" class="lg:hidden">

                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                            </svg><span class="whitespace-nowrap ml-5 lg:m-0">Se déconnecter</span></a>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
        <div class="hidden w-full lg:block lg:w-auto" id="navbar-dropdown">

        </div>
    </div>
</nav>
