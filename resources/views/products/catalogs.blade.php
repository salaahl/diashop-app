@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', 'Titre')

@section('links')
@vite('resources/css/catalogs.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Catalogs</h1>
@endsection

@section('footer')
@endsection

@section('scripts')
@parent
@endsection