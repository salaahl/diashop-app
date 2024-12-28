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
        <h1 class="mx-0 mb-2 font-['Truculenta'] text-5xl lg:text-6xl text-white bg-cover">{{ env("APP_NAME") }}</h1>
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
<section id="new-products-container" class="flex flex-nowrap md:mt-16 mx-auto py-4 px-[10px] bg-gray-100 md:rounded-lg overflow-auto">
    <div class="title-container ml-[-5%] mr-[-5%] xl:ml-[-10px] xl:mr-0">
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
    <article class="more-products product flex flex-col items-center justify-center">
        <a href="{{ route('catalog', 'femme') }}" class="button-stylised-1 w-3/4 mx-auto mb-4">Nouveautés pour elle</a>
        <a href="{{ route('catalog', 'homme') }}" class="button-stylised-1 w-3/4 mx-auto">Nouveautés pour lui</a>
    </article>
</section>
<section id="about-us-container" class="w-full max-w-[1440px] flex flex-wrap md:mt-16 mx-auto p-8 bg-[#fcdedc] md:rounded-xl overflow-auto">
    <div class="flex flex-col md:flex-row-reverse items-center justify-center">
        <div class="w-[90%] md:w-2/4 md:ml-12">
            <img src="{{ asset('images/woman-catalog.jpg')}}" class="h-auto w-auto max-md:my-10 mx-auto md:rounded-lg border-[25px] border-white object-cover">
        </div>
        <div class="w-full md:w-2/4">
            <div class="title-container w-full mb-8">
                <h2 class="mx-auto">À propos de nous</h2>
            </div>
            <p class="mb-8 md:mb-16 text-justify">À travers mes voyages, je selectionne en personne des pièces uniques et de qualité qui apportent une touche d'authenticité à chaque garde-robe...</p>
            <a href="{{ route('about-us') }}" class="button-stylised-1 w-full mb-4">En savoir plus</a>
        </div>
    </div>
</section>
<section id="product-of-the-week-container" class="md:w-[90%] max-w-[1280px] mx-auto mt-[10px] md:mt-16 px-[10px]">
    <div class=" title-container w-full mb-8">
        <h2 class="mt-8 mb-8 mx-auto">À la une</h2>
    </div>
    <div class="flex flex-wrap justify-between md:flex-nowrap flex-col md:flex-row">
        <div id="product-images-container" class="h-auto w-full md:w-2/4">
            <ul class="flex flex-nowrap md:block snap-x snap-mandatory overflow-auto">
                @php
                $product = $catalogs->random(1)->first()->products->random(1)->first();
                $product_image = json_decode($product->img, true);
                @endphp
                <li class="md:w-full min-w-[100vw] md:min-w-[auto] aspect-[3/4] snap-start">
                    <x-cld-image public-id="{{ str_replace('\\', '/', $product_image[0]) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center"></x-cld-image>
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
                    <a href="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" class="button-stylised-1 w-full mb-4">En savoir plus</a>
                    <div id="delivery-and-return-details" class="mb-10">
                        <h4 class="text-sm text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                        <h4 class="text-sm text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonials-container" class="w-full md:flex flex-nowrap items-center md:mb-8 md:mt-24 mx-auto p-4">
    <div class="title-container w-fit">
        <h2 class="mb-8 md:mb-0 md:ml-4 md:text-nowrap">Ils nous font confiance</h2>
    </div>
    <div id="testimonials" class="relative md:flex flex-nowrap items-center md:ml-12 snap-x snap-mandatory scroll-smooth overflow-auto">
        <div class="scroll-controls hidden absolute h-full w-full md:flex items-center justify-between px-8">
            <button class="scroll-button scroll-left hide fixed p-6 bg-white/75 backdrop-blur rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                </svg>
            </button>
            <button class="scroll-button scroll-right fixed right-0 p-6 bg-white/75 backdrop-blur rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                    <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                </svg>
            </button>
        </div>
        <div class="testimonial w-full md:min-w-[380px] flex flex-col items-start md:ml-16 md:mr-8 my-8 md:my-0 px-6 md:px-8 py-4 md:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Super expérience !</h4>
            <p class="mb-4 text-gray-800">
                Parfait ! Produits de qualité, livraison rapide, et service client top. Je recommande !
            </p>
            <span class="author">Clara</span>
        </div>
        <div class="testimonial w-full md:min-w-[380px] flex flex-col items-start md:mx-8 my-8 md:my-0 px-6 md:px-8 py-4 md:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Parfait</h4>
            <p class="mb-4 text-gray-800">
                Super site ! Commande facile, bons prix, et tout reçu en parfait état. Rien à redire !
            </p>
            <span class="author">Thomas</span>
        </div>
        <div class="testimonial w-full md:min-w-[380px] flex flex-col items-start md:mx-8 my-8 md:my-0 px-6 md:px-8 py-4 md:py-6 snap-center rounded-3xl">
            <div class="stars mb-2 text-xl">★★★★★</div>
            <h4 class="title mb-4 font-[500]">Ravie de ma commande</h4>
            <p class="mb-4 text-gray-800">
                Excellente expérience ! Navigation fluide, produits conformes, et suivi impeccable. Merci !
            </p>
            <span class="author">Sophie</span>
        </div>
    </div>
</section>
<section id="garanties-container" class="md:h-[100px] w-full max-w-[1440px] flex flex-col md:flex-row flex-nowrap items-center justify-between md:mb-8 md:mt-24 mx-auto p-4 bg-[rgb(var(--accent-color-1))] md:bg-gray-100 md:rounded-lg">
    <div class="w-full md:w-1/4 flex items-center justify-center my-2 px-2 py-4 text-sm text-gray-600 font-semibold bg-white/50 md:bg-transparent md:border-r-4 md:border-gray-300 rounded-xl md:rounded-none">Livraison gratuite à partir de {{ env('FREE_SHIPPING') / 100 }}€</div>
    <div class="w-full md:w-1/4 flex items-center justify-center my-2 px-2 py-4 text-sm text-gray-600 font-semibold bg-white/50 md:bg-transparent md:border-r-4 md:border-gray-300 rounded-xl md:rounded-none">Satisfait ou remboursé</div>
    <div class="w-full md:w-1/4 flex items-center justify-center my-2 px-2 py-4 text-sm text-gray-600 font-semibold bg-white/50 md:bg-transparent md:border-r-4 md:border-gray-300 rounded-xl md:rounded-none">Paiement sécurisé avec Stripe</div>
    <div class="w-full md:w-1/4 flex items-center justify-center my-2 px-2 py-4 text-sm text-gray-600 font-semibold bg-white/50 md:bg-transparent rounded-xl md:rounded-none">3x sans frais</div>
</section>
@endsection

@section('scripts')
@parent
@vite('resources/js/home.js')
@endsection