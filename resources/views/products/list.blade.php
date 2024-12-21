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
<div id="categories" class="flex w-full p-4 md:p-8 pb-2 md:pb-4 mb-8 rounded-lg bg-gray-50 overflow-x-auto">
    <div class="catalog-name">
        <h1>{{ $products->first()->catalog->name }}</h1>
    </div>
    @foreach($categories as $category)
    <article @if(basename(url()->current()) == $category->name)
        class="category selected"
        @else
        class="category"
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
<nav id="filters" class="w-full flex justify-between items-center p-2 mb-2 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : ascendant</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@else
<div class="w-full mt-8 md:mt-10 mb-20">
    <h1 class="w-fit m-auto">Résultats de votre recherche</h1>
</div>
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
@vite('resources/js/products-list.js')
@endsection