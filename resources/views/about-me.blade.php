@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez qui nous sommes chez DiaShop-b. Plongez dans notre histoire, notre passion pour la mode et notre engagement envers nos clients." />
@endsection

@section('title', 'A propos de nous - ')

@section('links')
@parent
<style>
    h1 {
        background-image: linear-gradient(
            rgb(var(--accent-color-2)),
            rgb(var(--accent-color-2))
        );
    }

    .highlight {
        background-image: linear-gradient(
            rgb(var(--accent-color-1)),
            rgb(var(--accent-color-1))
        );
        background-size: 100% 15px;
        background-repeat: no-repeat;
        background-position: 0 100%;
    }

    @media (min-width: 768px) {
        #about-me>div:last-of-type {
            opacity: 0;
        }

        #about-me>div:last-of-type img {
            height: 40vh;
            width: auto;
            box-shadow: -20px -15px 10px hsl(0deg 0% 0% / 0.25);
        }

        .animateFadeSlideIn {
            animation: fadeSlideIn 1.5s ease forwards;
        }
    }

    @keyframes fadeSlideIn {
        from {
            margin-top: -5vh;
            opacity: 0;
        }

        to {
            margin-top: -30vh;
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
    <div class="h-[10vh] md:h-[40vh] w-full hidden md:flex justify-center items-center overflow-hidden bg-gray-800"></div>
    <div class="min-h-[40vh] w-full max-w-screen-xl mx-auto px-2 xl:px-0 md:mt-[-10vh] flex flex-col justify-center">
        <div class="md:h-[10vh] w-min md:w-auto flex justify-center items-center mx-auto">
            <h1 class="text-4xl md:text-white font-light">À propos de nous</h1>
        </div>
        <img src="{{ asset('images/woman-catalog.jpg')}}" class="h-auto w-full md:h-[50vh] max-md:my-10 mx-auto aspect-square border-[35px] border-black rounded-full object-cover">
        <p class="md:mt-10 text-center">Bienvenue chez DiaShop-b !</p>
        <p class="md:mt-10 text-justify">Je suis Dianaba, <span class="highlight">Parisienne passionnée de mode et exploratrice dans l’âme.</span> À travers mes voyages, je <span class="highlight">sélectionne en personne des pièces uniques et de qualité</span> qui apportent une touche d'authenticité à chaque garde-robe.</p>
        <p class="md:mt-10 text-justify"><span class="highlight">Notre collection de prêt-à-porter pour hommes et femmes</span> reflète les dernières tendances mondiales, avec des vêtements soigneusement choisis pour <span class="highlight">allier style, confort et caractère.</span> Chaque article incarne mon engagement pour une mode élégante et inspirée, <span class="highlight">importée spécialement pour vous ici à Paris.</span></p>
        <p class="md:mt-10 text-center">Plongez dans cet univers où <span class="highlight">chaque pièce raconte une histoire et sublime votre style.</span></p>
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