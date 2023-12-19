@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', 'Titre')

@section('links')
@parent
@vite(['resources/css/product.css', 'resources/js/product.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<section class="carousel-container">
    <x-carousel>
        <x-slot name="items">
            <x-carousel-item image="/images/placeholder.png" />
            <x-carousel-item image="/images/placeholder.png" />
            <x-carousel-item image="/images/placeholder.png" />
            <x-carousel-item image="/images/placeholder.png" />
        </x-slot>

        <x-slot name="buttons">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        </x-slot>
    </x-carousel>
</section>
<section id="product-detail-container">
    <div id="product-detail">
        <div>
            <h2 id="title">Article</h2>
            <div id="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
        </div>
        <div>
            <div class="radio-toolbar">
                <input type="radio" id="radio1" name="radios" value="S" checked>
                <label for="radio1">S</label>

                <input type="radio" id="radio2" name="radios" value="M">
                <label for="radio2">M</label>

                <input type="radio" id="radio3" name="radios" value="L">
                <label for="radio3">L</label>

                <input type="radio" id="radio4" name="radios" value="XL">
                <label for="radio4">XL</label>

                <input type="radio" id="radio5" name="radios" value="XXL">
                <label for="radio5">XXL</label>
            </div>
            <div>
                <label for="underline_select" class="sr-only">Underline select</label>
                <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option selected>Selectionner une quantité</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div id="buttons">
                <button class="button-stylised-1" role="button">Ajouter au panier</button>
                <button class="button-stylised-1 button-stylised-1-custom" role="button">Ajouter aux favoris</button>
            </div>
            <div id="delivery-and-return-details">
                <h4 class="text-sm" >Livraison sous cinq jours ouvrés.</h4>
                <h4 class="text-sm">Retour possible sous 7 jours à compter de la date de livraison.</h4>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
@endsection