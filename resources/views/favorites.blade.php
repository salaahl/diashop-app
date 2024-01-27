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
@foreach($options as $option)
<x-product link="/{{ $option->product->catalog->gender == 'Femme'?'woman':'men' }}/catalog/{{ $option->product->category->name }}/{{ $option->product->name }}/{{ $option->id }}" image="/images/{{ $option->img_thumbnail[0] }}" hover="/images/{{ $option->img_thumbnail[1] }}" title="{{ $option->product->name }}" price="{{ $option->product->price }}" />
@endforeach
<aside class="w-full">
    {{ $options->links() }}
</aside>
@endsection

@section('scripts')
@parent
@endsection
