@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes favoris')

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
@foreach($products as $product)
<x-product link="{{ route('product', [$product->catalog->gender, $product->category->name, $product->id]) }}" image="/images/{{ $product->img_thumbnail[0] }}" hover="/images/{{ $product->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
@endforeach
<aside class="w-full">
    {{ $products->links() }}
</aside>
@endsection

@section('scripts')
@parent
@endsection
