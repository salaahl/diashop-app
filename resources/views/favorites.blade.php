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
<div class="min-h-screen w-full mt-[-80px] pt-[80px]">
    @if(isset($products))
    <div id="headers">
        <h1>Mes favoris</h1>
    </div>
    @foreach($products as $product)
    <x-product-card link="{{ route('product', [$product->catalog->name, $product->category->name, $product->id]) }}" image1="/images/{{ $product->img[0] }}" image2="/images/{{ $product->img[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
    @endforeach
    <aside class="w-full">
        {{ $products->links() }}
    </aside>
    @else
    <div id="favorites-empty" class="h-[100vh] w-full top-0 left-0 flex flex-col justify-center items-center mt-[-80px] px-4">
        <h1 class="mb-0">Vous n'avez pas de produits dans vos favoris</h1>
        <a href="{{ route('home') }}" class="m-5 py-3 px-6 bg-gray-800 text-center text-white rounded-full">Retourner sur la page d'accueil</a>
    </div>
    @endif
</div>
@endsection

@section('scripts')
@parent
@endsection