@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Paiement - ')

@section('links')
@parent
<script src="https://js.stripe.com/v3/"></script>
<style>
    main {
        padding: 0;
    }
</style>
@endsection

@section('main')
<div id="checkout" class="min-h-[85vh] pt-[50px]"></div>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/checkout.js')
@endsection
