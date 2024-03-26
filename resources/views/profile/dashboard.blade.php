@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mon profil - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Mon profil</h1>
<div class="min-h-[90vh] lg:min-h-[92vh] lg:absolute lg:top-[8vh] w-[100vw] absolute top-[10vh] left-0 right-0 flex flex-col justify-center items-center px-4">
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('orders') }}">Mes commandes</a></h2>
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('favorites') }}">Mes favoris</a></h2>
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('profile.edit') }}">Modifier mes informations</a></h2>
</div>
@endsection

@section('scripts')
@parent
@endsection
