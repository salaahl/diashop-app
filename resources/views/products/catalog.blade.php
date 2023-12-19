@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', 'Titre')

@section('links')
@parent
@vite(['resources/css/catalog.css', 'resources/js/catalog.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="carousel-container">
    <x-carousel>
        <x-slot name="items">
            <x-carousel-item image="/images/placeholder.png" title="Titre 1" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 2" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 3" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 4" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 5" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
        </x-slot>

        <x-slot name="buttons">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </x-slot>
    </x-carousel>
</section>
<section id="products-container">
    <!-- Penser à placer une variable dans le h1 -->
    <div id="headers">
        <h1>Femme</h1>
        <!-- Version hommes : Découvrez notre collection masculine : élégance, sophistication et confiance ! -->
        <h2>Découvrez notre collection féminine : élégance, style et confiance !</h2>
    </div>
    <nav id="filters" class="w-full p-2 xl:rounded-md bg-gray-100">
        <h3>Filtres</h3>
        <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option selected disabled>Trier par</option>
            <option value="price-highest">Prix : ascendant</option>
            <option value="price-lowest">Prix : descendant</option>
            <option value="new">Nouveautés</option>
            <option value="bestsellers">Meilleures ventes</option>
        </select>
    </nav>
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 1" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 2" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 3" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 4" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 5" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 6" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 7" description="Lorem ipsum dolor sit amet" price=9 />
    <x-product link="./article" image="/images/placeholder.png" hover="/images/placeholder2.png" title="Article 8" description="Lorem ipsum dolor sit amet" price=9 />
</section>
@endsection

@section('scripts')
@parent
@endsection