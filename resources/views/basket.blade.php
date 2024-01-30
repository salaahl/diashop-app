@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Panier')

@section('links')
@parent
@vite('resources/css/basket.css')
@endsection

@section('header')
@parent
@endsection

@section('main')
@if (session()->has("basket"))
<div id="summary-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="column-one px-16 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="column-two  py-3">
                    Article
                </th>
                <th scope="col" class="column-two  py-3">
                    Taille
                </th>
                <th scope="col" class="column-three  py-3">
                    Quantité
                </th>
                <th scope="col" class="column-four  py-3">
                    Prix
                </th>
                <th scope="col" class="column-five  py-3">
                    Supprimer
                </th>
            </tr>
        </thead>
        <tbody>
            @php($total = 0)
            @foreach(session('basket') as $products)
            @foreach($products as $product)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="column-one p-4">
                    <a href="/{{ $product['gender'] }}/catalog/{{ $product['category'] }}/{{ $product['id'] }}">
                        <img src="/images/{{ $product['thumbnail'] }}" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                    </a>
                </td>
                <td class="column-two pl-2 py-4 font-semibold text-gray-900">
                    <h4 class="text-center">{{ ucfirst($product['name']) }}</h4>
                </td>
                <td class="column-two py-4 font-semibold text-gray-900">
                    <h4 class="size uppercase">{{ $product['size'] }}</h4>
                </td>
                <td class="column-three  py-4">
                    <div class="flex justify-center items-center">
                        <button class="quantity-button quantity-down inline-flex items-center justify-center p-1 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="button">
                            <span class="sr-only">Baisser la quantité</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <div>
                            <input type="number" name="quantity" class="quantity-input bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1" value="{{ $product['quantity'] }}" required>
                        </div>
                        <button class="quantity-button quantity-up inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="button">
                            <span class="sr-only">Augmenter la quantité</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                </td>
                <td class="column-four  py-4 font-semibold text-gray-900">
                    <h4 class="price">{{ $product['price'] }}</h4>
                    @php($total += $product['price'] * $product['quantity'])
                </td>
                <td class="column-five  py-4">
                    <div class="flex justify-center align-center">
                        <button type="button" class="remove-button focus:outline-none text-red bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm min-[425px]:px-5 p-2.5 text-white">X</button>
                    </div>
                    <input name="product_id" type="hidden" value="{{ $product['id'] }}" />
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
<div class="lg:h-[85vh] flex flex-col justify-between items-center">
    <form class="w-full">
        <div id="total-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="column-two px-6 py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="p-4">
                            <h3 id="total" class="inline font-medium">{{ $total }}</h3><span class="ml-1 font-medium">€</span>
                            <h4 class="text-sm text-gray-500">+ 4.99€ de frais de livraison</h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <div class="w-full mt-8 mb-2">
        <h4 class="mb-4 text-sm text-center text-gray-500">Options de payement à la prochaine étape</h4>
        <a href="{{ route('checkout.show') }}" class="button-stylised-1">
            <span>Payer</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                <path fill="#000000" d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z" />
            </svg>
        </a>
    </div>
</div>
@else
<div id="basket-empty" class="h-[90vh] w-full flex flex-col justify-center items-center">
    <h1>Vous n'avez pas de produits dans votre panier</h1>
    <a href="/" class="m-5 py-3 px-6 bg-gray-800 text-white rounded-full">Retourner sur la page d'accueil</a>
</div>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/basket.js')
@endsection