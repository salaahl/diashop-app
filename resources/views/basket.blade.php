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
@if (session()->has('message'))
<div class="alert alert-info">{{ session('message') }}</div>
@endif
<div id="summary-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if (session()->has("basket"))
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="column-one px-16 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="column-two min-[425px]:px-6 py-3">
                    Article
                </th>
                <th scope="col" class="column-two min-[425px]:px-6 py-3">
                    Taille
                </th>
                <th scope="col" class="column-three min-[425px]:px-6 py-3">
                    Quantité
                </th>
                <th scope="col" class="column-four min-[425px]:px-6 py-3">
                    Prix
                </th>
                <th scope="col" class="column-five min-[425px]:px-6 py-3">
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
                    <img src="/images/{{ $product['thumbnail'] }}" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                </td>
                <td class="column-two min-[425px]:px-6 py-4 font-semibold text-gray-900">
                    <h4>{{ $product['name'] }}</h4>
                </td>
                <td class="column-two min-[425px]:px-6 py-4 font-semibold text-gray-900">
                    <h4>{{ $product['size'] }}</h4>
                </td>
                <td class="column-three min-[425px]:px-6 py-4">
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
                <td class="column-four min-[425px]:px-6 py-4 font-semibold text-gray-900">
                    <h4 class="price">{{ $product['price'] }}</h4>
                    @php($total += $product['price'] * $product['quantity'])
                </td>
                <td class="column-five min-[425px]:px-6 py-4">
                    <div class="flex justify-center align-center">
                    <button type="button" class="remove-button focus:outline-none text-red bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm min-[425px]:px-5 p-2.5 text-white">X</button>
                    </div>
                    <input name="option_id" type="hidden" value="{{ $product['option_id'] }}" />
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
<div>
    <form>
        <div id="address-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="column-two px-6 py-3">
                            Adresse
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="address p-4">
                            <div class="relative input-container z-0 w-full mb-5 group">
                                <label for="floating_firstname" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                                <input type="text" name="floating_firstname" id="floating_firstname" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            </div>
                            <div class="relative input-container z-0 w-full mb-5 group">
                                <label for="floating_lastname" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                                <input type="text" name="floating_lastname" id="floating_lastname" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            </div>
                            <div class="relative input-container z-0 w-full mb-5 group">
                                <label for="floating_address" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Adresse</label>
                                <input type="text" name="floating_address" id="floating_address" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative input-container z-0 w-full mb-5 group">
                                    <label for="floating_postal_code" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Code postal</label>
                                    <input type="text" name="floating_postal_code" id="floating_postal_code" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                </div>
                                <div class="relative input-container z-0 w-full mb-5 group">
                                    <label for="floating_city" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ville</label>
                                    <input type="text" name="floating_city" id="floating_city" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                </div>
                            </div>
                            <div class="relative input-container z-0 w-full mb-5 group">
                                <label for="floating_phone" class="peer-focus:font-medium text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Numéro de téléphone</label>
                                <input type="tel" name="floating_phone" id="floating_phone" class="block pb-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="total-container" class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="column-two px-6 py-3">
                            Payement
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="p-4">
                            <h3 id="total">{{ $total }}</h3><span>€</span>
                            <a href="{{ route('checkout.show') }}" class="">Payer</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/basket.js')
@endsection