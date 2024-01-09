@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Payement')

@section('links')
@parent
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('header')
@parent
@endsection

@section('main')
<div id="checkout"></div>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/checkout.js')
@endsection