<div
  id="basket-modal"
  data-modal-placement="top-right"
  tabindex="-1"
  class="fixed top-0 left-0 right-0 z-50 hidden h-full w-full p-4 md:p-0 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
  <div class="relative h-full w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative h-full bg-white">
      <!-- Modal header -->
      <div
        class="flex items-center justify-between h-[10%] p-4 md:p-5 rounded-t"
      >
        <h2 id="basket-title" class="text-left uppercase font-normal">
          Votre panier
        </h2>
        <button
          type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="basket-modal"
        >
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
            />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div
        id="basket-body"
        class="h-[65%] md:h-[70%] p-4 md:p-5 space-y-4 overflow-auto"
      >
        <div
          id="summary-container"
          class="w-full relative md:mb-[25px] overflow-x-auto rounded-sm"
        >
          @if (session()->has("basket"))
          <table class="w-full text-sm text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="column-one min-w-[60px] lg:min-w-[100px] py-3"
                >
                  <span class="sr-only">Image</span>
                </th>
                <th
                  scope="col"
                  class="column-two min-w-[60px] lg:min-w-[100px] py-3"
                >
                  Article
                </th>
                <th
                  scope="col"
                  class="column-three min-w-[60px] lg:min-w-[100px] py-3"
                >
                  Taille
                </th>
                <th
                  scope="col"
                  class="column-four min-w-[60px] lg:min-w-[100px] py-3"
                >
                  Quantité
                </th>
                <th
                  scope="col"
                  class="column-five min-w-[60px] lg:min-w-[100px] py-3"
                >
                  Prix
                </th>
                <th
                  scope="col"
                  class="column-six min-w-[60px] lg:min-w-[100px] py-3 pr-1"
                >
                  Supprimer
                </th>
              </tr>
            </thead>
            <tbody>
              {{ $body }}
            </tbody>
          </table>
          @else
          <div id="basket-empty" class="h-full w-full flex justify-center items-center">
            <h3 class="mb-0">Vous n'avez pas de produits dans votre panier</h3>
          </div>
          @endif
        </div>
      </div>
      <!-- Modal footer -->
      <div
        class="flex items-center h-[25%] md:h-[20%] p-4 md:p-5 space-x-3 rtl:space-x-reverse rounded-b"
      >
        <div class="w-full">
          <h4 class="mb-2 text-sm text-center text-gray-500">
            {{ $delivery_fee }}
          </h4>
          <h4 class="text-sm text-center text-gray-500">
            Options de payement disponiles : Visa, Mastercard, CB & Paypal
          </h4>
          <h4 class="mb-4 text-sm text-center text-gray-500">
            Un code promo ? Entrez-le dans l'écran suivant
          </h4>
          <a
            href="{{ route('checkout.show') }}"
            class="button-stylised-1"
          >
            <span>Payer</span>
            <span class="ml-2">{{ $total }}</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 576 512"
              class="hidden h-[15px] ml-2"
            >
              <path
                fill="#000000"
                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"
              ></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
