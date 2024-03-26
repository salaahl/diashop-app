<div class="min-h-[90vh] lg:min-h-[92vh] flex flex-col justify-center items-center max-lg:px-2 pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    @if(Route::is("login"))
    <a href="{{ route('register') }}" class="w-full sm:max-w-md mt-6">
        <x-primary-button class="w-full">
            {{ __('Pas de compte ? S\'inscrire') }}
        </x-primary-button>
    </a>
    @elseif(Route::is("register"))
    <a href="{{ route('login') }}" class="w-full sm:max-w-md mt-6">
        <x-primary-button class="w-full">
            {{ __('Se connecter') }}
        </x-primary-button>
    </a>
    @endif
</div>
