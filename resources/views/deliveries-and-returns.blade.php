@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez la livraison express chez DiaShop-b. Recevez vos commandes en France métropolitaine en seulement cinq jours ouvrés. Profitez de conditions de retour simplifiées avec une période de 14 jours pour retourner les articles. Les retours sont faciles à initier via notre formulaire de contact. Happy shopping !">
@endsection

@section('title', 'Livraisons et retours - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="deliveries-and-returns" class="min-h-[90vh] lg:min-h-[92vh] lg:absolute lg:top-[110px] flex flex-col justify-between text-justify">
    <h1 class="min-h-[15vh] flex justify-center items-center my-10 text-white bg-gray-800">Livraisons et retours</h1>
    <article class="mb-3">
        <h3>Livraison express avec DiaShop-b</h3>
        <p>Bienvenue sur notre page dédiée à la livraison chez DiaShop-b, votre destination mode incontournable. Chez DiaShop-b, nous nous efforçons de rendre votre expérience d'achat aussi agréable que possible, de la commande à la réception de votre colis.</p>
    </article>
    <article class="mb-3">
        <h3>Livraison rapide en France métropolitaine</h3>
        <p>Nous expédions vos commandes avec soin dans les cinq jours ouvrés, garantissant ainsi une livraison rapide directement à votre porte. Nos partenariats avec La Poste et d'autres sociétés de livraison réputées assurent un acheminement sûr et fiable.</p>
    </article>
    <article class="mb-3">
        <h3>Conditions de retour simplifiées</h3>
        <p>Si un article ne répond pas à vos attentes, DiaShop-b offre la possibilité de retourner votre achat dans les 14 jours suivant la réception. Pour initier le processus de retour, veuillez nous contacter via le formulaire de contact sur notre site. Assurez-vous que l'article retourné est exempt de défauts pour garantir un remboursement complet.</p>
    </article>
    <article class="mb-3">
        <h3>Frais de retour à la charge du client</h3>
        <p>Veuillez noter que les frais de retour sont à la charge du client. Nous vous recommandons d'utiliser un service de suivi pour assurer le bon retour de votre colis. Une fois votre article retourné reçu et inspecté, nous procéderons au remboursement dans les plus brefs délais.</p>
    </article>
    <article class="mb-3">
        <p>Chez DiaShop-b, notre engagement envers votre satisfaction s'étend au-delà de la livraison, englobant également le processus de retour. Nous comprenons l'importance de la transparence et de la simplicité dans vos transactions.</p>
    </article>
    <article class="mb-8">
        <p class="text-center">Merci de faire partie de la famille DiaShop-b. Happy shopping !</p>
    </article>
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
