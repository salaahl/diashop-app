@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('links')
@parent
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
    <h1 class="text-xl font-bold text-gray-900 uppercase">Ajouter/mettre à jour une catégorie</h1>
    <form @if(isset($category)) action="{{ route('update.category', $category->id) }}" @else action="{{ route('store.category') }}" @endif enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-10">
            <label for="catalog_id" class="sr-only uppercase">Choisissez une catégorie</label>
            <select id="catalog_id" name="catalog_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                @if(isset($category))
                <option value="{{ $category->catalog->id }}" selected>{{ $category->catalog->name }}</option>
                @else
                <option disabled selected>Choisissez un catalogue</option>
                @endif
                @foreach($catalogs as $catalog)
                <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Catégorie</label>
            <input type="text" name="category" id="category" minlength="2" maxlength="60" @if(isset($category)) value="{{ $category->name }}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom de la catégorie (exemple : vestes et manteaux)" required>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900" for="img_thumbnail">MINIATURE (formats acceptés : SVG, PNG ou JPG).</label>
            <input aria-describedby="img_thumbnail_input_help" id="img_thumbnail" type="file" name="img_thumbnail" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
        </div>
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
