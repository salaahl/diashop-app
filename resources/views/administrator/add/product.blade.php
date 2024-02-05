@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter/mettre à jour un article')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<section class="bg-white">
    <div class="py-8 mx-auto lg:py-16">
        <h1 class="text-xl font-bold text-gray-900 uppercase">Ajouter/mettre à jour un article</h1>
        <form @if(isset($product)) action="{{ route('update.product', $product->id) }}" @else action="{{ route('store.product') }}" @endif enctype="multipart/form-data" method="POST">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 items-end">
                <div class="col-span-2 md:col-span-1">
                    <label for="catalog_id" class="sr-only uppercase">Selectionnez un catalogue</label>
                    <select id="catalog_id" name="catalog_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                        @if(isset($product))
                        <option value="{{ $product->catalog->id }}" selected>{{ $product->catalog->gender }}</option>
                        @else
                        <option disabled selected>Selectionnez un catalogue</option>
                        @endif
                        @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="category_id" class="sr-only uppercase">Selectionnez une catégorie</label>
                    <select id="category_id" name="category_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none  focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                        @if(isset($product))
                        <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}</option>
                        @else
                        <option disabled selected>Selectionnez une catégorie</option>
                        @endif
                    </select>
                </div>

                <div class="col-span-2 md:col-span-1 h-full flex flex-col justify-between">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Nom</label>
                        <input type="text" name="name" id="name" minlength="2" maxlength="60" @if(isset($product)) value="{{ $product->name }}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom de l'article" required>
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Prix</label>
                        <input type="float" name="price" id="price" @if(isset($product)) value="{{ $product->price }}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Renseigner le prix sans mettre le signe € (ex : 9.99)" required>
                    </div>
                    <div>
                        <label for="color" class="sr-only uppercase">Couleur</label>
                        <select id="color" name="color" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                            @if(isset($product))
                            <option value="{{ $product->color }}">{{ $product->color }}</option>
                            @else
                            <option disabled selected>Selectionner une couleur</option>
                            @endif
                            <option value="blanc">blanc</option>
                            <option value="noir">noir</option>
                            <option value="bleu">bleu</option>
                            <option value="rouge">rouge</option>
                            <option value="jaune">jaune</option>
                            <option value="vert">vert</option>
                            <option value="orange">orange</option>
                            <option value="beige">beige</option>
                            <option value="marron">marron</option>
                            <option value="rose">rose</option>
                            <option value="gris">gris</option>
                            <option value="violet">violet</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Description</label>
                    @if(isset($product))
                    <textarea id="description" name="description" rows="8" minlength="2" maxlength="400" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Entrez la description du produit ici :" required>{{ $product->description }}</textarea>
                    @else
                    <textarea id="description" name="description" rows="8" minlength="2" maxlength="400" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Entrez la description du produit ici :" required></textarea>
                    @endif
                </div>
                <div class="col-span-2 md:col-span-1">
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm">IMAGES <span class="text-sm text-gray-500">(ajouter au moins les deux miniatures et les images 1 et 2. Formats acceptés : SVG, PNG ou JPG).</span></h3>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail_one">Miniature 1</label>
                    <input aria-describedby="thumbnail_one_input_help" id="thumbnail_one" type="file" name="thumbnail_one" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail_two">Miniature 2</label>
                    <input aria-describedby="thumbnail_two_input_help" id="thumbnail_two" type="file" name="thumbnail_two" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_one">Image 1</label>
                    <input aria-describedby="picture_one_input_help" id="picture_one" type="file" name="picture_one" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_two">Image 2</label>
                    <input aria-describedby="picture_two_input_help" id="picture_two" type="file" name="picture_two" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_three">Image 3</label>
                    <input aria-describedby="picture_three_input_help" id="picture_three" type="file" name="picture_three" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="picture_four">Image 4</label>
                    <input aria-describedby="picture_four_input_help" id="picture_four" type="file" name="picture_four" accept="image/png, image/jpg, image/jpeg, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <h3 class="font-semibold text-gray-900 text-sm uppercase">Tailles</h3>
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
                                <input type="number" name="quantity_s" @if(isset($product->quantity_per_size['s'])) value="{{ $product->quantity_per_size['s'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
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
                                <input type="number" name="quantity_m" @if(isset($product->quantity_per_size['m'])) value="{{ $product->quantity_per_size['m'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
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
                                <input type="number" name="quantity_l" @if(isset($product->quantity_per_size['l'])) value="{{ $product->quantity_per_size['l'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
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
                                <input type="number" name="quantity_xl" @if(isset($product->quantity_per_size['xl'])) value="{{ $product->quantity_per_size['xl'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
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
                                <input type="number" name="quantity_xxl" @if(isset($product->quantity_per_size['xxl'])) value="{{ $product->quantity_per_size['xxl'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                        <h4 id="accordion-flush-heading-6">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200 gap-3" data-accordion-target="#accordion-flush-body-6" aria-expanded="false" aria-controls="accordion-flush-body-6">
                                <span>Taille unique</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h4>
                        <div id="accordion-flush-body-6" class="hidden" aria-labelledby="accordion-flush-heading-6">
                            <div class="py-5 border-b border-gray-200 ">
                                <input type="number" name="quantity_os" @if(isset($product->quantity_per_size['os'])) value="{{ $product->quantity_per_size['os'] }}" @endif class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                        Add product
                    </button>
                </div>
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

        const request = new Request('/administrator/get-categories', {
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
