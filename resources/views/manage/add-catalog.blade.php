@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter un nouveau catalogue')

@section('links')
@parent
<!-- @vite('resources/css/manage/create.css') -->
@endsection

@section('header')
@parent
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        max-width: 768px !important;
    }

    footer {
        display: none;
    }

    .alert {
        margin-top: 10%;
        color: red;
        text-align: center;
    }
</style>
@endsection

@section('main')
<div>
    <h1 class="mb-4 text-xl font-bold text-gray-900 uppercase">Ajouter un nouveau catalogue</h1>
    <form action="{{ route('store.catalog') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Catalogue</label>
        <input type="text" name="gender" id="gender" minlength="2" maxlength="60" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom du catalogue (exemple : homme)">
        <button type="submit" class="w-full px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
            Ajouter
        </button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection

@section('scripts')
@parent
@endsection