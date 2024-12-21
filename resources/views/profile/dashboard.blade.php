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
<div class="absolute left-0 w-full mt-8 md:mt-10 mb-20">
    <h1 class="w-fit mx-auto text-[xx-large] md:text-[xxx-large]">Mon profil</h1>
</div>
<div class="h-screen w-full flex flex-col justify-center mt-[-40px]">
    <div class="flex flex-col justify-center items-center">
        <h2 class="w-3/4 lg:w-2/4 max-w-lg mb-4 p-4 uppercase hover:text-white rounded-full bg-gray-200 hover:bg-[rgb(var(--accent-color-4))] transition-all duration-300"><a href="{{ route('orders') }}" class="block w-full">Mes commandes</a></h2>
        <h2 class="w-3/4 lg:w-2/4 max-w-lg mb-4 p-4 uppercase hover:text-white rounded-full bg-gray-200 hover:bg-[rgb(var(--accent-color-4))] transition-all duration-300"><a href="{{ route('favorites') }}" class="block w-full">Mes favoris</a></h2>
        <h2 class="w-3/4 lg:w-2/4 max-w-lg mb-4 p-4 uppercase hover:text-white rounded-full bg-gray-200 hover:bg-[rgb(var(--accent-color-4))] transition-all duration-300"><a href="{{ route('profile.edit') }}" class="block w-full">Modifier mes informations</a></h2>
    </div>
</div>
@endsection

@section('scripts')
@parent
@endsection