<section>
    <div id="garanties-container" class="w-full max-w-screen-2xl flex flex-nowrap mx-auto pt-6">
        <div class="w-1/4 flex flex-col xl:flex-row items-center justify-start xl:justify-center px-2 py-4 text-sm text-center text-gray-500 font-semibold md:border-r-4 md:border-gray-300">Livraison gratuite à partir de {{ env('FREE_SHIPPING') / 100 }}€</div>
        <div class="w-1/4 flex flex-col xl:flex-row items-center justify-start xl:justify-center px-2 py-4 text-sm text-center text-gray-500 font-semibold md:border-r-4 md:border-gray-300">Satisfait ou remboursé</div>
        <div class="w-1/4 flex flex-col xl:flex-row items-center justify-start xl:justify-center px-2 py-4 text-sm text-center text-gray-500 font-semibold md:border-r-4 md:border-gray-300">Paiement sécurisé avec Stripe</div>
        <div class="w-1/4 flex flex-col xl:flex-row items-center justify-start xl:justify-center px-2 py-4 text-sm text-center text-gray-500 font-semibold">3x sans frais</div>
    </div>
    <div class="md:w-3/4 max-w-screen-xl mx-auto pt-12 text-[5rem] font-[Truculenta] font-bold text-center uppercase text-gray-400">
        {{ env("APP_NAME") }}
    </div>
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="{{ route('about-us') }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    À propos de nous
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ route('terms-of-sales') }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Conditions générales de vente
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ route('legal-notice') }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Mentions légales
                </a>
            </div>
        </nav>
        <div class="flex justify-center mt-8 space-x-6">
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <span class="sr-only">Facebook</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <span class="sr-only">Snapchat</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5.829 4.533c-.6 1.344-.363 3.752-.267 5.436-.648.359-1.48-.271-1.951-.271-.49 0-1.075.322-1.167.802-.066.346.089.85 1.201 1.289.43.17 1.453.37 1.69.928.333.784-1.71 4.403-4.918 4.931-.251.041-.43.265-.416.519.056.975 2.242 1.357 3.211 1.507.099.134.179.7.306 1.131.057.193.204.424.582.424.493 0 1.312-.38 2.738-.144 1.398.233 2.712 2.215 5.235 2.215 2.345 0 3.744-1.991 5.09-2.215.779-.129 1.448-.088 2.196.058.515.101.977.157 1.124-.349.129-.437.208-.992.305-1.123.96-.149 3.156-.53 3.211-1.505.014-.254-.165-.477-.416-.519-3.154-.52-5.259-4.128-4.918-4.931.236-.557 1.252-.755 1.69-.928.814-.321 1.222-.716 1.213-1.173-.011-.585-.715-.934-1.233-.934-.527 0-1.284.624-1.897.286.096-1.698.332-4.095-.267-5.438-1.135-2.543-3.66-3.829-6.184-3.829-2.508 0-5.014 1.268-6.158 3.833z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <span class="sr-only">Instagram</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <p class="mt-8 text-base leading-6 text-center text-gray-500">Paiement sécurisé by <a href="https://stripe.com/fr" target="_blank" class="font-bold">STRIPE</a></p>
        <p class="mt-8 text-sm leading-6 text-center text-gray-500">
            <a href="https://www.linkedin.com/in/salaha-sokhona/" target="_blank">© {{ date("Y") }} Salaha Sokhona pour {{ env("APP_NAME") }}, Inc. Tous droits réservés.</a>
        </p>
    </div>
</section>