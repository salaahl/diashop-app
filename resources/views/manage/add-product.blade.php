@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter un nouveau produit')

@section('links')
@parent
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
                    <label for="catalog_id" class="sr-only uppercase">Selectionnez un catalogue</label>
                    <select id="catalog_id" name="catalog_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Selectionnez un catalogue</option>
                        @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="category_id" class="sr-only uppercase">Selectionnez une catégorie</label>
                    <select id="category_id" name="category_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Selectionnez une catégorie</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="brand_id" class="sr-only uppercase">Selectionnez une marque</label>
                    <select id="brand_id" name="brand_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Selectionnez une marque</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Nom</label>
                    <input type="text" name="name" id="name" minlength="2" maxlength="60" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom de l'article">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Description</label>
                    <textarea id="description" name="description" rows="8" minlength="2" maxlength="400" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Entrez la description du produit ici :"></textarea>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Prix</label>
                    <input type="float" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Renseigner le prix sans mettre le signe € (ex : 9.99)">
                    <button type="submit" class="w-full px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Add product
                    </button>
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
<script>
        document.querySelector('#catalog_id').addEventListener('change', function() {
            let data = {
                catalog_id: this.value,
            };

            const request = new Request('/manage/get-categories', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('[name="csrf-token"]')
                        .getAttribute("content"),
                    'Content-Type': 'application/json',
                },
            });

            fetch(request)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data.categories)
                    const select = document.querySelector('#category_id');
                    let options;

                    for (let i = 0; i < data.categories.length; i++) {
                        options += '<option value="' + data.categories[i].id + '">' + data.categories[i].name + '</option>';
                    }

                    select.innerHTML = '<option selected>Selectionnez une catégorie</option>' + options;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        });
</script>
@endsection