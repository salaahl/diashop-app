<nav class="max-md:bg-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap">Diashop</span>
        </a>
        <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg max-md:bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Accueil</a>
                </li>
                <li>
                    <button id="dropdownNavbarLinkWoman" data-dropdown-toggle="dropdownNavbarWoman" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">Femme <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarWoman" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg md:shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            @foreach(\App\Models\Category::where("catalog_id",
                            \App\Models\Catalog::where("gender", "Femme")->first()->id
                            )->get() as $category)
                            <li>
                                <a href="{{ route('woman.category', $category->name) }}" class="block px-4 py-2 hover:bg-gray-100">{{ $category->name }}</a>
                            </li>
                            @endforeach
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLinkMen" data-dropdown-toggle="dropdownNavbarMen" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">Homme <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarMen" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg md:shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            @foreach(\App\Models\Category::where("catalog_id",
                            \App\Models\Catalog::where("gender", "Homme")->first()->id
                            )->get() as $category)
                            <li>
                                <a href="{{ route('men.category', $category->name) }}" class="block px-4 py-2 hover:bg-gray-100">{{ $category->name }}</a>
                            </li>
                            @endforeach
                    </div>
                </li>
                <li>
                    <a href="{{ route('basket.show') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Panier</a>
                </li>
                @guest
                <li>
                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Connexion</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Inscription</a>
                </li>
                @endguest
                @auth
                <li>
                    <form method="POST" action="/logout">
                        @csrf
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0" onclick="event.preventDefault(); this.closest('form').submit();">Deconnexion</a>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>