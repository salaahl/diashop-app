@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="{{ ucfirst($product->description) }}">
@endsection

@section('title', $product->name . ' - ')

@section('links')
@parent
@vite('resources/css/product.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
<div class="flex flex-wrap justify-between md:flex-nowrap flex-col md:flex-row">
    <section id="product-images-container" class="w-full md:w-2/4 mt-[-80px]">
        <ul class="flex flex-nowrap md:block snap-x snap-mandatory overflow-auto">
            @php
            $product_images = json_decode($product->img, true);
            @endphp
            @foreach($product_images as $image)
            <li class="md:w-full min-w-[100vw] md:min-w-[auto] aspect-[3/4] snap-start" onclick="currentSlide('{{ $loop->iteration }}')" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <x-cld-image public-id="{{ str_replace('\\', '/', $image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center cursor-zoom-in"></x-cld-image>
            </li>
            @endforeach
        </ul>
    </section>
    <section id="product-details-container" class="w-full md:w-2/4 md:pl-6">
        <div id="product-detail" class="md:min-h-screen md:mt-[-80px] max-md:pt-4 md:py-[110px] sticky top-0">
            <div>
                <nav class="breadcrumb">
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
                <div class="title-container flex items-center">
                    <h1 id="title">{{ ucfirst($product->name) }}</h1>
                    @if(strtotime('-1 month', time()) > strtotime($product->created_at->timestamp))
                    <div class="new-badge">
                        <span>New</span>
                    </div>
                    @endif
                </div>
                @if($product->promotion)
                <div class="flex">
                    <h2 id="price" class="w-min font-normal">{{ round($product->price - ($product->price / 100 * $product->promotion), 2) }}€</h2>
                    <h2 class="w-min ml-4 font-normal line-through">{{ $product->price }}€</h2>
                </div>
                @else
                <h2 id="price" class="font-normal">{{ $product->price }}€</h2>
                @endif
                <div id="description">{!! ucfirst($product->description) !!}</div>
            </div>
            @php
            $count = 0;
            foreach($product->quantity_per_size as $quantity) {
            $count += $quantity;
            }
            @endphp
            @if($count > 0)
            <div class="max-md:my-4">
                <div class="radio-toolbar">
                    @if(isset($product->quantity_per_size["s"]) && $product->quantity_per_size["s"] > 0)
                    <input type="radio" name="size" id="s" value="s">
                    <label class="radio_label button-stylised-1 button-stylised-1-custom mr-4" for="s">S</label>
                    @endif
                    @if(isset($product->quantity_per_size["m"]) && $product->quantity_per_size["m"] > 0)
                    <input type="radio" name="size" id="m" value="m">
                    <label class="radio_label button-stylised-1 button-stylised-1-custom mr-4" for="m">M</label>
                    @endif
                    @if(isset($product->quantity_per_size["l"]) && $product->quantity_per_size["l"] > 0)
                    <input type="radio" name="size" id="l" value="l">
                    <label class="radio_label button-stylised-1 button-stylised-1-custom mr-4" for="l">L</label>
                    @endif
                    @if(isset($product->quantity_per_size["xl"]) && $product->quantity_per_size["xl"] > 0)
                    <input type="radio" name="size" id="xl" value="xl">
                    <label class="radio_label button-stylised-1 button-stylised-1-custom mr-4" for="xl">XL</label>
                    @endif
                    @if(isset($product->quantity_per_size["xxl"]) && $product->quantity_per_size["xxl"] > 0)
                    <input type="radio" name="size" id="xxl" value="xxl">
                    <label class="radio_label button-stylised-1 button-stylised-1-custom mr-4" for="xxl">XXL</label>
                    @endif
                </div>
                <div>
                    <label for="quantity" class="sr-only">Underline select</label>
                    <select id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="" selected>Selectionner une quantité</option>
                    </select>
                </div>
                <div id="buttons" class="flex flex-wrap lg:flex-nowrap my-10">
                    <button id="add-basket" class="button-stylised-1 w-full max-lg:mb-4" role="button">
                        <span>Ajouter au panier</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                            <path fill="#000000" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                        </svg>
                    </button>
                    @guest
                    <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom w-full lg:w-fit min-w-[250px] flex justify-center items-center lg:ml-5 opacity-50 pointer-events-none whitespace-nowrap" role="button">
                        <span>Ajouter aux favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    @endguest
                    @auth
                    @if(\App\Models\Favorite::where([["user_id", Auth::user()->id], ["product_id", $product->id]])->first())
                    <button id="remove-favorite" class="button-stylised-1 button-stylised-1-custom w-full lg:w-fit min-w-[250px] flex justify-center items-center lg:ml-5 whitespace-nowrap" role="button">
                        <span>Retirer des favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom hidden w-full lg:w-fit min-w-[250px] flex justify-center items-center lg:ml-5 whitespace-nowrap" role="button">
                        <span>Ajouter aux favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    @else
                    <button id="remove-favorite" class="button-stylised-1 button-stylised-1-custom hidden w-full lg:w-fit min-w-[250px] flex justify-center items-center lg:ml-5 whitespace-nowrap" role="button">
                        <span>Retirer des favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom w-full lg:w-fit min-w-[250px] flex justify-center items-center lg:ml-5 whitespace-nowrap" role="button">
                        <span>Ajouter aux favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    @endif
                    @endauth
                </div>
                <div id="delivery-and-return-details" class="mb-10">
                    <h4 class="text-sm text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                    <h4 class="text-sm text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                </div>
            </div>
            @else
            <div class="md:h-2/4 max-md:mt-12 max-md:mb-16">
                <h2>Ce produit est en rupture de stock.</h2>
                @guest
                <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom w-full min-w-[250px] flex justify-center items-center mt-8 mb-0 mx-0 opacity-50 pointer-events-none whitespace-nowrap" role="button">
                    <span>Ajouter aux favoris</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                        <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
                @endguest
                @auth
                @if(\App\Models\Favorite::where([["user_id", Auth::user()->id], ["product_id", $product->id]])->first())
                <button id="remove-favorite" class="button-stylised-1 button-stylised-1-custom w-full min-w-[250px] flex justify-center items-center mt-8 mb-0 mx-0 whitespace-nowrap" role="button">
                    <span>Retirer des favoris</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                        <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
                <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom hidden w-full min-w-[250px] flex justify-center items-center mt-8 mb-0 mx-0 whitespace-nowrap" role="button">
                    <span>Ajouter aux favoris</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                        <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
                @else
                <button id="remove-favorite" class="button-stylised-1 button-stylised-1-custom hidden w-full min-w-[250px] flex justify-center items-center mt-8 mb-0 mx-0 whitespace-nowrap" role="button">
                    <span>Retirer des favoris</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                        <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
                <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom w-full min-w-[250px] flex justify-center items-center mt-8 mb-0 mx-0 whitespace-nowrap" role="button">
                    <span>Ajouter aux favoris</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                        <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                </button>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </section>
</div>
<!-- Modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-hidden fixed z-[250] justify-center items-center h-full w-full md:inset-0 backdrop-blur-lg">
    <div class="carousel-container">
        <div id="slides-container" class="relative max-h-full">
            <div class="relative shadow-2xl">
                <button type="button" class="absolute top-1 right-1 md:top-2 md:right-2 z-[5] text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                @foreach($product_images as $image)
                <div class="carousel-slide">
                    <x-cld-image public-id="{{ str_replace('\\', '/', $image) }}" class="h-auto w-screen md:h-[100dvh] md:w-auto" alt="{{ $product->name }}"></x-cld-image>
                    <div class="magnifier"></div>
                </div>
                @endforeach

                <button class="prev" onclick="plusSlides(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 md:w-6 md:h-6">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <button class="next" onclick="plusSlides(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 md:w-6 md:h-6">
                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="img-preview">
            @foreach($product_images as $image)
            <div class="preview-column" onclick="currentSlide('{{ $loop->iteration }}')">
                <x-cld-image public-id="{{ str_replace('\\', '/', $image) }}" id="slide-button-{{ $loop->iteration }}" class="slide-cursor" alt="{{ $product->name }}"></x-cld-image>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Autres produits -->
@if(\App\Models\Product::where([
["catalog_id", \App\Models\Catalog::where('name', $product->catalog->name)->first()->id],
["id", "!=", $product->id],
["name", "like", "%" . explode(' ', $product->name)[0] . "%"],
])->count() > 0
)
<section id="other-products-container" class="flex flex-wrap md:my-10 px-6 pb-6 bg-stone-200">
    <div class="title-container w-full my-8">
        <h2 class="w-fit uppercase">Plus d'articles</h2>
    </div>
    @foreach($product->category->products->where('id', '!=', $product->id)->take(3) as $product)
    @php
    $product_images = json_decode($product->img, true);
    $product_stock = 0;
    foreach($product->quantity_per_size as $size => $quantity) {
    $product_stock += $quantity;
    }
    @endphp
    <x-product-card created="{{ $product->created_at->timestamp }}" link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" image1="{{ $product_images[0] }}" image2="{{ $product_images[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" promotion="{{ $product->promotion ? round($product->price - ($product->price / 100 * $product->promotion), 2) : null }}" message="{{ $product_stock ? null : 'Cet article est en rupture de stock' }}" />
    @endforeach
</section>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/product.js')
<script>
    // Carousel
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        n > 0 ? slideIndex++ : slideIndex--;
        showSlides(slideIndex);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("carousel-slide");
        let dots = document.getElementsByClassName("slide-cursor");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" slide-active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " slide-active";
    }
</script>
@endsection