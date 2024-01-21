@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="">
@endsection

@section('title', 'A propos de moi')

@section('links')
@parent
<style>
    @media (max-width: 767px) {
        #aboutme-container {
            flex-direction: column;
            padding: var(--container-padding-y) var(--container-padding-x);
        }

        #aboutme-container>div {
            padding: 5%;
        }

        #aboutme-container>.text-container {
            width: 100%;
        }

        #aboutme-container>.img-container {
            margin-bottom: 10%;
            width: 80%;
        }
    }

    @media (min-width: 768px) and (max-width: 1279px) {
        #aboutme-container {
            padding: var(--container-padding-y) var(--container-padding-x);
        }
    }

    @media (min-width: 1280px) {

        #aboutme-container {
            padding: var(--container-padding-y) var(--container-padding-x);
        }
    }

    footer > section {
        margin: 0!important;
    }

    #aboutme-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-image: linear-gradient(rgb(0, 0, 0, 0.25), rgb(0, 0, 0, 0.25)),
            url("/public/images/aboutme-bg-placeholder.jpg");
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #aboutme-container .img-container,
    #aboutme-container .img-container img {
        border-radius: 300px;
    }

    #aboutme-container .img-container {
        padding: 2%;
    }

    #aboutme-container .img-container img {
        height: 100%;
        aspect-ratio: 1;
    }

    #aboutme-container .text-container>* {
        margin-bottom: 2%;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="aboutme-container" class="min-h-screen">
    <div class="img-container bg-slate-100">
        <img src="{{ asset('/images/aboutme-placeholder.jpg') }}" class="" alt="...">
    </div>
    <div class="text-container text-justify">
        <h2 class="text-justify text-5xl md:w-min mb-4 p-4 bg-gray-800 text-white uppercase">A propos de nous</h2>
        <p class="bg-gray-800 text-white p-1">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
            est
            laborum.
        </p>
        <a href="#" class="bg-gray-800 text-white p-1">En savoir plus</a>
    </div>
</section>
@endsection

@section('scripts')
@parent
@endsection