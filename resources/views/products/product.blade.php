@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', 'Titre')

@section('links')
@vite(['resources/css/product.css', 'resources/js/product.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Product</h1>
@endsection

@section('footer')
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/product.js') }}"></script>
@endsection