@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes commandes - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<div class="min-h-screen w-full mt-[-80px] pt-[80px]">
    @if(isset($orders))
    <div class="title-container">
        <h1 class="mt-8 md:mt-10 mb-20">Mes commandes</h1>
    </div>
    <section id="command-container" class="mt-12">
        @foreach($orders as $order)
        <article class="command max-w-[1024px] mb-16 mx-auto">
            <h2 class="mb-8 uppercase">Numéro de commande : {{ $order->command_number }}</h2>
            <div class="max-w-screen-lg relative mx-auto mb-4 overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                Article
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Taille
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Prix
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Quantité
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $product)
                        @foreach($product as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="p-4">
                                <h4 class="text-gray-500">{{ ucfirst($item['name']) }}</h4>
                            </td>
                            <td class="p-4">
                                <h4 class="text-gray-500 uppercase">{{ $item['size'] }}</h4>
                            </td>
                            <td class="p-4">
                                <h4 class="text-gray-500">{{ $item['price'] }}</h4>
                            </td>
                            <td class="p-4">
                                <h4 class="text-gray-500">{{ $item['quantity'] }}</h4>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td colspan="4" class="p-4">
                                <h4 class="text-gray-500"><span class="uppercase">Total :</span> {{ $order->amount['amount_total'] / 100 }}€ (dont {{ $order->amount['shipping_cost'] / 100 }}€ de frais de port)</h4>
                            </td>
                        </tr>
                        @if($order->track_number)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td colspan="4" class="p-4">
                                <h4 class="text-gray-500"><span class="uppercase">N° de suivi :</span> <a href="{{ $order->track_number }}" class="font-light" target="_blank">{{ $order->track_number }}</a></h4>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </article>
        @endforeach
    </section>
    @else
    <div id="orders-empty" class="h-[100vh] w-full top-0 left-0 flex flex-col justify-center items-center mt-[-80px] px-4">
        <div class="title-container">
            <h1 class="mb-0">Vous n'avez pas de commandes</h1>
        </div>
        <a href="{{ route('home') }}" class="m-5 py-3 px-6 bg-gray-800 text-center text-white rounded-full">Retourner sur la page d'accueil</a>
    </div>
    @endif
</div>
@endsection

@section('scripts')
@parent
@endsection