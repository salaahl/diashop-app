@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez notre collection de prêt-à-porter tendance et de haute qualité. Trouvez les dernières tendances de la mode pour hommes et femmes.">
@endsection

@section('links')
@parent
@vite('resources/css/home.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
<x-banner-top />
<section id="catalogs-container" class="md:min-h-[89vh]">
    <article class="catalog">
        <a href="{{ route('catalog', 'femme') }}">
            <div class="img-placeholder">
                <h3 class="uppercase">Femme</h3>
            </div>
        </a>
    </article>
    <article class="catalog">
        <a href="{{ route('catalog', 'homme') }}">
            <div class="img-placeholder">
                <h3 class="uppercase">Homme</h3>
            </div>
        </a>
    </article>
</section>
@endsection

@section('scripts')
@parent
@endsection
