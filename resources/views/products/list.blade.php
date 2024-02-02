@php
$query = explode("/", url()->current());
$h1 = null;
$h2 = null;
$meta_description = null;

if($query[3] == "woman") {
$h1 = "Femme";
$h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour femmes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
} elseif($query[3] == "men") {
$h1 = "Homme";
$h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour hommes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
}
@endphp

@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="">
@endsection

@section('title', $h1)

@section('links')
@parent
@vite(['resources/css/products_list.css', 'resources/js/products_list.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<div id="headers">
    <h1>{{ $h1 }}</h1>
    <h2>{{ $h2 }}</h2>
</div>
@if($categories)
<div id="categories" class="flex w-full my-8 overflow-x-auto">
    @foreach($categories as $category)
    <article 
        @if(isset($query[5])) 
            @if($query[5] == $category->name)
                class="category selected"
            @else
                class="category"
            @endif 
        @else 
            class="category"
        @endif
        >
        <a href="/{{ $query[3] }}/catalog/{{ $category->name }}">
            <div class="thumbnail">
                <img src='{{ asset("/images/$category->img_thumbnail") }}' />
            </div>
            <div class="details">
                <h4 class="title text-center">{{ ucfirst($category->name) }}</h4>
            </div>
        </a>
    </article>
    @endforeach
</div>
@endif
@if($query[4] == "catalog")
<nav id="filters" class="w-full flex justify-between items-center p-2 my-2 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : ascendant</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@endif
@foreach($products as $product)
    <x-product link="/{{ $query[3] }}/catalog/{{ $product->category->name }}/{{ $product->id }}" image="/images/{{ $product->img_thumbnail[0] }}" hover="/images/{{ $product->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
@endforeach
<aside class="w-full">
    {{ $products->links() }}
</aside>
@endsection

@section('scripts')
@parent
<script>
    document.getElementById("filter_select").addEventListener("change", () => {
        var myform = document.createElement("form");
        myform.action = "";
        myform.method = "post";

        filter = document.createElement("input");
        filter.value = document.getElementById("filter_select").value;
        filter.name = "filter";

        token = document.createElement("input");
        token.value = "{{ csrf_token() }}";
        token.name = "_token";

        myform.appendChild(filter);
        myform.appendChild(token);

        document.body.appendChild(myform);
        myform.submit();
    });
</script>
@endsection
