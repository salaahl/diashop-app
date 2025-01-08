<div
    id="search-modal"
    data-modal-placement="top-left"
    tabindex="-1"
    class="fixed top-0 left-0 right-0 z-[250] hidden h-full w-full overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
    <div class="relative h-full w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative h-full bg-white">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between h-[10%] p-4 md:p-5 rounded-t">
                <h2 id="search-title" class="text-left uppercase font-normal">
                    <span>Recherche</span>
                </h2>
                <button
                    type="button"
                    id="close-search-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="search-modal">
                    <svg
                        class="w-3 h-3"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14">
                        <path
                            stroke="white"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="4"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div
                id="search-body"
                class="h-[80%] p-4 md:p-5 overflow-auto">

                <form id="search-form" action="/search" method="POST" class="w-full">
                    <div class="w-full flex justify-between">
                        <div class="w-[48%] flex items-center ps-4 border border-gray-200 rounded">
                            <input id="bordered-radio-1" type="radio" value="femme" name="catalog" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" checked>
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Catalogue Femme</label>
                        </div>
                        <div class="w-[48%] flex items-center ps-4 border border-gray-200 rounded">
                            <input id="bordered-radio-2" type="radio" value="homme" name="catalog" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Catalogue Homme</label>
                        </div>
                    </div>
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Rechercher</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full mt-6 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Rechercher un article" required>
                    </div>
                    <button type="submit" class="hidden" disabled>Envoyer</button>
                </form>
                <div id="search-results" class="w-full flex flex-wrap mt-12 overflow-auto"></div>
                <div id="search-loader" class="hidden h-full w-full absolute top-0 left-0 right-0 justify-center items-center">
                    <x-clothes-animation />
                </div>

            </div>
            <!-- Modal footer -->
            <div
                id="search-footer"
                class="flex items-center h-[10%] p-4 md:p-5 space-x-3 rtl:space-x-reverse rounded-b">
                <button type="submit" id="more-results" class="button-stylised-1 w-full">Plus de résultats</button>
            </div>
        </div>
    </div>
</div>