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
<h1>Mes commandes</h1>
@if(isset($orders))
<section id="command-container">
    @foreach($orders as $order)
    <article class="command mb-16">
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
                </tbody>
            </table>
        </div>
    </article>
</section>
@endforeach
@else
<div class="min-h-[90vh] w-[100vw] absolute top-[10vh] left-0 right-0 flex flex-col justify-center items-center px-4">
    <h2 class="w-3/4 lg:w-2/4 mb-4 p-4 uppercase rounded-full bg-gray-200">Vous n'avez pas de commandes</h2>
</div>
@endif
@endsection

@section('scripts')
@parent
@endsection