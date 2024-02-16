@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes favoris - ')

@section('links')
@parent
@vite('resources/css/products_list.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
<div id="headers">
    <h1>Mes favoris</h1>
</div>
@if(isset($products))
@foreach($products as $product)
<x-product link="{{ route('product', [$product->catalog->gender, $product->category->name, $product->id]) }}" image="/images/{{ $product->img_fullsize[0] }}" hover="/images/{{ $product->img_fullsize[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
@endforeach
<aside class="w-full">
    {{ $products->links() }}
</aside>
@else
<div class="min-h-[90vh] w-[100vw] absolute top-[10vh] left-0 right-0 flex flex-col justify-center items-center px-4">
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200">Vous n'avez pas de produits dans vos favoris</h2>
</div>
@endif
@endsection

@section('scripts')
@parent
@endsection