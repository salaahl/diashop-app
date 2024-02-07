@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes commandes - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Mes commandes</h1>
@if(isset($orders))
<section id="command-container">
    @foreach($orders as $order)
    <article class="command mb-10">
        <h4>Numéro de commande : {{ $order->command_number }}</h4>
        <div class="product">
            <h4>[Nom du produit]</h4>
            <h4>[Quantité]</h4>
            <h4>[Prix]</h4>
        </div>
        <div class="shipping-address">
            <h4>Adresse de livraison : </h4>
            <h4>Numéro de suivi : (mettre une colonne dans la table orders ?)</h4>
        </div>
    </article>
</section>
@endforeach
@else
<div class="min-h-[90vh] w-[100vw] absolute top-[10vh] left-0 right-0 flex flex-col justify-center items-center px-4">
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200">Vous n'avez pas de commandes</h2>
</div>
@endif
@endsection

@section('scripts')
@parent
@endsection