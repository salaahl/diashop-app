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

@section('header')
@endsection

@section('main')
<div id="checkout"></div>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/checkout.js')
@endsection
