@php
$query = explode("/", url()->current());
$h1 = null;
$h2 = null;
$meta_description = null;

if($query[4] == "femme") {
$h1 = "femme";
$h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour femmes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
} elseif($query[4] == "homme") {
$h1 = "homme";
$h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour hommes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
} elseif($query[3] == "search") {
$h1 = "Résultats";
$h2 = "";
$meta_description = "";
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
<div id="headers">
    <h1>{{ $h1 }}</h1>
    <h2>{{ $h2 }}</h2>
</div>
@if(isset($categories))
<div id="categories" class="flex w-full my-8 overflow-x-auto">
    @foreach($categories as $category)
    <article @if(basename(url()->current()) == $category->name)
        class="category selected"
        @else
        class="category"
        @endif
        >
        <a href="{{ '/catalog/' . $category->catalog->name . '/' . $category->name }}">
            <div class="thumbnail">
                <img src='{{ asset("$category->img") }}' alt="{{ $category->name }}" />
            </div>
            <div class="details">
                <h4 class="title text-center">{{ ucfirst($category->name) }}</h4>
            </div>
        </a>
    </article>
    @endforeach
</div>
<nav id="filters" class="w-full flex justify-between items-center p-2 my-4 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : ascendant</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@endif
@foreach($products as $product)
<x-product-card 
    link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" 
    image1="{{ $product->img[0] }}" 
    image2="{{ $product->img[1] }}" 
    title="{{ $product->name }}" 
    price="{{ $product->price }}" 
    promotion="{{ $product->promotion ? round($product->price - ($product->price / 100 * $product->promotion), 2) : null }}" 
    message="{{ $product->promotion ? null : "Cet article est en rupture de stock" }}"
/>
@endforeach
<aside class="w-full mt-[-1rem] mb-4">
    {{ $products->links() }}
</aside>
@endsection

@section('scripts')
@parent
@vite('resources/js/filter_data.js')
@endsection
