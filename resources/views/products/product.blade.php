@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', $product->name)

@section('links')
@parent
@vite(['resources/css/product.css', 'resources/js/product.js'])
@endsection

@section('header')
@parent
@endsection

@section('main')
<div class="flex flex-wrap lg:flex-nowrap flex-col lg:flex-row">
    <section id="product-images-container" class="w-full lg:w-2/4">
        <ul class="flex flex-nowrap lg:block snap-x snap-mandatory overflow-auto">
            @foreach($product->img_fullsize as $image)
            <li class="h-[70vh] min-w-[100vw] lg:min-w-[auto] lg:h-[90vh] snap-start">
                <img src="/images/{{ $image }}" class="h-full w-full object-cover object-center" />
            </li>
            @endforeach
        </ul>
    </section>
    <section id="product-details-container" class="w-full lg:w-2/4">
        <div id="product-detail" class="lg:h-screen lg:mt-[-10vh] max-lg:pt-4 lg:py-[10vh] sticky top-0">
            <div>
                <h2 id="title">{{ ucfirst($product->name) }}</h2>
                <h2 id="price">{{ $product->price }}€</h2>
                <div id="description">{{ ucfirst($product->description) }}</div>
            </div>
            <div>
                <div class="radio-toolbar">
                    @if(isset($product->quantity_per_size["taille_unique"]))
                    <input type="radio" name="size" id="taille_unique" value="taille_unique">
                    <label class="radio_label" for="taille_unique">Taille unique</label>
                    @endif
                    @if(isset($product->quantity_per_size["s"]))
                    <input type="radio" name="size" id="s" value="s">
                    <label class="radio_label" for="s">S</label>
                    @endif
                    @if(isset($product->quantity_per_size["m"]))
                    <input type="radio" name="size" id="m" value="m">
                    <label class="radio_label" for="m">M</label>
                    @endif
                    @if(isset($product->quantity_per_size["l"]))
                    <input type="radio" name="size" id="l" value="l">
                    <label class="radio_label" for="l">L</label>
                    @endif
                    @if(isset($product->quantity_per_size["xl"]))
                    <input type="radio" name="size" id="xl" value="xl">
                    <label class="radio_label" for="xl">XL</label>
                    @endif
                    @if(isset($product->quantity_per_size["xxl"]))
                    <input type="radio" name="size" id="xxl" value="xxl">
                    <label class="radio_label" for="xxl">XXL</label>
                    @endif
                </div>
                <div>
                    <label for="quantity" class="sr-only">Underline select</label>
                    <select id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>Selectionner une quantité</option>
                    </select>
                </div>
                <div id="buttons">
                    <button id="add-basket" class="button-stylised-1" role="button">
                        <span>Ajouter au panier</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                            <path fill="#000000" d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                        </svg>
                    </button>
                    @auth
                    <button id="add-favorite" class="button-stylised-1 button-stylised-1-custom w-fit flex justify-center items-center whitespace-nowrap" role="button">
                        <span>Ajouter aux favoris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden h-[15px] ml-2">
                            <path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg>
                    </button>
                    @endauth
                </div>
                <div id="delivery-and-return-details">
                    <h4 class="text-sm text-gray-500">Livraison express dans les deux jours ouvrés | standard sous cinq jours ouvrés</h4>
                    <h4 class="text-sm text-gray-500">Retour possible sous 14 jours à compter de la date de livraison</h4>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- S'il y en a mininum 2 dans la catégorie :
L'idée serait ensuite de mettre des produits ici avec une recherche 'like' -->
@if($product->category->products->take(2))
<section id="other-products-container" class="mt-10 xl:mt-20 xl:mb-10 px-6 pb-6 bg-stone-200">
    <h3 class="w-full font-normal my-8 uppercase">Plus d'articles</h3>
    @foreach($product->category->products->take(3) as $product)
    @if($product->id != basename(url()->current()))
    <x-product link="./{{ $product->id }}" image="/images/{{ $product->img_thumbnail[0] }}" hover="/images/{{ $product->img_thumbnail[1] }}" title="{{ $product->name }}" price="{{ $product->price }}" />
    @endif
    @endforeach
</section>
@endif
@endsection

@section('scripts')
@parent
<script>
    document.querySelectorAll('.radio_label').forEach((radio) => {
        radio.addEventListener('click', function() {
            let data = {
                size: this.previousElementSibling.value.toLowerCase(),
                product_id: '{{ $product->id }}',
            };

            const request = new Request('{{ route("product.get-quantity")}}', {
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
                    const select = document.querySelector('#quantity');
                    let options;

                    for (let i = 0; i < data.quantity; i++) {
                        options += '<option value="' + (i + 1) + '">' + (i + 1) + '</option>';
                    }

                    select.innerHTML = '<option selected>Selectionner une quantité</option>' + options;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        });
    })

    //
    document.getElementById("add-basket").addEventListener('click', function() {
        if (document.querySelector('#product-details-container input[type="radio"]:checked') && document.querySelector("#quantity").value) {
            let data = {
                size: document.querySelector('#product-details-container input[type="radio"]:checked').value,
                quantity: parseInt(document.querySelector("#quantity").value),
                product_id: parseInt('{{ $product->id }}'),
            };

            const request = new Request("{{ route('basket.store') }}", {
                method: 'PUT',
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
                    alert("Article ajouté au panier !")
                })
                .catch((error) => {
                    console.log(error.message);
                });
        } else {
            alert('Veuillez d\'abord sélectionner une taille et une quantité.');
        }
    });

    //
    if (document.getElementById("add-favorite")) {
        document.getElementById("add-favorite").addEventListener('click', function() {
            let data = {
                product_id: parseInt('{{ $product->id }}'),
            };

            const request = new Request("{{ route('favorites.store') }}", {
                method: 'PUT',
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
                    alert("Article ajouté aux favoris !")
                })
                .catch((error) => {
                    console.log(error.message);
                });
        });
    }
</script>
@endsection
