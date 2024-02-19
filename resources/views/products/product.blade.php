@extends('layouts.app')

@section('meta')
@parent
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
    <section id="product-images-container" class="w-full md:w-2/4">
        <ul class="flex flex-nowrap md:block snap-x snap-mandatory overflow-auto">
            @foreach($product->img as $image)
            <li class="md:w-full min-w-[100vw] md:min-w-[auto] aspect-[3/4] snap-start">
                <img 
                    src="/images/{{ $image }}"
                    data-modal-target="default-modal" 
                    data-modal-toggle="default-modal" 
                    class="h-full w-full object-cover object-center cursor-zoom-in"
                    onclick="document.querySelector('#modal-image').src = this.src;" 
                />
            </li>
            @endforeach
        </ul>
    </section>
    <section id="product-details-container" class="w-full md:w-2/4 md:pl-6">
        <div id="product-detail" class="md:h-screen md:mt-[-10vh] max-md:pt-4 md:py-[10vh] sticky top-0">
            <div>
                <h2 id="title">{{ ucfirst($product->name) }}</h2>
                <h2 id="price">{{ $product->price }}€</h2>
                <div id="description">{{ ucfirst($product->description) }}</div>
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
                    @if(isset($product->quantity_per_size["os"]) && $product->quantity_per_size["os"] > 0)
                    <input type="radio" name="size" id="os" value="os">
                    <label class="radio_label" for="os">Taille unique</label>
                    @endif
                    @if(isset($product->quantity_per_size["s"]) && $product->quantity_per_size["s"] > 0)
                    <input type="radio" name="size" id="s" value="s">
                    <label class="radio_label" for="s">S</label>
                    @endif
                    @if(isset($product->quantity_per_size["m"]) && $product->quantity_per_size["m"] > 0)
                    <input type="radio" name="size" id="m" value="m">
                    <label class="radio_label" for="m">M</label>
                    @endif
                    @if(isset($product->quantity_per_size["l"]) && $product->quantity_per_size["l"] > 0)
                    <input type="radio" name="size" id="l" value="l">
                    <label class="radio_label" for="l">L</label>
                    @endif
                    @if(isset($product->quantity_per_size["xl"]) && $product->quantity_per_size["xl"] > 0)
                    <input type="radio" name="size" id="xl" value="xl">
                    <label class="radio_label" for="xl">XL</label>
                    @endif
                    @if(isset($product->quantity_per_size["xxl"]) && $product->quantity_per_size["xxl"] > 0)
                    <input type="radio" name="size" id="xxl" value="xxl">
                    <label class="radio_label" for="xxl">XXL</label>
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
                <div id="delivery-and-return-details">
                    <h4 class="text-sm text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                    <h4 class="text-sm text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                </div>
            </div>
            @else
            <div class="md:h-2/4 max-md:mt-12 max-md:mb-16 flex justify-center items-center">
                <h2>Ce produit est en rupture de stock.</h2>
            </div>
            @endif
        </div>
    </section>
</div>
@if($product->category->products->where("name", "like", "%" . $product->name . "%")->take(2))
<section id="other-products-container" class="flex flex-wrap xl:mt-20 xl:mb-10 px-6 pb-6 bg-stone-200">
    <h3 class="w-full font-normal my-8 uppercase">Plus d'articles</h3>
    @foreach($product->category->products->take(3) as $product)
    @if($product->id != basename(url()->current()))
    <x-product-card link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" image1="/images/{{ $product->img[0] }}" image2="/images/{{ $product->img[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
    @endif
    @endforeach
</section>
<!-- Modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-hidden fixed top-0 right-0 left-0 z-[999] justify-center items-center h-[100dvh] w-full md:inset-0 max-h-full bg-black/50 backdrop-blur-[2px]">
    <div class="relative max-h-full">
        <div class="relative shadow-2xl overflow-hidden">
            <div>
                <img src="/" id="modal-image" class="h-auto w-screen md:h-screen md:w-auto" alt="...">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/product.js')
@endsection