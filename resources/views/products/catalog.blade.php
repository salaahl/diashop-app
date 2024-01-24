@php
$query = ("/", url()->current(), 2)
@if($query[1] == "femme")
$h1 = "Femme";
$h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour femmes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
@elseif($query[1] == "homme")
$h1 = "Homme";
$h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
$meta_description = "Découvrez notre collection de prêt-à-porter pour hommes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
@endif
@endphp

@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="">
@endsection

@section('title', $h1)

@section('links')
@parent
@vite(['resources/css/catalog.css', 'resources/js/catalog.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<div id="headers">
    <h1>{{ $h1 }}</h1>
    <h2>{{ $h2 }}</h2>
</div>
<div id="categories" class="flex w-full mb-10 overflow-x-auto">
    @foreach($categories as $category)
    <article class="category">
        <a href="./{{ $category->name }}">
            <div class="thumbnail">
                <img src='{{ asset("/images/$category->img_thumbnail") }}' />
            </div>
            <div class="details">
                <h4 class="title text-center capitalize">{{ $category->name }}</h4>
            </div>
        </a>
    </article>
    @endforeach
</div>
<nav id="filters" class="w-full py-2">
    <select id="filter_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : ascendant</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@foreach($products as $product)
@if(count($product->options) > 1)
@for($i = 0; $i < count($product->options); $i++)
    <x-product link="/{{ $product->catalog->gender == 'Femme'?'woman':'men' }}/catalog/{{ $product->category->name }}/{{ $product->name }}/{{ $product->options[$i]->id }}" image="/images/{{ $product->options[$i]->img_thumbnail[0] }}" hover="/images/{{ $product->options[$i]->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
    @endfor
    @else
    <x-product link="/{{ $product->catalog->gender == 'Femme'?'woman':'men' }}/catalog/{{ $product->category->name }}/{{ $product->name }}/{{ $product->options[0]->id }}" image="/images/{{ $product->options[0]->img_thumbnail[0] }}" hover="/images/{{ $product->options[0]->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
    @endif
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
