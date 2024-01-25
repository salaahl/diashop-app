@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez la livraison express chez DiaShop-b. Recevez vos commandes en France métropolitaine en seulement cinq jours ouvrés. Profitez de conditions de retour simplifiées avec une période de 14 jours pour retourner les articles. Les retours sont faciles à initier via notre formulaire de contact. Happy shopping !">
@endsection

@section('title', 'Livraisons et retours')

@section('links')
@parent
<style>
    @media (max-width: 767px) {
        #deliveries-and-returns {
            padding: 0 var(--container-padding-x);
        }
    }

    @media (min-width: 768px) and (max-width: 1279px) {
        #deliveries-and-returns {
            padding: 0 var(--container-padding-x);
        }
    }

    @media (min-width: 1280px) {
        #deliveries-and-returns {
            padding: 0 var(--container-padding-x);
        }
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<section id="deliveries-and-returns" class="min-h-[90vh] flex flex-col justify-around text-justify">
    <h1>Livraisons et retours</h1>
    <article>
        <h3>Livraison Express avec DiaShop-b</h3>
        <p>Bienvenue sur notre page dédiée à la livraison chez DiaShop-b, votre destination mode incontournable. Chez DiaShop-b, nous nous efforçons de rendre votre expérience d'achat aussi agréable que possible, de la commande à la réception de votre colis.</p>
    </article>
    <article>
        <h3>Livraison Rapide en France Métropolitaine</h3>
        <p>Nous expédions vos commandes avec soin dans les cinq jours ouvrés, garantissant ainsi une livraison rapide directement à votre porte. Nos partenariats avec La Poste et d'autres sociétés de livraison réputées assurent un acheminement sûr et fiable.</p>
    </article>
    <article>
        <h3>Conditions de Retour Simplifiées</h3>
        <p>Si un article ne répond pas à vos attentes, DiaShop-b offre la possibilité de retourner votre achat dans les 14 jours suivant la réception. Pour initier le processus de retour, veuillez nous contacter via le formulaire de contact sur notre site. Assurez-vous que l'article retourné est exempt de défauts pour garantir un remboursement complet.</p>
    </article>
    <article>
        <h3>Frais de Retour à la Charge du Client</h3>
        <p>Veuillez noter que les frais de retour sont à la charge du client. Nous vous recommandons d'utiliser un service de suivi pour assurer le bon retour de votre colis. Une fois votre article retourné reçu et inspecté, nous procéderons au remboursement dans les plus brefs délais.</p>
    </article>
    <article>
        <p>Chez DiaShop-b, notre engagement envers votre satisfaction s'étend au-delà de la livraison, englobant également le processus de retour. Nous comprenons l'importance de la transparence et de la simplicité dans vos transactions.</p>
    </article>
    <article>
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