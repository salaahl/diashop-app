@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter une nouvelle taille')

@section('links')
@parent
@endsection

@section('header')
@parent
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        max-width: 768px !important;
    }

    footer {
        display: none;
    }

    .alert {
        margin-top: 10%;
        color: red;
        text-align: center;
    }
</style>
@endsection

@section('main')
<div>
    <h1 class="mb-4 text-xl font-bold text-gray-900 uppercase">Ajouter de nouvelles tailles</h1>
    <form action="{{ route('store.size') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="col-span-2 md:col-span-1">
            <label for="option_id" class="sr-only uppercase">Choisissez un produit</label>
            <select id="option_id" name="option_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option disabled selected>Choisissez un produit</option>
                @foreach($options as $option)
                <option value="{{ $option->id }}">{{ $option->product->name }} - {{ $option->color }} - {{ $option->product->catalog->gender }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2 md:col-span-1">
            <h3 class="mt-6 font-semibold text-gray-900 text-sm uppercase">Tailles</h3>
            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
                <h4 id="accordion-flush-heading-1">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                        <span>Taille S</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h4>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                    <div class="py-5 border-b border-gray-200 ">
                        <input type="number" name="quantity_s" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                    </div>
                </div>
                <h4 id="accordion-flush-heading-2">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                        <span>Taille M</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h4>
                <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                    <div class="py-5 border-b border-gray-200 ">
                        <input type="number" name="quantity_m" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                    </div>
                </div>
                <h4 id="accordion-flush-heading-3">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                        <span>Taille L</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h4>
                <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                    <div class="py-5 border-b border-gray-200 ">
                        <input type="number" name="quantity_l" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                    </div>
                </div>
                <h4 id="accordion-flush-heading-4">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-4" aria-expanded="false" aria-controls="accordion-flush-body-4">
                        <span>Taille XL</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h4>
                <div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
                    <div class="py-5 border-b border-gray-200 ">
                        <input type="number" name="quantity_xl" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                    </div>
                </div>
                <h4 id="accordion-flush-heading-5">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200   gap-3" data-accordion-target="#accordion-flush-body-5" aria-expanded="false" aria-controls="accordion-flush-body-5">
                        <span>Taille XXL</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h4>
                <div id="accordion-flush-body-5" class="hidden" aria-labelledby="accordion-flush-heading-5">
                    <div class="py-5 border-b border-gray-200 ">
                        <input type="number" name="quantity_xxl" class="w-full m-2 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600" placeholder="Quantité">
                    </div>
                </div>
                <button type="submit" class="w-full px-5 py-2.5 mt-6 sm:mt-6 text-sm font-medium text-center bg-gray-900 text-white rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    Add sizes
                </button>
            </div>
        </div>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection

@section('scripts')
@parent
@endsection