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
        <div id="buttons">
            <button class="button-stylised-1" role="button">Ajouter au panier</button>
            <button class="button-stylised-1 button-stylised-1-custom" role="button">Ajouter aux favoris</button>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
@endsection