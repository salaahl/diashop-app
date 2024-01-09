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
        </x-slot>
    </x-carousel>
</section>
<section id="products-container">
    <div id="headers">
        <h1>Nouveautés</h1>
        <h2>Découvrez nos collections : élégance, style et confiance !</h2>
    </div>
    @if($woman_options)
    <div id="woman">
        @foreach($woman_options as $option)
        <x-product link="./woman/{{ $option->product->name }}/{{ $option->id }}" image="/images/{{ $option->img_thumbnail[0] }}" hover="/images/{{ $option->img_thumbnail[1] }}" title="{{ $option->product->name }}" description="{{ $option->product->description }}" price="{{ $option->product->price }}" />
        @endforeach
    </div>
    @endif

    @if($men_options)
    <div id="men">
        @foreach($men_options as $option)
        <x-product link="./men/{{ $option->product->name }}/{{ $option->id }}" image="/images/{{ $option->img_thumbnail[0] }}" hover="/images/{{ $option->img_thumbnail[1] }}" title="{{ $option->product->name }}" description="{{ $option->product->description }}" price="{{ $option->product->price }}" />
        @endforeach
    </div>
    @endif
</section>
<section id="catalogs" class="min-h-screen">
    <article class="catalog-container">
        <a href="{{ route('woman.catalog') }}">
            <div class="catalog">
                <img src="{{ asset('/images/placeholder.png') }}" class="" alt="...">
            </div>
            <h3 class="uppercase">Catalogue femme</h3>
        </a>
    </article>
    <article class="catalog-container">
        <a href="{{ route('men.catalog') }}">
            <div class="catalog">
                <img src="{{ asset('/images/placeholder.png') }}" class="" alt="...">
            </div>
            <h3 class="uppercase">Catalogue homme</h3>
        </a>
    </article>
</section>
@endsection

@section('scripts')
@parent
@endsection