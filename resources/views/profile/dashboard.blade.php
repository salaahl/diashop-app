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
<div class="min-h-screen w-full flex flex-col justify-center mt-[-80px]">
    <h1>Mon profil</h1>
    <div class="flex flex-col justify-center items-center mb-[50px] px-4">
        <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('orders') }}">Mes commandes</a></h2>
        <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('favorites') }}">Mes favoris</a></h2>
        <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200"><a href="{{ route('profile.edit') }}">Modifier mes informations</a></h2>
    </div>
</div>
@endsection

@section('scripts')
@parent
@endsection