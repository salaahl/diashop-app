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
<section id="catalogs-container" class="relative md:aspect-[2/1] md:mb-4">
    <div class="title-container hidden md:block absolute bottom-8 left-8">
        <h1 class="mx-0 mb-2 font-['Truculenta'] text-5xl lg:text-6xl text-white bg-cover"><span class="block">{{ env("APP_NAME") }}</span></h1>
        <p class="text-white font-normal">Les dernières tendances de la mode pour hommes et femmes</p>
    </div>
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
<section id="new-products-container" class="flex flex-nowrap md:mt-16 mx-auto py-4 px-[10px] bg-gray-100 md:rounded-lg overflow-auto xl:overflow-hidden">
    <div class="title-container">
        <h2><span>Nouveautés</span></h2>
    </div>
    @foreach($new_products as $product)
    @php
    $product_stock = 0;
    foreach($product->quantity_per_size as $size => $quantity) {
    $product_stock += $quantity;
    }
    @endphp
    <x-product-card
        :created="$product->created_at->timestamp"
        :link="route('product', [$product->getCatalog()->name, $product->category->name, $product->id])"
        :image1="$product->img[0]"
        :image2="$product->img[1]"
        :title="$product->name"
        :initialPrice="round($product->price, 2)"
        :finalPrice="round($product->final_price, 2)"
        :message="!$product_stock ? 'Cet article est en rupture de stock' : ''" />
    @endforeach
    <article class="more-products product flex flex-col items-center justify-center">
        <a href="{{ route('catalog', 'femme') }}" class="button-stylised-1 w-[85%] xl:w-3/4 mx-auto mb-4">Nouveautés pour elle</a>
        <a href="{{ route('catalog', 'homme') }}" class="button-stylised-1 w-[85%] xl:w-3/4 mx-auto">Nouveautés pour lui</a>
    </article>
</section>
<section id="about-us-container" class="w-full max-w-[1440px] flex flex-wrap md:mt-16 mx-auto p-12 bg-[#eeaeca] md:rounded-xl overflow-auto">
    <div class="flex flex-col md:flex-row-reverse items-center justify-center">
        <div class="w-[90%] md:w-2/4 md:ml-24">
            <img src="{{ asset('images/woman-catalog.jpg')}}" alt="Image d'une mannequin du site" class="h-auto w-auto max-md:my-10 mx-auto md:rounded-[50px] border-[35px] border-white object-cover">
        </div>
        <div class="w-full md:w-2/4">
            <div class="title-container w-full mb-8">
                <h2 class="mx-auto"><span>À propos de nous</span></h2>
            </div>
            <p class="mb-8 md:mb-16 text-justify">À travers mes voyages, je selectionne en personne des pièces uniques et de qualité qui apportent une touche d'authenticité à chaque garde-robe...</p>
            <a href="{{ route('about-us') }}" class="button-stylised-1 w-3/4 mx-auto mb-4">En savoir plus</a>
        </div>
    </div>
