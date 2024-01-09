@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Confirmation')

@section('links')
@parent
@vite('resources/css/return.css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="success" class="hidden">
    <p>
        We appreciate your business! A confirmation email will be sent to <span id="customer-email"></span>.

        If you have any questions, please email <a href="mailto:orders@example.com">orders@example.com</a>.
    </p>
</section>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/return.js')
@endsection