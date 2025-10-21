<div id="sticky-banner" tabindex="-1" class="flex justify-between h-[30px] w-full text-white">
  <div id="banner-inner" class="w-full flex flex-col flex-wrap mx-auto overflow-hidden">
    @if(env("VITE_DISCOUNT_CODE"))
    <p class="banner-slide banner-slide-first">
      <span class="h-full">Profitez de -10% sur tout le site avec le code promo {{ env("VITE_DISCOUNT_CODE") }}</span>
    </p>
    @endif
    <p class="banner-slide banner-slide-second">
      <span class="h-full">Paiement en 3x sans frais avec Klarna</span>
    </p>
    <p class="banner-slide banner-slide-third">
      <span class="h-full">Livraison offerte à partir de {{ env("VITE_FREE_SHIPPING") / 100 }} euros d'achats</span>
    </p>
  </div>
</div>