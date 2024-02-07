@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('links')
@parent
<style>
    button {
        width: 100%; 
    }

    p {
        text-align: center;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-gray-100 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-100 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-100 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
@endsection
