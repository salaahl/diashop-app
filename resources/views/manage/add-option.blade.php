@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter une nouvelle option')

@section('links')
@parent
<!-- @vite('resources/css/manage/create.css') -->
@endsection

@section('header')
@parent
@endsection

@section('main')
<section class="bg-white">
    <div class="py-8 mx-auto lg:py-16">
        <h1 class="mb-4 text-xl font-bold text-gray-900 uppercase">Ajouter une une nouvelle option</h1>
        <form action="{{ route('store.option') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 items-end">
                <div class="col-span-2 md:col-span-1">
                    <label for="product_id" class="sr-only uppercase">Choisissez un produit</label>
                    <select id="product_id" name="product_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez un produit</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->category->name }} - {{ $product->catalog->gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="color" class="sr-only uppercase">Couleur</label>
                    <select id="color" name="color" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Selectionner une couleur</option>
                        <option value="blanc">Blanc</option>
                        <option value="noir">Noir</option>
                        <option value="bleu">Bleu</option>
                        <option value="rouge">Rouge</option>
                        <option value="jaune">Jaune</option>
                        <option value="vert">Vert</option>
                        <option value="orange">Orange</option>
                        <option value="marron">Marron</option>
                        <option value="rose">Rose</option>
                        <option value="gris">Gris</option>
                        <option value="violet">Violet</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm">IMAGES <span class="text-sm text-gray-500">(ajouter au moins les deux premières miniatures et une autre image. Formats acceptés : SVG, PNG ou JPG).</span></h3>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail_one">Miniature 1</label>
                    <input aria-describedby="thumbnail_one_input_help" id="thumbnail_one" type="file" name="thumbnail_one" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail_two">Miniature 2</label>
                    <input aria-describedby="thumbnail_two_input_help" id="thumbnail_two" type="file" name="thumbnail_two" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_one">Image 1</label>
                    <input aria-describedby="picture_one_input_help" id="picture_one" type="file" name="picture_one" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_two">Image 2</label>
                    <input aria-describedby="picture_two_input_help" id="picture_two" type="file" name="picture_two" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_three">Image 3</label>
                    <input aria-describedby="picture_three_input_help" id="picture_three" type="file" name="picture_three" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_four">Image 4</label>
                    <input aria-describedby="picture_four_input_help" id="picture_four" type="file" name="picture_four" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
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
</section>
@endsection

@section('scripts')
@parent
@endsection