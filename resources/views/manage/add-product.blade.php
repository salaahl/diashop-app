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
    <div class="py-8 px-4 mx-auto lg:py-16">
        <h1 class="mb-4 text-xl font-bold text-gray-900 uppercase">Ajouter un nouvel article</h1>
        <form action="#" method="POST">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 items-end">
                <div class="col-span-2 md:col-span-1">
                    <label for="underline_select" class="sr-only">Choisissez un catalogue</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez un catalogue</option>
                        <option value="woman">Femme</option>
                        <option value="men">Homme</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="underline_select" class="sr-only">Choisissez un sous-catalogue</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option disabled selected>Choisissez un sous-catalogue</option>
                        <option value="t-shirts">T-shirts</option>
                        <option value="sweaters">Pulls</option>
                        <option value="shirts">Chemises</option>
                        <option value="jackets-and-coats">Vestes et manteaux</option>
                        <option value="dresses">Robes</option>
                        <option value="pants">Pantalons</option>
                        <option value="accessories">Accessoires</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900">Marque</label>
                    <input type="text" name="brand" id="brand" minlength="2" maxlength="60" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   " placeholder="Marque de l'article" required="">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Prix</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   " placeholder="9.99€" required="">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Couleur</label>
                    <select id="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5   ">
                        <option disabled selected>Selectionner une couleur</option>
                        <option value="white">Blanc</option>
                        <option value="black">Noir</option>
                        <option value="blue">Bleu</option>
                        <option value="red">Rouge</option>
                        <option value="yellow">Jaune</option>
                        <option value="green">Vert</option>
                        <option value="orange">Orange</option>
                        <option value="brown">Marron</option>
                        <option value="pink">Rose</option>
                        <option value="gray">Gris</option>
                        <option value="purple">Violet</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea id="description" rows="8" minlength="2" maxlength="400" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Entrez la description du produit ici"></textarea>
                </div>
                <div class="col-span-2 md:col-span-1 checkbox-toolbar">
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm">Tailles</h3>
                    <div class="flex items-center ps-4 border border-gray-200 rounded">
                        <input id="checkbox-size-s" type="checkbox" value="s" name="checkbox-size-s" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-size-s" class="w-full ms-2 text-sm font-medium text-gray-900  uppercase">s</label>
                        <input type="number" name="input-quantity-s" class="w-2/4 m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité" required="">
                    </div>
                    <div class="flex items-center mt-2 ps-4 border border-gray-200 rounded">
                        <input id="checkbox-size-m" type="checkbox" value="m" name="checkbox-size-m" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-size-m" class="w-full ms-2 text-sm font-medium text-gray-900  uppercase">m</label>
                        <input type="number" name="input-quantity-m" class="w-2/4 m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité" required="">
                    </div>
                    <div class="flex items-center mt-2 ps-4 border border-gray-200 rounded">
                        <input id="checkbox-size-l" type="checkbox" value="l" name="checkbox-size-l" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-size-l" class="w-full ms-2 text-sm font-medium text-gray-900  uppercase">l</label>
                        <input type="number" name="input-quantity-l" class="w-2/4 m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité" required="">
                    </div>
                    <div class="flex items-center mt-2 ps-4 border border-gray-200 rounded">
                        <input id="checkbox-size-xl" type="checkbox" value="xl" name="checkbox-size-xl" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-size-xl" class="w-full ms-2 text-sm font-medium text-gray-900  uppercase">xl</label>
                        <input type="number" name="input-quantity-xl" class="w-2/4 m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité" required="">
                    </div>
                    <div class="flex items-center mt-2 ps-4 border border-gray-200 rounded">
                        <input id="checkbox-size-xxl" type="checkbox" value="XXL" name="checkbox-size-xxl" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-size-xxl" class="w-full ms-2 text-sm font-medium text-gray-900  uppercase">XXL</label>
                        <input type="number" name="input-quantity-xxl" class="w-2/4 m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité" required="">
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center justify-center">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to
                                        upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="image/png, image/jpg, image/jpeg, image/gif" />
                        </label>
                    </div>
                    <div class="output"></div>
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                Add product
            </button>
        </form>
    </div>
</section>

<script>
    const fileInput = document.querySelector("input[type=file]");
    const output = document.querySelector(".output");
    let files = [];

    fileInput.addEventListener("change", () => {
        const fileList = fileInput.files;

        if (!files.find(ele => ele.name == fileList.item(0).name)) {
            if (fileList.length == 1) {
                files.push(fileList.item(0));
                output.innerHTML += fileList.item(0).name + '<br>';
            }
        } else {
            alert("Erreur. Vous avez déjà ajouté ce fichier.")
        }
    });
</script>
@endsection

@section('scripts')
@parent
@endsection