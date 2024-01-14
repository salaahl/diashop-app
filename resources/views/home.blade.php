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
<section id="products-container" class="min-h-screen">
    <div id="headers">
        <h1>Nouveautés</h1>
        <h2>Découvrez nos collections : élégance, style et confiance !</h2>
    </div>
    @if($woman_options)
    <div id="woman">
        <h3 class="uppercase">Femme</h3>
        @foreach($woman_options as $option)
        <x-product link="/woman/catalog/{{ $option->product->name }}/{{ $option->id }}" image="/images/{{ $option->img_thumbnail[0] }}" hover="/images/{{ $option->img_thumbnail[1] }}" title="{{ $option->product->name }}" description="{{ $option->product->description }}" price="{{ $option->product->price }}" />
        @endforeach
    </div>
    @endif

    @if($men_options)
    <div id="men">
        <h3 class="uppercase">Homme</h3>
        @foreach($men_options as $option)
        <x-product link="/men/catalog/{{ $option->product->name }}/{{ $option->id }}" image="/images/{{ $option->img_thumbnail[0] }}" hover="/images/{{ $option->img_thumbnail[1] }}" title="{{ $option->product->name }}" description="{{ $option->product->description }}" price="{{ $option->product->price }}" />
        @endforeach
    </div>
    @endif
</section>
<section id="catalogs-container" class="md:min-h-screen">
    <article class="catalog">
        <a href="#">
            <div class="img-placeholder">
                <h3 class="uppercase">Femme</h3>
            </div>
        </a>
    </article>
    <article class="catalog">
        <a href="#">
            <div class="img-placeholder">
                <h3 class="uppercase">Homme</h3>
            </div>
        </a>
    </article>

</section>
<section id="aboutme-container" class="min-h-screen">
    <div class="img-container bg-slate-100">
        <img src="{{ asset('/images/aboutme-placeholder.jpg') }}" class="" alt="...">
    </div>
    <div class="text-container text-justify">
        <h2 class="text-justify text-5xl md:w-min mb-4 p-4 bg-gray-800 text-white uppercase">A propos de nous</h2>
        <p class="bg-gray-800 text-white p-1">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
            est
            laborum.
        </p>
        <a href="#" class="bg-gray-800 text-white p-1">En savoir plus</a>
    </div>
</section>
<section id="instagram-container" class="min-h-screen">
    <h2 class="uppercase">Suivez-nous sur instagram</h2>
    <figure data-behold-id="DDUh05OrJTd5Mpp6EAYg"></figure>
    <script src="https://w.behold.so/widget.js" type="module"></script>
</section>
@endsection

@section('scripts')
@parent
@endsection