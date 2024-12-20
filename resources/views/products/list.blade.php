@php
$query = explode("/", url()->current());
$h1 = null;
$search_header = null;
$meta_description = null;

if($query[3] == "search") {
$search_header = "Résultats de votre recherche";
@endphp
<style>
    main #headers {
        margin-top: 75px;
        margin-bottom: 75px;
    }
</style>
@php
$meta_description = "";
} elseif($query[4] == "femme") {
$h1 = "femme";
$meta_description = "Découvrez notre collection de prêt-à-porter pour femmes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
} elseif($query[4] == "homme") {
$h1 = "homme";
$meta_description = "Découvrez notre collection de prêt-à-porter pour hommes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
}
@endphp

@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="{{ $meta_description }}">
@endsection

@section('title', 'Catalogue ' . $h1 . ' - ')

@section('links')
@parent
@vite('resources/css/products_list.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
@if(isset($search_header))
<div id="headers">
    <h1>{{ $search_header }}</h1>
</div>
@endif
@if(isset($categories))
<div id="categories" class="flex w-full pt-8 mb-8 overflow-x-auto">
    <div class="catalog-name">
        <h1>{{ $h1 }}</h1>
    </div>
    @foreach($categories as $category)
    <article @if(basename(url()->current()) == $category->name)
        class="category selected"
        @else
        class="category"
        @endif
        >
        <a href="{{ '/catalog/' . $category->catalog->name . '/' . $category->name }}">
            <div class="thumbnail">
                @php
                $imagePath = str_replace('\\', '/', $category->img)
                @endphp
                <x-cld-image public-id="{{ $imagePath }}" alt="{{ $category->name }}"></x-cld-image>
            </div>
            <div class="details">
                <h4 class="title text-center">{{ ucfirst($category->name) }}</h4>
            </div>
        </a>
    </article>
    @endforeach
</div>
<nav id="filters" class="w-full flex justify-between items-center p-2 mb-2 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : ascendant</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@endif
@foreach($products as $product)
@php
$product_images = json_decode($product->img, true);
$product_stock = 0;
foreach(json_decode($product->quantity_per_size, true) as $size => $quantity) {
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
@if(isset($categories))
@vite('resources/js/products-list.js')
@endif
@endsection