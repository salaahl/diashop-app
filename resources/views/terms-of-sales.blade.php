@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez les conditions générales de vente de {{ env('APP_NAME') }}. Informez-vous sur nos politiques de commande, de livraison et de retour pour une expérience d'achat en ligne fluide et satisfaisante. Prenez connaissance de nos engagements envers nos clients et de nos procédures pour un shopping en toute confiance.">
@endsection

@section('title', 'CGV - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<div class="title-container">
    <h1 class="w-min md:w-fit my-8 md:mt-24 md:mb-32"><span>Conditions Générales de Vente</span></h1>
</div>

<h3 class="mt-12 mb-4">1. Champ d'application</h3>
<p>Ces conditions générales de vente s'appliquent à toutes les commandes passées sur le site {{ env('APP_URL') }}.</p>

<h3 class="mt-12 mb-4">2. Commandes</h3>
<p>Les offres d'achat, y compris les offres promotionnelles, sont valables tant qu'elles sont affichées sur le Site. Les prix affichés incluent toutes les taxes applicables, mais n'incluent pas les frais de livraison.</p>

<h3 class="mt-12 mb-4">3. Paiement</h3>
<p>Les paiements sont traités via l'infrastructure financière Stripe, offrant une gamme de modes de paiement, y compris Klarna pour un paiement en 3 fois, cartes de crédit, PayPal, etc.</p>

<h3 class="mt-12 mb-4">4. Livraison</h3>
<p>Les livraisons sont effectuées en France métropolitaine et en Corse dans un délai moyen de 4 à 7 jours ouvrés, avec un maximum de 30 jours à compter de la réception de la commande.</p>

<h3 class="mt-12 mb-4">5. Droit de rétractation</h3>
<p>L'acheteur dispose d'un délai de rétractation de 14 jours pour retourner un article. L'article doit être retourné dans un état neuf. Pour initier le retour, l'acheteur doit contacter {{ env('MAIL_FROM_ADDRESS') }}.</p>
<p>Les frais de retour sont à la charge du client.</p>

<h3 class="mt-12 mb-4">6. Garanties</h3>
<p>L'acheteur bénéficie de la garantie légale de conformité et de la garantie légale des vices cachés conformément aux dispositions du Code de la consommation.</p>

<h3 class="mt-12 mb-4">7. Responsabilité</h3>
<p>{{ env("APP_NAME") }} décline toute responsabilité pour :</p>
<ul>
    <li>- toute interruption du site</li>
    <li>- tout problème technique</li>
    <li>- tout dommage résultant d’une intrusion frauduleuse ayant entraîné une modification des informations sur le site;</li>
    <li>et plus généralement de tout dommage direct ou indirect résultant de l'utilisation du site.</li>
</ul>

<h3 class="mt-12 mb-4">8. Médiation de la consommation</h3>
<p>L'acheteur peut recourir à la médiation de la consommation en cas de litige. Pour cela, il doit d'abord contacter le Service Client. En cas d'insatisfaction, il peut saisir la Commission européenne via la plateforme de règlement en ligne des litiges à l'adresse suivante : <a href=" https://ec.europa.eu/odr">ec.europa.eu/odr</a>.</p>
<p>Pour toute question relative à un éventuel litige, veuillez contacter le Service Client ou envoyer un e-mail à l'adresse : {{ env('MAIL_FROM_ADDRESS') }}.</p>

<p class="mb-12">Merci de votre confiance et bonne navigation sur {{ env('APP_URL') }} !</p>
@endsection

@section('scripts')
@parent
@endsection