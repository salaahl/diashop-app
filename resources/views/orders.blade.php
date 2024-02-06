@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes commandes')

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
    <article class="command">
        <h4>Commande numéro : {{ $order->command_number }}</h4>
    </article>
</section>
@endforeach
@endif
@endsection

@section('scripts')
@parent
@endsection