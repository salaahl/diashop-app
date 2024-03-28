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
    label:not(#search-container label) {
        margin: 30px 0 10px 0;
    }
</style>
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
                        <option value="{{ $product->catalog->id }}" selected>{{ $product->catalog->name }}</option>
                        @else
                        <option disabled selected>Selectionnez un catalogue</option>
                        @endif
                        @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
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
                        <label for="promotion" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Appliquer une promotion à l'article</label>
                        <input type="number" name="promotion" id="promotion" @if(isset($product)) value="{{ $product->promotion }}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Entrer le pourcentage de la promotion sans mettre le signe % (ex : 15)" required>
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
                    <h3 class="mb-4 font-semibold text-gray-900 text-sm">IMAGES <span class="text-sm text-gray-500">(ajouter au moins deux images. Formats acceptés : SVG, PNG ou JPG).</span></h3>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="img_one">Lien de l'image 1</label>
                    <input aria-describedby="img_one_input_help" id="img_one" type="text" name="img_one" @if(isset($product)) value="{{ $product->img[0] }}" @endif class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="img_two">Lien de l'image 2</label>
                    <input aria-describedby="img_two_input_help" id="img_two" type="text" name="img_two" @if(isset($product)) value="{{ $product->img[1] }}" @endif class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="img_three">Lien de l'image 3</label>
                    <input aria-describedby="img_three_input_help" id="img_three" type="text" name="img_three" @if(isset($product)) @if(isset($product->img[2])) value="{{ $product->img[2] }}" @endif @endif class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="img_four">Lien de l'image 4</label>
                    <input aria-describedby="img_four_input_help" id="img_four" type="text" name="img_four" @if(isset($product)) @if(isset($product->img[3])) value="{{ $product->img[3] }}" @endif @endif class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
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

        const request = new Request("{{ route('administrator.show.categories.post') }}", {
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