@extends('layouts.app')

@section('meta')
@parent
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
<nav id="filters" class="w-full p-2 xl:rounded-md bg-gray-100">
    <div id="categories">
        @foreach($categories as $category)
        <a href="./{{ $category->name }}" class="p-2 text-nowrap @if(strpos(url()->current(), $category->name)) bg-gray-300 @else bg-gray-200 @endif">{{ $category->name }}</a>
        @endforeach
    </div>
    <select id="filter_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="new" @if(request()->get('filter') == 'new' || !request()->get('filter')) selected @endif>Nouveautés</option>
        <option value="price-highest" @if(request()->get('filter') == 'price-highest') selected @endif>Prix : ascendant</option>
        <option value="price-lowest" @if(request()->get('filter') == 'price-lowest') selected @endif>Prix : descendant</option>
    </select>
</nav>
@foreach($products as $product)
@if(count($product->options) > 1)
@for($i = 0; $i < count($product->options); $i++)
    <x-product link="./{{ $product->name }}/{{ $product->options[$i]->id }}" image="/images/{{ $product->options[$i]->img_thumbnail[0] }}" hover="/images/{{ $product->options[$i]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
    @endfor
    @else
    <x-product link="./{{ $product->name }}" image="/images/{{ $product->options[0]->img_thumbnail[0] }}" hover="/images/{{ $product->options[0]->img_thumbnail[1] }}" title="{{ $product->name }}" description="{{ $product->description }}" price="{{ $product->price }}" />
    @endif
    @endforeach
    <aside>
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