@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('links')
@parent
<style>
    main {
        max-width: unset;
        padding-left: 0;
        padding-right: 0;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Plus qu\'une étape ! Avant de commencer, nous vous invitons à vérifier votre adresse électronique en cliquant sur le lien que nous venons de vous envoyer') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse électronique que vous avez fournie lors de votre inscription.') }}
    </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Renvoyer l\'e-mail de vérification') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</x-guest-layout>
@endsection

@section('scripts')
@parent
@endsection