</section>
@php
$product = $catalogs->random()->products->random()->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')->first();
@endphp
<section id="product-of-the-week-container" class="lg:w-[90%] max-w-[1280px] mx-auto mt-[10px] md:mt-16 px-[10px]">
    <div class=" title-container w-full mb-8">
        <h2 class="mt-8 mb-8 mx-auto"><span>À la une</span></h2>
    </div>
    <div class="flex flex-wrap justify-between md:flex-nowrap flex-col md:flex-row">
        <div id="product-images-container" class="h-auto w-full md:w-2/4">
            <ul class="h-full flex flex-nowrap md:block snap-x snap-mandatory overflow-auto">
                <li class="h-full md:w-full min-w-[100vw] md:min-w-[auto] aspect-[3/4] snap-start">
                    <x-cld-image public-id="{{ $product->img[0] }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center"></x-cld-image>
                </li>
            </ul>
        </div>
        <div id="product-details-container" class="w-full md:w-2/4 md:max-w-2xl mx-auto md:px-6">
            <div id="product-detail" class="h-full flex flex-col pt-4 md:pt-0">
                <div>
                    <nav class="breadcrumb">
                        <ul class="flex items-center">
                            <li>
                                <a href="{{ route('catalog', $product->getCatalog()->name) }}" class="text-sm text-gray-700 hover:text-gray-900">{{ $product->getCatalog()->name }}</a>
                            </li>
                            <li>
                                <span class="mx-1 text-sm text-gray-700"> / </span>
                            </li>
                            <li>
                                <a href="{{ route('category', [$product->getCatalog()->name, $product->category->name]) }}" class="text-sm text-gray-700 hover:text-gray-900">{{ strtolower($product->category->name) }}</a>
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
                            <h2><span>{{ ucfirst($product->name) }}</span></h2>
                        </div>
                        @if(strtotime('-1 month', time()) > $product->created_at->timestamp)
                        <div class="new-badge">
                            <span>New</span>
                        </div>
                        @endif
                    </div>
                    @if($product->promotion)
                    <div class="flex mb-6 md:mb-12">
                        <h2 id="price" class="w-min font-normal">{{ round($product->final_price, 2) }}€</h2>
                        <h2 class="w-min ml-4 font-normal line-through">{{ round($product->price, 2) }}€</h2>
                    </div>
                    @else
                    <h2 id="price" class="w-min mb-6 md:mb-12 font-normal">{{ round($product->price, 2) }}€</h2>
                    @endif
                    <div id="description" class="mb-8 md:mb-24">{!! ucfirst($product->description) !!}</div>
                </div>
                @php
                $count = 0;
                foreach($product->quantity_per_size as $size => $quantity) {
                $count += $quantity;
                }
                @endphp
                <div class="max-md:my-4">
                    <a href="{{ route('product', [$product->getCatalog()->name, $product->category->name, $product->id]) }}" class="button-stylised-1 w-full mb-4">Voir l'article</a>
                    <div id="delivery-and-return-details" class="mb-10">
                        <h4 class="text-sm text-pretty text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                        <h4 class="text-sm text-pretty text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonials-container" class="w-full lg:flex flex-nowrap items-center md:my-24 mx-auto p-4">
    <div class="title-container w-fit">
        <h2 class="mb-8 lg:mb-0 lg:ml-4 lg:text-nowrap"><span>Ils nous font confiance</span></h2>
    </div>
    <div id="testimonials" class="relative lg:flex flex-nowrap items-stretch lg:ml-12 snap-x snap-mandatory scroll-smooth overflow-auto">
        <div class="scroll-controls hidden absolute h-full w-full lg:flex items-center justify-between px-8">
            <button aria-label="Défilement vers la gauche" class="scroll-button scroll-left hide fixed p-6 bg-white/75 backdrop-blur rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                </svg>
            </button>
            <button aria-label="Défilement vers la droite" class="scroll-button scroll-right fixed right-0 p-6 bg-white/75 backdrop-blur rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                    <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                </svg>
            </button>
        </div>
        <div class="testimonial w-full lg:min-w-[380px] flex flex-col items-start lg:ml-16 lg:mr-8 mb-8 lg:mb-0 px-6 lg:px-8 py-4 lg:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Super expérience !</h4>
            <p class="mb-4 text-gray-800">
                Parfait ! Produits de qualité, livraison rapide, et service client top. Je recommande !
            </p>
            <span class="author">Clara</span>
        </div>
        <div class="testimonial w-full lg:min-w-[380px] flex flex-col items-start lg:mx-8 mb-8 lg:mb-0 px-6 lg:px-8 py-4 lg:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Parfait</h4>
            <p class="mb-4 text-gray-800">
                Super site ! Commande facile, bons prix, et tout reçu en parfait état. Rien à redire !
            </p>
            <span class="author">Thomas</span>
        </div>
        <div class="testimonial w-full lg:min-w-[380px] flex flex-col items-start lg:mx-8 mb-8 lg:mb-0 px-6 lg:px-8 py-4 lg:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Ravie de ma commande</h4>
            <p class="mb-4 text-gray-800">
                Excellente expérience ! Navigation fluide, produits conformes, et suivi impeccable. Merci !
            </p>
            <span class="author">Sophie</span>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
@vite('resources/js/home.js')
@endsection