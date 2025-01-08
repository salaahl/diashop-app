@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez notre collection de prêt-à-porter. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.">
@endsection

@if(isset($categories))
@section('title', 'Catalogue ' . $products->first()->catalog->name . ' - ')
@else
@section('title', 'Résultats de votre recherche - ')
@endif

@section('links')
@parent
@vite('resources/css/products_list.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
@if(isset($categories))
<div id="categories" class="relative flex w-full p-4 md:p-8 pb-2 md:pb-4 md:mb-8 rounded-lg bg-gray-50 overflow-x-auto">
    <div class="title-container catalog-name">
        <h1>{{ $products->first()->catalog->name }}</h1>
    </div>
    <div class="scroll-controls hidden absolute w-[calc(100%-4rem)] h-[calc(100%-2rem)] md:flex items-center justify-between">
        <button class="scroll-button scroll-left hide p-6 bg-white/50 backdrop-blur rounded-full z-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
            </svg>
        </button>
        <button class="scroll-button scroll-right p-6 bg-white/50 backdrop-blur rounded-full z-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6">
                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
            </svg>
        </button>
    </div>
    <div class="categories-container w-full flex snap-x snap-mandatory scroll-smooth overflow-auto">
        @foreach($categories as $category)
        <article @if(basename(url()->current()) == $category->name)
            class="category snap-start selected"
            @else
            class="category snap-start"
            @endif
            >
            <a href="{{ '/catalog/' . $category->catalog->name . '/' . $category->name }}">
                <div class="thumbnail rounded-full overflow-hidden">
                    @php
                    $imagePath = str_replace('\\', '/', $category->img)
                    @endphp
                    <x-cld-image public-id="{{ $imagePath }}" alt="{{ $category->name }}"></x-cld-image>
                </div>
                <div class="details mt-4">
                    <h4 class="title font-normal text-center">{{ ucfirst($category->name) }}</h4>
                </div>
            </a>
        </article>
        @endforeach
    </div>
</div>
<nav id="filters" class="w-full py-2 md:mt-12 mb-4">
    @php
    $sizes = request()->get('sizes');
    $filter = request()->get('sort_by');

    if(!$sizes) {
    $sizes = ['s', 'm', 'l', 'xl', 'xxl'];
    }
    @endphp
    <form id="filters-form" class="flex flex-wrap justify-between items-center" action="" method="POST">
        @csrf
        <div id="sizes" class="w-full lg:w-auto flex flex-wrap">
            <input type="checkbox" name="sizes[]" id="size-s" value="s" @if(in_array('s', $sizes)) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 px-4 py-2 text-sm font-semibold text-white rounded-full" for="size-s">S</label>
            <input type="checkbox" name="sizes[]" id="size-m" value="m" @if(in_array('m', $sizes)) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 px-4 py-2 text-sm font-semibold text-white rounded-full" for="size-m">M</label>
            <input type="checkbox" name="sizes[]" id="size-l" value="l" @if(in_array('l', $sizes)) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 px-4 py-2 text-sm font-semibold text-white rounded-full" for="size-l">L</label>
            <input type="checkbox" name="sizes[]" id="size-xl" value="xl" @if(in_array('xl', $sizes)) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 px-4 py-2 text-sm font-semibold text-white rounded-full" for="size-xl">XL</label>
            <input type="checkbox" name="sizes[]" id="size-xxl" value="xxl" @if(in_array('xxl', $sizes)) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 px-4 py-2 text-sm font-semibold text-white rounded-full" for="size-xxl">XXL</label>
        </div>
        <div id="sort-by" class="w-full lg:w-auto flex flex-wrap">
            <input type="radio" name="sort_by" id="filter_new" value="new" @if($filter=='new' || $filter=='' ) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 lg:mr-0 lg:ml-4 px-6 py-2 text-sm font-semibold text-white rounded-full" for="filter_new">Nouveautés</label>
            <input type="radio" name="sort_by" id="filter_price_lowest" value="price-lowest" @if($filter=='price-lowest' ) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 lg:mr-0 lg:ml-4 px-6 py-2 text-sm font-semibold text-white rounded-full" for="filter_price_lowest">Prix : ascendant</label>
            <input type="radio" name="sort_by" id="filter_price_highest" value="price-highest" @if($filter=='price-highest' ) checked @endif>
            <label class="mt-4 lg:mt-0 mr-4 lg:mr-0 lg:ml-4 px-6 py-2 text-sm font-semibold text-white rounded-full" for="filter_price_highest">Prix : descendant</label>
        </div>
    </form>
</nav>
@else
<div class="title-container w-full mt-8 md:mt-10 mb-20">
    <h1 class="w-fit m-auto">Résultats de votre recherche</h1>
</div>
@endif
@foreach($products as $product)
@php
$product_images = json_decode($product->img, true);
$product_stock = 0;
foreach($product->quantity_per_size as $size => $quantity) {
$product_stock += $quantity;
}
@endphp
<x-product-card created="{{ $product->created_at->timestamp }}" link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" image1="{{ $product_images[0] }}" image2="{{ $product_images[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" promotion="{{ $product->promotion ? round($product->price - ($product->price / 100 * $product->promotion), 2) : null }}" message="{{ $product_stock ? null : 'Cet article est en rupture de stock' }}" />
@endforeach
<aside class="w-full mt-[-0.5rem] mb-4">
    {{ $products->links() }}
</aside>
@endsection

@section('scripts')
@parent
@vite('resources/js/products-list.js')
@endsection