@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', 'Titre')

@section('links')
@vite(['resources/css/home.css', 'resources/js/home.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Home</h1>
@endsection

@section('footer')
@endsection

@section('scripts')
@parent
@endsection