@php
$delivery_costs = 0;
$total = 0;
@endphp

<div
  id="basket-modal"
  data-modal-placement="top-right"
  tabindex="-1"
  class="fixed top-0 left-0 right-0 z-[250] hidden h-full w-full overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
  <div class="relative h-full w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative h-full bg-white">
      <!-- Modal header -->
      <div
        class="flex items-center justify-between h-[10%] p-4 md:p-5 rounded-t">
        <h2 id="basket-title" class="text-left uppercase font-normal">
          <span>Votre panier</span>
        </h2>
        <button
          type="button"
          id="close-basket-modal"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="basket-modal">
          <svg
            class="w-3 h-3"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14">
            <path
              stroke="white"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="4"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div
        id="basket-body"
        class="h-[65%] p-4 md:p-5 overflow-auto">
        <div
          id="summary-container"
          class="h-full w-full overflow-x-auto">
          @if(session()->has("basket"))
          <p class="mb-8 text-sm text-center">Les articles vous sont réservés pendant encore <span id="basket-timeout" class="font-bold"></span> minutes !</p>
          <table class="w-full text-sm text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="column-one min-w-[50px] lg:min-w-[100px] py-3">
                  Image
                </th>
                <th
                  scope="col"
                  class="column-two min-w-[50px] lg:min-w-[100px] py-3">
                  Article
                </th>
                <th
                  scope="col"
                  class="column-three min-w-[50px] lg:min-w-[100px] py-3">
                  Taille
                </th>
                <th
                  scope="col"
                  class="column-four min-w-[50px] lg:min-w-[100px] py-3">
                  Quantité
                </th>
                <th
                  scope="col"
                  class="column-five min-w-[50px] lg:min-w-[100px] py-3">
                  Prix
                </th>
                <th
                  scope="col"
                  class="column-six min-w-[50px] lg:min-w-[100px] py-3 pr-1">
                  Supprimer
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach(session('basket') as $products)
              @foreach($products as $product)
              <tr class="bg-white border-b hover:bg-gray-50">
                <td class="column-one py-4 pl-4">
                  <a href="{{ route('product', [$product['catalog'], $product['category'], $product['id']]) }}">
                    @php
                    $imagePath = str_replace('\\', '/', $product['img'])
                    @endphp
                    <x-cld-image public-id="{{ $imagePath }}" class="h-auto w-16 md:w-24" alt="{{ $product['name'] }}"></x-cld-image>
                  </a>
                </td>
                <td class="column-two pl-2 py-4 font-semibold text-gray-900">
                  <h4 class="w-min md:w-full text-center">{{ ucfirst($product['name']) }}</h4>
                </td>
                <td class="column-three py-4 font-semibold text-gray-900">
                  <h4 class="size uppercase">@if($product['size'] == "os") Unique @else {{ $product['size'] }} @endif</h4>
                </td>
                <td class="column-four py-4">
                  <div class="flex justify-center items-center">
                    <h4 class="quantity">{{ $product['quantity'] }}</h4>
                  </div>
                </td>
                <td class="column-five py-4 font-semibold text-gray-900">
                  <h4 class="price">{{ $product['price'] * $product['quantity'] }}</h4>
                  @php($total += $product['price'] * $product['quantity'])
                </td>
                <td class="column-six py-4">
                  <div class="flex justify-center align-center">
                    <button type="button" class="remove-button">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="w-4 transition hover:translate-y-[-0.25rem]">
                        <path
                          fill="#000000"
                          d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                      </svg>
                    </button>
                  </div>
                  <input name="product_id" type="hidden" value="{{ $product['id'] }}" />
                </td>
              </tr>
              @endforeach
              @endforeach
            </tbody>
          </table>
          @else
          <div id="basket-empty" class="h-full w-full">
            <h3 class="absolute top-1/2 left-0 right-0 px-1 text-center text-balance">Vous n'avez pas de produits dans votre panier</h3>
          </div>
          @endif
        </div>
      </div>
      <!-- Modal footer -->
      <div
        id="basket-footer"
        class="flex items-center h-[25%] p-4 md:p-5 space-x-3 rtl:space-x-reverse rounded-b">
        @if($total > 0)
        <div class="w-full">
          @if($total > 49)
          <h4 class="text-sm text-center text-gray-500 line-through">+ {{ env('STANDARD_DELIVERY_CHARGES', 0) / 100 }}€ de frais de livraison</h4>
          <h4 class="mb-2 text-sm text-center text-gray-500">Frais de livraison offerts !</h4>
          @else
          @php($delivery_costs = env('STANDARD_DELIVERY_CHARGES', 0) / 100)
          <h4 class="mb-2 text-sm text-center text-gray-500">+ {{ $delivery_costs }}€ de frais de livraison</h4>
          @endif
          <h4 class="text-sm text-center text-gray-500">
            Options de payement disponiles : Visa, Mastercard, CB & Paypal
          </h4>
          <h4 class="mb-4 text-sm text-center text-gray-500">
            Un code promo ? Entrez-le dans l'écran suivant
          </h4>
          <a
            href="{{ route('checkout') }}"
            class="button-stylised-1">
            <span>Payer -</span>
            <span class="total ml-[5px]">{{ number_format($total + $delivery_costs, 2) }}€</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 576 512"
              class="hidden h-[15px] ml-2">
              <path
                fill="#000000"
                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path>
            </svg>
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>