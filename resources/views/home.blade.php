@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Accueil')

@section('links')
@parent
@vite('resources/css/home.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="carousel-container">
    <x-carousel>
        <x-slot name="items">
            <x-carousel-item image="/images/carousel-placeholder.jpg" title="Titre 1" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 2" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 3" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
            <x-carousel-item image="/images/placeholder.png" title="Titre 4" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." />
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
    <div id="headers">
        <h1>Accueil</h1>
        <h2>Découvrez nos collections : élégance, style et confiance !</h2>
    </div>
    @if($woman_products)
    <div id="woman">
        <h3>Femme</h3>
        @foreach($woman_products as $product)
        @if(count($product->options) > 1)
        @for($i = 0; $i < count($product->options); $i++)
            <x-product link="./woman/{{ $product->name }}/{{ $i }}" image="/images/{{ $product->options[$i]->img_thumbnail[0] }}" hover="/images/{{ $product->options[$i]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
            @endfor
            @else
            <x-product link="./woman/{{ $product->name }}" image="/images/{{ $product->options[0]->img_thumbnail[0] }}" hover="/images/{{ $product->options[0]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
            @endif
            @endforeach
            <article class="product" style="min-width: unset; aspect-ratio: unset; text-align: center;">
                <a href="{{ route('woman.catalog') }}">
                    <div class="product-thumbnail flex justify-center items-center" style="height: 100%; width: 100%;">
                        <button class="catalog-button">
                            Accéder au catalogue
                        </button>
                    </div>
                    <div class="product-details">
                        <h4 class="title uppercase"></h4>
                        <div class="short-description text-sm"></div>
                        <div class="price"></div>
                    </div>
                </a>
            </article>
    </div>
    @endif

    @if($men_products)
    <div id="men">
        <h3>Homme</h3>
        @foreach($woman_products as $product)
        @if(count($product->options) > 1)
        @for($i = 0; $i < count($product->options); $i++)
            <x-product link="./men/{{ $product->name }}/{{ $i }}" image="/images/{{ $product->options[$i]->img_thumbnail[0] }}" hover="/images/{{ $product->options[$i]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
            @endfor
            @else
            <x-product link="./men/{{ $product->name }}" image="/images/{{ $product->options[0]->img_thumbnail[0] }}" hover="/images/{{ $product->options[0]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
            @endif
            @endforeach
            <article class="product" style="min-width: unset; aspect-ratio: unset; text-align: center;">
                <a href="{{ route('men.catalog') }}">
                    <div class="product-thumbnail flex justify-center items-center" style="height: 100%; width: 100%;">
                        <button class="catalog-button">
                            Accéder au catalogue
                        </button>
                    </div>
                    <div class="product-details">
                        <h4 class="title uppercase"></h4>
                        <div class="short-description text-sm"></div>
                        <div class="price"></div>
                    </div>
                </a>
            </article>
    </div>
    @endif
</section>
@endsection

@section('scripts')
@parent
@endsection