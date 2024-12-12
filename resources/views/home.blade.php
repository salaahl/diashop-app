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
<section id="new-products-container" class="max-w-[1380px] flex flex-nowrap md:mt-32 mx-auto py-4 px-[10px] bg-gray-100 md:rounded-lg overflow-auto">
    <div class="title-container">
        <h2>Nouveautés</h2>
    </div>
    @foreach($new_products as $product)
    @php
    $product_images = json_decode($product->img, true);
    $product_stock = 0;
    foreach(json_decode($product->quantity_per_size, true) as $size => $quantity) {
    $product_stock += $quantity;
    }
    @endphp
    <x-product-card created="{{ $product->created_at->timestamp }}" link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" image1="{{ $product_images[0] }}" image2="{{ $product_images[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" promotion="{{ $product->promotion ? round($product->price - ($product->price / 100 * $product->promotion), 2) : null }}" message="{{ $product_stock ? null : 'Cet article est en rupture de stock' }}" />
    @endforeach
</section>
<section id="about-us-container" class="max-w-[1440px] flex flex-wrap md:mt-32 mx-auto p-8 bg-[#fcdedc] md:rounded-xl overflow-auto">
    <div class="flex flex-col md:flex-row-reverse items-center justify-center">
        <div class="w-[90%] md:w-2/4 md:ml-12">
            <img src="{{ asset('images/woman-catalog.jpg')}}" class="h-auto w-auto max-md:my-10 mx-auto md:rounded-lg border-[25px] border-gray-200 md:border-white object-cover">
        </div>
        <div class="w-full md:w-2/4">
            <div class="title-container w-full mb-8">
                <h2 class="mx-auto">À propos de nous</h2>
            </div>
            <p class="mb-8 md:mb-16 text-justify">À travers mes voyages, je selectionne en personne des pièces uniques et de qualité qui apportent une touche d'authenticité à chaque garde-robe...</p>
            <a class="button-stylised-1 w-full mb-4">
                <span>En savoir plus</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                    <path fill="#000000" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                </svg>
            </a>
        </div>
    </div>
</section>
<section id="product-of-the-week-container" class="max-w-[1280px] mx-auto mt-[10px] md:mt-32 px-[10px]">
    <div class=" title-container w-full mb-8">
        <h2 class="mb-8 mx-auto">À la une</h2>
    </div>
    <div class="flex flex-wrap justify-between md:flex-nowrap flex-col md:flex-row">
        <div id="product-images-container" class="h-auto w-full md:w-2/4">
            <ul class="flex flex-nowrap md:block snap-x snap-mandatory overflow-auto">
                @php
                $product = $catalogs->random(1)->first()->products->random(1)->first();
                $product_image = json_decode($product->img, true);
                @endphp
                <li class="md:w-full min-w-[100vw] md:min-w-[auto] aspect-[3/4] snap-start">
                    <x-cld-image public-id="{{ str_replace('\\', '/', $product_image[0]) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center cursor-zoom-in"></x-cld-image>
                </li>
            </ul>
        </div>
        <div id="product-details-container" class="w-full md:w-2/4 md:pl-6">
            <div id="product-detail" class="h-full flex flex-col">
                <div>
                    <nav class="breadcrumb mt-2 md:mt-0">
                        <ul class="flex items-center">
                            <li>
                                <a href="{{ route('catalog', $product->catalog->name) }}" class="text-sm text-gray-700 hover:text-gray-900">{{ ucfirst($product->catalog->name) }}</a>
                            </li>
                            <li>
                                <span class="mx-1 text-sm text-gray-700"> / </span>
                            </li>
                            <li>
                                <a href="{{ route('category', [$product->catalog->name, $product->category->name]) }}" class="text-sm text-gray-700 hover:text-gray-900">{{ strtolower($product->category->name) }}</a>
                            </li>
                            <li>
                                <span class="mx-1 text-sm text-gray-700"> / </span>
                            </li>
                            <li aria-current="page">
                                <span class="text-sm text-gray-500">{{ strtolower($product->name) }}</span>
                            </li>
                        </ul>
                    </nav>
                    <div class="flex items-center">
                        <div class="title-container">
                            <h2 class="my-2 md:my-4 uppercase">{{ ucfirst($product->name) }}</h2>
                        </div>
                        @if(strtotime('-1 month', time()) > $product->created_at->timestamp)
                        <div class="new-badge">
                            <span>New</span>
                        </div>
                        @endif
                    </div>
                    @if($product->promotion)
                    <div class="flex mb-6 md:mb-12">
                        <h2 id="price" class="w-min font-normal">{{ round($product->price - ($product->price / 100 * $product->promotion), 2) }}€</h2>
                        <h2 class="w-min ml-4 font-normal line-through">{{ $product->price }}€</h2>
                    </div>
                    @else
                    <h2 id="price" class="w-min mb-6 md:mb-12 font-normal">{{ $product->price }}€</h2>
                    @endif
                    <div id="description" class="mb-8 md:mb-24">{!! ucfirst($product->description) !!}</div>
                </div>
                @php
                $count = 0;
                $product_quantity = json_decode($product->quantity_per_size, true);
                foreach($product_quantity as $quantity) {
                $count += $quantity;
                }
                @endphp
                <div class="max-md:my-4">
                    <a href="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" class="button-stylised-1 w-full mb-4">
                        <span>En savoir plus</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                            <path fill="#000000" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                        </svg>
                    </a>
                    <div id="delivery-and-return-details" class="mb-10">
                        <h4 class="text-sm text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                        <h4 class="text-sm text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="garanties-container" class="md:h-[100px] w-full max-w-[1280px] flex flex-col md:flex-row flex-nowrap items-center justify-between md:my-32 mx-auto bg-gray-100 md:rounded-full">
    <div class="w-full md:w-1/4 flex items-center justify-center py-4 text-sm bg-[rgb(var(--accent-color-1))] md:bg-transparent md:border-r-4 md:border-gray-300">Livraison gratuite à partir de {{ env('FREE_SHIPPING') / 100 }}€</div>
    <div class="w-full md:w-1/4 flex items-center justify-center py-4 text-sm bg-[rgb(var(--accent-color-2))] md:bg-transparent md:border-r-4 md:border-gray-300">Satisfait ou remboursé</div>
    <div class="w-full md:w-1/4 flex items-center justify-center py-4 text-sm md:border-r-4 md:border-gray-300">Paiement sécurisé avec Stripe</div>
    <div class="w-full md:w-1/4 flex items-center justify-center py-4 text-sm bg-[rgb(var(--accent-color-3))] md:bg-transparent">3x sans frais</div>
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