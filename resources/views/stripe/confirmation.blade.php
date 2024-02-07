@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Confirmation de commande - ')

@section('links')
@parent
@vite('resources/css/confirmation.css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="success" class="hidden">
    <h1>Confirmation de commande</h1>

    <p>Merci d'avoir choisi DiaShop-b <span id="customer-name"></span> ! Nous sommes ravis de confirmer la réception de votre commande.</p>

    <h3 class="mt-8 uppercase">Récapitulatif de votre commande</h3>
    <ul>
        <li><strong>Numéro de commande :</strong> #<span id="command-number"></span></li>
        <li><strong>Date de commande :</strong> <span id="command-date"></span></li>
    </ul>

    <h3 class="mt-8 mb-2 uppercase">Articles commandés</h3>
    @if(session('basket'))
    <div class="w-full relative md:mr-8 md:mb-4 lg:mr-20 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full mt-8 text-sm text-center text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="min-w-[60px] max-md:max-w-[150px] lg:min-w-[100px] py-3">
                        Article
                    </th>
                    <th scope="col" class="min-w-[60px] lg:min-w-[100px] py-3">
                        Taille
                    </th>
                    <th scope="col" class="max-md:hidden min-w-[60px] lg:min-w-[100px] py-3">
                        Prix
                    </th>
                    <th scope="col" class="min-w-[60px] lg:min-w-[100px] py-3">
                        Quantité
                    </th>
                </tr>
            </thead>
            <tbody>
                @php($total = 0)
                @foreach(session('basket') as $products)
                @foreach($products as $product)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="max:md-max-w-[150px] pl-2 py-4 font-semibold text-gray-900">
                        <h4 class="text-center">{{ ucfirst($product['name']) }}</h4>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        <h4 class="size uppercase">{{ $product['size'] }}</h4>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        <h4 class="price">{{ $product['price'] }}</h4>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        <div class="flex justify-center items-center">
                            {{ $product['quantity'] }}
                        </div>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @php(session()->forget("basket"))
    @endif

    <div class="w-full flex flex-wrap md:justify-around mt-8 bg-gray-100 p-2">
        <ul id="shipping-address" class="w-full md:w-auto">
            <li>
                <h3 class="mb-2 uppercase">Adresse de Livraison</h3>
            </li>
            <li id="shipping-line1"></li>
            <li id="shipping-line2"></li>
            <li id="shipping-postal_code"></li>
            <li id="shipping-city"></li>
            <li id="shipping-country"></li>
        </ul>
        <ul id="billing-address" class="w-full md:w-auto max-md:mt-8">
            <li>
                <h3 class="mb-2 uppercase">Adresse de facturation</h3>
            </li>
            <li id="billing-line1"></li>
            <li id="billing-line2"></li>
            <li id="billing-postal_code"></li>
            <li id="billing-city"></li>
            <li id="billing-country"></li>
        </ul>
    </div>

    <h3 class="mt-8 mb-2 uppercase">Détails de Livraison</h3>
    <ul id="shipping-standard" class="hidden">
        <li><strong>Mode de Livraison :</strong> Livraison standard</li>
        <li><strong>Estimation de Livraison :</strong> <span class="shipping-date"></span></li>
        <li><strong>Société de Livraison :</strong> La Poste</li>
    </ul>

    <ul id="shipping-express" class="hidden">
        <li><strong>Mode de Livraison :</strong> Livraison Express</li>
        <li><strong>Estimation de Livraison :</strong> <span class="shipping-date"></span></li>
        <li><strong>Société de Livraison :</strong> UPS</li>
    </ul>

    <h3 class="mt-8 mb-2 uppercase">Total</h3>
    <ul>
        <li><strong>Frais de livraison :</strong> <span id="shipping-cost"></span></li>
        <li><strong>Total à payer :</strong> <span id="ammount-total"></span></li>
    </ul>

    <p class="mt-8">Vous pourrez suivre l'évolution de votre commande en temps réel grâce au numéro de suivi qui vous sera envoyé dès l'expédition de votre colis. Si vous avez des questions, veuillez envoyer un email à <a href="mailto:diashop-b@gmail.com">diashop-b@gmail.com</a>.</p>
    <p class="mt-8">Nous tenons à vous remercier sincèrement pour votre confiance. Chez DiaShop-b, chaque commande est spéciale, et nous sommes impatients de vous voir rayonner dans nos pièces tendance.</p>

    <p class="mt-12 mb-8">Bien à vous, <br>L'équipe DiaShop-b</p>
</section>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/confirmation.js')
@endsection
