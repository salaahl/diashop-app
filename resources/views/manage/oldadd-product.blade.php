@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter un nouveau produit')

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
        <h1 class="mb-4 text-xl font-bold text-gray-900 uppercase">Ajouter un nouvel article</h1>
        <form action="{{ route('store.product') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 items-end">
                <div class="col-span-2 md:col-span-1">
                    <label for="catalog" class="sr-only uppercase">Choisissez un catalogue</label>
                    <select id="catalog" name="catalog" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez un catalogue</option>
                        @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->gender }}">{{ $catalog->gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="category" class="sr-only uppercase">Choisissez une catégorie</label>
                    <select id="category" name="category" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez une catégorie</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="brand" class="sr-only uppercase">Choisissez une marque</label>
                    <select id="brand" name="brand" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez une marque</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Nom</label>
                    <input type="text" name="name" id="name" minlength="2" maxlength="60" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   " placeholder="Marque de l'article">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Prix</label>
                    <input type="float" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   " placeholder="9.99€">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Couleur</label>
                    <select id="color" name="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5   ">
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
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Description</label>
                    <textarea id="description" name="description" rows="8" minlength="2" maxlength="400" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Entrez la description du produit ici :"></textarea>
                </div>
                <div class="col-span-2 md:col-span-1 checkbox-toolbar">
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm uppercase">Images <span class="text-sm text-gray-500">(SVG, PNG, JPG or GIF).</span></h3>
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
                <div class="col-span-2 md:col-span-1">
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm uppercase">Tailles</h3>

                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
                        <h4 id="accordion-flush-heading-1">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                                <span>Taille S</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_s" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                        <h4 id="accordion-flush-heading-2">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                                <span>Taille M</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_m" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                        <h4 id="accordion-flush-heading-3">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                                <span>Taille L</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_l" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                        <h4 id="accordion-flush-heading-4">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-4" aria-expanded="false" aria-controls="accordion-flush-body-4">
                                <span>Taille XL</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_xl" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                        <h4 id="accordion-flush-heading-5">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-5" aria-expanded="false" aria-controls="accordion-flush-body-5">
                                <span>Taille XXL</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-5" class="hidden" aria-labelledby="accordion-flush-heading-5">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_xxl" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Add product
                    </button>
                    <div class="output"></div>
                </div>
            </div>
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