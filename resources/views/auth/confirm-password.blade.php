@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Connexion')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Il s\'agit d\'une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection

@section('scripts')
@parent
@endsection