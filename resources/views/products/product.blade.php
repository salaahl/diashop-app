@extends('layouts.app')

@section('meta')
@parent
@endsection

<!-- Remplacer cette partie par une variable avec le nom de la page -->
@section('title', $product->name)

@section('links')
@parent
@vite(['resources/css/product.css', 'resources/js/product.js'])
@endsection

@section('header')
@parent
<style>
    @media (min-width: 768px) {
        h2 {
            text-align: unset!important;
        }
    }

    #default-carousel>button>span {
        background-color: black;
    }

    #default-carousel>#indicators {
        display: none;
    }
</style>
@endsection

@section('main')
<section class="carousel-container">
    <x-carousel>
        <x-slot name="items">
            @foreach($options->img_fullsize as $image)
            <x-carousel-item image="/images/{{ $image }}" />
            @endforeach
        </x-slot>

        <!-- Trouver le moyen d'aligner cette partir sur le nombre d'images -->
        <x-slot name="buttons">
            @for ($i = 0; $i < count($options->img_fullsize); $i++)
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
            @endfor
        </x-slot>
    </x-carousel>
</section>
<section id="product-detail-container">
    <div id="product-detail">
        <div>
            <h2 id="title">{{ $product->name }}</h2>
            <div id="description">{{ $product->description }}</div>
        </div>
        <div>
            <div class="radio-toolbar">
                @foreach($sizes as $size)
                <input type="radio" name="radios" id="{{ $size->size }}" value="{{ $size->size }}">
                <label class="radio_label" for="{{ $size->size }}">{{ $size->size }}</label>
                @endforeach
            </div>
            <div>
                <!-- Aligner la quantité de façon asynchrone avec un eventListener sur les tailles -->
                <label for="quantity" class="sr-only">Underline select</label>
                <select id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option selected>Selectionner une quantité</option>
                </select>
            </div>
            <div id="buttons">
                <button class="button-stylised-1" role="button">Ajouter au panier</button>
                <button class="button-stylised-1 button-stylised-1-custom" role="button">Ajouter aux favoris</button>
            </div>
            <div id="delivery-and-return-details">
                <h4 class="text-sm">Couleur : {{ $options->color }}</h4>
                <h4 class="text-sm">Livraison sous cinq jours ouvrés.</h4>
                <h4 class="text-sm">Retour possible sous 7 jours à compter de la date de livraison.</h4>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script>
    document.querySelectorAll('.radio_label').forEach((radio) => {
        radio.addEventListener('click', function() {
            let data = {
                size: this.previousElementSibling.value,
                option_id: '{{ $product->options[0]->id }}',
            };

            const request = new Request('/get-quantity', {
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

                    for (let i = 1; i < data.size + 1; i++) {
                        options += '<option value="' + i + '">' + i + '</option>';
                    }

                    select.innerHTML = '<option selected>Selectionner une quantité</option>' + options;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        });
    })
</script>
@endsection