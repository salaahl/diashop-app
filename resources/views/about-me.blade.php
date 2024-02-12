@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez qui nous sommes chez DiaShop-b. Plongez dans notre histoire, notre passion pour la mode et notre engagement envers nos clients." />
@endsection

@section('title', 'A propos de nous - ')

@section('links')
@parent
<style>
    @media (min-width: 768px) {
        #about-me>div:last-of-type {
            opacity: 0;
        }

        #about-me>div:last-of-type img {
            box-shadow: -20px -15px 10px hsl(0deg 0% 0% / 0.25);
        }

        .animateFadeSlideIn {
            animation: fadeSlideIn 2s forwards;
        }
    }

    @keyframes fadeSlideIn {
        from {
            margin-top: -5vh;
            opacity: 0;
        }

        to {
            margin-top: -35vh;
            opacity: 1;
        }
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="about-me" class="min-h-screen">
    <div class="h-[10vh] md:h-[40vh] w-full flex justify-center items-center overflow-hidden bg-gray-800"></div>
    <div class="min-h-[40vh] w-full max-w-screen-xl mx-auto px-2 xl:px-0 mt-[-10vh] flex flex-col justify-center">
        <h1 class=" h-[10vh] flex justify-center items-center m-0 text-white font-lighter">A propos de nous</h1>
        <img src="{{ asset('images/placeholder.png')}}" class="h-2/4 w-auto md:h-[50vh] max-md:my-10 mx-auto aspect-square rounded-full object-cover">
        <p class="md:mt-10 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum.</p>
        <p class="md:mt-10 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua !</p>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script>
    window.addEventListener("load", () => {
        document.querySelector("#about-me > div:last-of-type").classList.add("animateFadeSlideIn");
    });
</script>
@endsection