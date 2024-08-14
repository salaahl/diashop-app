@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez notre collection de prêt-à-porter tendance et de haute qualité. Trouvez les dernières tendances de la mode pour hommes et femmes.">
@endsection

@section('links')
@parent
<div data-turbo-track="dynamic">
    @vite('resources/css/home.css')
</div>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="catalogs-container" class="md:aspect-[2/1] md:mb-4">
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
<script>
    if (window.innerWidth > 768) {
        document.querySelectorAll('#catalogs-container .catalog .img-placeholder').forEach((ele) => {
            ele.style.backgroundSize = document.querySelector('#catalogs-container .catalog').offsetWidth + (document.querySelector('#catalogs-container .catalog').offsetWidth / 5) + 'px'
        })
    }
</script>
@endsection
