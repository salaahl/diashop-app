@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Confirmation de commande - ')

@section('links')
@parent
<style>
    .last-p {
        background-image: linear-gradient(rgb(var(--accent-color-1)),
                rgb(var(--accent-color-1)));
        background-size: 100% 10px;
        background-repeat: no-repeat;
        background-position: left 0 bottom 0;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<div class="title-container ">
    <h1 class="mt-8 md:mt-24"><span>Confirmation de commande</span></h1>
</div>
<p class="mt-8 text-center">Merci d'avoir choisi {{ env("APP_NAME") }} {{ $order->fullname }} ! Nous sommes ravis de confirmer la réception de votre commande.</p>

<section class="command-header w-fit mt-16 mx-auto">
    <h3 class="mt-8 uppercase">Récapitulatif de votre commande</h3>
    <h4><strong>Numéro de commande :</strong> #{{ $order->command_number }}</h4>
    <h4><strong>Date de commande :</strong> {{ $order->created_at }}</h4>
</section>

<div class="relative w-full mt-8 rounded-lg">
    <table class="w-full max-w-[1024px] mx-auto text-sm text-center text-gray-500 shadow-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="max-md:hidden min-w-[60px] lg:min-w-[100px] py-3">
                    <span class="sr-only">Image</span>
                </th>
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
            @foreach($order->products as $key => $product)
            @foreach($product as $size)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="max-md:hidden pt-4 pb-4 pl-4">
                    <x-cld-image public-id="{{ \App\Models\Product::where('id', $key)->first()->img[0] }}" class="w-16 md:w-32 max-w-full max-h-full" alt="{{ $size['name'] }}"></x-cld-image>
                </td>
                <td class="py-4 font-semibold text-gray-900">
                    <h4 class="text-center">{{ ucfirst($size['name']) }}</h4>
                </td>
                <td class="py-4 font-semibold text-gray-900">
                    <h4 class="size uppercase">@if($size['size'] == "os") Unique @else {{ $size['size'] }} @endif</h4>
                </td>
                <td class="max-md:hidden py-4 font-semibold text-gray-900">
                    <h4 class="price">{{ $size['price'] }}</h4>
                </td>
                <td class="py-4 font-semibold text-gray-900">
                    <div class="flex justify-center items-center">
                        {{ $size['quantity'] }}
                    </div>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>

<div class="w-full max-w-[1024px] mx-auto flex justify-around mt-8 p-10 rounded-lg text-white bg-gray-800 shadow-md">
    <ul id="shipping-address" class="w-[40%]">
        <li>
            <h3 class="mb-2 uppercase">Adresse de Livraison</h3>
        </li>
        <li>{{ $order->shipping_address['line1'] }}</li>
        <li>{{ $order->shipping_address['line2'] }}</li>
        <li>{{ $order->shipping_address['postal_code'] }}</li>
        <li>{{ $order->shipping_address['city'] }}</li>
        <li>{{ $order->shipping_address['country'] }}</li>
    </ul>
    <div class="my-2 mx-[10%] border-2 md:border-4 border-white"></div>
    <ul id="billing-address" class="w-[40%]">
        <li>
            <h3 class="mb-2 uppercase">Adresse de facturation</h3>
        </li>
        <li>{{ $order->billing_address['line1'] }}</li>
        <li>{{ $order->billing_address['line2'] }}</li>
        <li>{{ $order->billing_address['postal_code'] }}</li>
        <li>{{ $order->billing_address['city'] }}</li>
        <li>{{ $order->billing_address['country'] }}</li>
    </ul>
</div>

<div class="w-full max-w-[1024px] mx-auto flex justify-around mt-8 p-10 rounded-lg text-white bg-[rgb(var(--accent-color-1))] shadow-md">
    <div class="w-full w-[40%]">
        <h3 class="mb-2 uppercase">Détails de Livraison</h3>
        <ul id="shipping-estimate">
            <li><strong>Mode de Livraison :</strong> Livraison {{ $order->amount['shipping_cost'] == 1000 ? 'Express' : 'Standard' }}</li>
            <li><strong>Estimation de Livraison :</strong>
                Entre le {{ $order->amount['shipping_cost'] == 1000 ? date('d-m-Y', strtotime('+2 days')) : date('d-m-Y', strtotime('+5 days')) }} et le {{ $order->amount['shipping_cost'] == 1000 ? date('d-m-Y', strtotime('+5 days')) : date('d-m-Y', strtotime('+7 days')) }}</li>
            <li><strong>Société de Livraison :</strong> {{ $order->amount['shipping_cost'] == 1000 ? 'La Poste' : 'UPS' }}</li>
        </ul>
    </div>
    <div class="my-2 mx-[10%] border-2 md:border-4 border-white"></div>
    <div class="w-full w-[40%]">
        <h3 class="mb-2 uppercase">Total</h3>
        <ul>
            <li><strong>Frais de livraison :</strong> {{ $order->amount['shipping_cost'] / 100 }}€</li>
            <li><strong>Total à payer :</strong> {{ $order->amount['amount_total'] / 100 }}€</li>
        </ul>
    </div>
</div>

<div class="max-w-[1024px] mt-8 mx-auto">
    <p>Vous pourrez suivre l'évolution de votre commande en temps réel grâce au numéro de suivi qui vous sera envoyé dès l'expédition de votre colis. Si vous avez des questions, veuillez envoyer un email à <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>.</p>
    <p class="mt-4">Nous tenons à vous remercier sincèrement pour votre confiance. Chez {{ env("APP_NAME") }}, chaque commande est spéciale, et nous sommes impatients de vous voir rayonner dans nos pièces tendance.</p>
    <p class="last-p w-fit my-8 mx-auto text-center">Bien à vous, <br>L'équipe {{ env("APP_NAME") }}</p>
</div>
@endsection

@section('scripts')
@parent
@endsection