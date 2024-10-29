@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Paiement - ')

@section('links')
@parent
@vite('resources/css/checkout.css')
@endsection

@section('main')
<h1>Paiement</h1>
<!-- Delivery options -->
<div id="delivery-choice" class="absolute top-0 left-0 h-full w-full flex flex-col justify-center items-center gap-4">
    <button class="carrier button-stylised-1 w-full max-w-lg">Livraison à domicile</button>
    <input type="hidden" name="delivery" value="standard">
    <button class="carrier button-stylised-1 w-full max-w-lg">Livraison en point relai</button>
    <input type="hidden" name="delivery" value="mondial-relay">
    <!-- Mondial relay widget -->
    <div id="mr-widget" class="max-w-lg"></div>
    <div id="mr-response" class="max-w-lg"></div>
</div>
<!-- Stripe checkout -->
<div id="checkout" class="mt-16"></div>
@endsection

@section('scripts')
@parent
<script src="https://js.stripe.com/v3/"></script>
<!-- Mondial relay scripts -->
<script
    type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script
    type="text/javascript"
    src="//unpkg.com/leaflet/dist/leaflet.js"></script>
<link
    rel="stylesheet"
    type="text/css"
    href="//unpkg.com/leaflet/dist/leaflet.css" />
<script
    type="text/javascript"
    src="https://widget.mondialrelay.com/parcelshop-picker/jquery.plugin.mondialrelay.parcelshoppicker.min.js"></script>
@vite('resources/js/stripe/checkout.js')
@endsection