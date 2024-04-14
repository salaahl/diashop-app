@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Découvrez les conditions générales de vente de DiaShop-b. Informez-vous sur nos politiques de commande, de livraison et de retour pour une expérience d'achat en ligne fluide et satisfaisante. Prenez connaissance de nos engagements envers nos clients et de nos procédures pour un shopping en toute confiance.">
@endsection

@section('title', 'CGV - ')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Conditions Générales de Vente</h1>

<h2>1. Champ d'application</h2>
<p>Ces conditions générales de vente s'appliquent à toutes les commandes passées sur le site diashop-b.fr.</p>

<h2>2. Commandes</h2>
<p>Les offres d'achat, y compris les offres promotionnelles, sont valables tant qu'elles sont affichées sur le Site. Les prix affichés incluent toutes les taxes applicables, mais n'incluent pas les frais de livraison.</p>

<h2>3. Paiement</h2>
<p>Les paiements sont traités via l'infrastructure financière Stripe, offrant une gamme de modes de paiement, y compris Klarna pour un paiement en 3 fois, cartes de crédit, PayPal, etc.</p>

<h2>4. Livraison</h2>
<p>Les livraisons sont effectuées en France métropolitaine et en Corse dans un délai moyen de 4 à 7 jours ouvrés, avec un maximum de 30 jours à compter de la réception de la commande.</p>

<h2>5. Droit de rétractation</h2>
<p>L'acheteur dispose d'un délai de rétractation de 14 jours pour retourner un article. L'article doit être retourné dans un état neuf. Pour initier le retour, l'acheteur doit contacter diashop-b@gmail.com.</p>
<p>Les frais de retour sont à la charge du client.</p>

<h2>6. Garanties</h2>
<p>L'acheteur bénéficie de la garantie légale de conformité et de la garantie légale des vices cachés conformément aux dispositions du Code de la consommation.</p>

<h2>7. Responsabilité</h2>
<p>DiaShop-b décline toute responsabilité pour :</p>
<ul>
    <li>toute interruption du site ;</li>
    <li>tout problème technique ;</li>
    <li>tout dommage résultant d’une intrusion frauduleuse ayant entraîné une modification des informations sur le site ;</li>
    <li>et plus généralement de tout dommage direct ou indirect résultant de l'utilisation du site.</li>
</ul>

<h2>8. Médiation de la consommation</h2>
<p>L'acheteur peut recourir à la médiation de la consommation en cas de litige. Pour cela, il doit d'abord contacter le Service Client. En cas d'insatisfaction, il peut saisir la Commission européenne via la plateforme de règlement en ligne des litiges à l'adresse suivante : <a href="https://ec.europa.eu/odr">ec.europa.eu/odr</a>.</p>
<p>Pour toute question relative à un éventuel litige, veuillez contacter le Service Client ou envoyer un e-mail à l'adresse : diashop-b@gmail.com.</p>
@endsection

@section('scripts')
@parent
@endsection
