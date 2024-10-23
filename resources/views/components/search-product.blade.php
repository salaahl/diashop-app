<section id="search-container" class="h-0 w-full flex flex-col justify-between absolute left-0 z-10 overflow-hidden">
    <div class="w-full">
        <div class="w-full flex justify-between mt-2">
            <div class="w-[48%] flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input checked id="bordered-radio-1" type="radio" value="femme" name="catalog" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Catalogue Femme</label>
            </div>
            <div class="w-[48%] flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input id="bordered-radio-2" type="radio" value="homme" name="catalog" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Catalogue Homme</label>
            </div>
        </div>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Rechercher</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full mt-5 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un article" required>
            <button type="submit" id="default-search-btn" class="text-white absolute end-2.5 bottom-2.5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Voir plus</button>
        </div>
    </div>
    <div id="search-results" class="h-full w-full flex flex-wrap lg:mt-12 max-lg:mt-10 overflow-auto"></div>
    <div id="search-loader" class="hidden h-full w-full absolute left-0 right-0 justify-center items-center">
        <x-clothes-animation />
    </div>
    <div id="search-footer" class="h-[10%] w-full flex justify-center items-center">
        <button id="close-search-btn" class="button-stylised-1 w-full mb-2">
            <span>Fermer</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="hidden h-[15px] ml-2">
                <path fill="#000000" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
            </svg>
        </button>
    </div>
</section>
