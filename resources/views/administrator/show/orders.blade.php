@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Commandes</h1>
@if(isset($orders))
<nav id="filters" class="w-full flex justify-between items-center p-2 my-4 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="created_at_asc" @if(request()->get('filter') == 'created_at_asc') selected @endif>Du plus récent au plus ancien</option>
        <option value="created_at_desc" @if(request()->get('filter') == 'created_at_desc') selected @endif>Du plus ancien au plus récent</option>
        <option value="unprocessed_orders" @if(request()->get('filter') == 'unprocessed_orders') selected @endif>Commandes non traitées</option>
    </select>
</nav>
<ul>
    @foreach($orders as $order)
    <article class="command mb-16">
        <h2 class="mb-6 uppercase">Numéro de commande : {{ $order->command_number }}</h2>
        <div class="relative mx-auto mb-6 overflow-x-auto shadow-md sm:rounded-lg">
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
        @if($order->shipped == true)
        <h2 class="uppercase">Commande traitée !</h2>
        @else
        <form class="flex flex-nowrap" method="POST" action="{{ route('administrator.update.order') }}">
            @csrf
            <input name="order_id" type="hidden" value="{{ $order->id }}" />
            <input type="text" name="tracking_number" class="h-min w-3/4 mr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Numéro de suivi" required>
            <button type="submit" class="w-1/4 px-5 py-2.5 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                Envoyer
            </button>
        </form>
        @endif
    </article>
    @endforeach
</ul>
<aside class="w-full my-4">
    {{ $orders->links() }}
</aside>
@else
<h2>Qu'est-ce qui est jaune et qui attend ?</h2>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/filter_data.js')
@endsection