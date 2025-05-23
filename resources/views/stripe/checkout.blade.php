@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Paiement - ')

@section('links')
@parent
<script src="https://js.stripe.com/v3/"></script>
<style>
    #navbar button, .basket-counter {
        display: none;
    }

    main {
        padding: 0;
    }

    @media (min-width: 768px) {
        #navbar-dropdown {
            display: none;
        }
    }
</style>
@endsection

@section('main')
<div id="checkout" class="min-h-[85vh] pt-[50px]"></div>
<input type="hidden" id="clientSecret" name="clientSecret" value="{{ $clientSecret }}" />
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/checkout.js')
@endsection