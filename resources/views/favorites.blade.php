@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="">
@endsection

@section('title', 'Favoris')

@section('links')
@parent
@vite(['resources/css/products_list.css', 'resources/js/products_list.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<div id="headers">
    <h1>Mes favoris</h1>
</div>
@foreach($products as $product)
<x-product link="/{{ $product->catalog->gender == 'Femme'?'woman':'men' }}/catalog/{{ $product->category->name }}/{{ $product->id }}" image="/images/{{ $product->img_thumbnail[0] }}" hover="/images/{{ $product->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
@endforeach
<aside class="w-full">
    {{ $products->links() }}
</aside>
@endsection

@section('scripts')
@parent
@endsection