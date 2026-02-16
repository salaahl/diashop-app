@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez qui nous sommes chez {{ env('APP_NAME') }}. Plongez dans notre histoire, notre passion pour la mode et notre engagement envers nos clients." />
@endsection

@section('title', 'A propos de nous - ')

@section('links')
@parent
<style>
    h1>span,
    .highlight {
        background-image: linear-gradient(rgb(var(--accent-color-2)),
                rgb(var(--accent-color-2)));
    }

    h1 {
        margin: 25px auto auto auto;
    }

    .highlight {
        background-size: 100% 5px;
        background-repeat: no-repeat;
        background-position: 0 100%;
    }

    @media (min-width: 768px) {
        h1 {
            margin: 25px auto;
        }

        #about-us>div:last-of-type {
            opacity: 0;
        }

        #about-us>div:last-of-type img {
            height: 40vh;
            width: auto;
        }

        @supports (height: 1dvh) {
            #about-us>div:last-of-type img {
                height: 40dvh;
            }
        }

        .animateFadeSlideIn {
            animation: fadeSlideIn 1.5s ease forwards;
        }
    }

    @keyframes fadeSlideIn {
        from {
            transform: translateY(-15%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="about-us" class="min-h-screen">
    <div class="min-h-[40vh] w-full mx-auto px-2 xl:px-0 flex flex-col justify-center">
        <div class="title-container w-min md:w-auto flex justify-center items-center mx-auto">
            <h1 class="mt-8 md:mt-24"><span>À propos de nous</span></h1>
        </div>
        <div id="image-container" class="w-full my-10 md:my-0 p-6 md:px-0 bg-[#eeaeca] rounded-lg">
            <img src="{{ asset('images/woman-catalog.jpg')}}" alt="Image d'une mannequin du site" class="h-auto w-3/4 md:h-[50vh] mx-auto aspect-square border-[25px] border-white rounded-full object-cover">
        </div>
        <p class="md:mt-4 text-lg text-center font-[600]">Bienvenue chez {{ env("APP_NAME") }} !</p>
        <p class="mt-8 text-justify">Je suis Dianaba, Parisienne passionnée de mode et exploratrice dans l’âme. À travers mes voyages, je sélectionne en personne des pièces uniques et de qualité qui apportent une touche d'authenticité à chaque garde-robe.</p>
        <p class="mt-8 text-justify">Notre collection de prêt-à-porter pour hommes et femmes reflète les dernières tendances mondiales, avec des vêtements soigneusement choisis pour allier style, confort et caractère. Chaque article incarne mon engagement pour une mode élégante et inspirée, importée spécialement pour vous ici à Paris.</p>
        <p class="my-8 text-center">Plongez dans cet univers où <span class="highlight">chaque pièce raconte une histoire et sublime votre style.</span></p>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script>
    window.addEventListener("load", () => {
        document.querySelector("#about-us > div:last-of-type").classList.add("animateFadeSlideIn");
    });
</script>
@endsection
