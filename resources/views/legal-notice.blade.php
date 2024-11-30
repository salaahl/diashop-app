@extends('layouts.app')

@section('meta')
@parent
<meta name="description" content="Consultez les mentions légales de DiaShop-b pour connaître les informations sur l'éditeur, l'hébergeur, la collecte de données personnelles, et plus encore. Assurez-vous d'être informé sur nos politiques pour une expérience de shopping en ligne transparente et sécurisée.">
@endsection

@section('title', 'Mentions légales - ')

@section('links')
@parent
<style>
    h3 {
        margin-bottom: 0.5% !important;
        margin-top: 4% !important;
    }

    main {
        margin-bottom: 4% !important;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1>Mentions Légales</h1>

<h3>1. Éditeur du site</h3>
<p>Le site {{ env('APP_URL') }} est édité par <a href="https://www.linkedin.com/in/salaha-sokhona/" target="_blank" class="underline">Salaha Sokhona</a>, en qualité de créateur du site.</p>

<h3>2. Gestionnaire du site</h3>
<p>La gestion du site, y compris la publication de contenu et la gestion des opérations, est assurée par Dianaba Dia</p>

<h3>3. Hébergeur du site</h3>
<p>Le site est hébergé par Hostinger International Ltd.</p>
<address>
    Siège social : 61 Lordou Vironos Street, 6023 Larnaca, Chypre.
</address>

<h3>4. Collecte de données personnelles</h3>
<p>Nous collectons uniquement les données personnelles nécessaires au fonctionnement du site et à la gestion des commandes. Les données collectées comprennent les informations fournies par l'utilisateur lors de la création d'un compte (nom, prénom, adresse e-mail, adresse postale) ainsi que les informations nécessaires au traitement des commandes.</p>

<h3>5. Cookies</h3>
<p>Le site utilise des cookies essentiels au bon fonctionnement du site. Ces cookies ne collectent pas de données personnelles et sont utilisés uniquement dans le but d'améliorer l'expérience de navigation de l'utilisateur.</p>

<h3>6. Droits d'auteur</h3>
<p>Tous les contenus présents sur le site {{ env('APP_URL') }} sont protégés par le droit d'auteur. Toute reproduction, même partielle, est strictement interdite sans l'autorisation préalable de <a href="https://www.linkedin.com/in/salaha-sokhona/" target="_blank" class="underline">Salaha Sokhona</a>.</p>

<h3>7. Limitation de responsabilité</h3>
<p>DiaShop-b décline toute responsabilité pour :</p>
<ul>
    <li>toute interruption du site ;</li>
    <li>tout problème technique ;</li>
    <li>tout dommage résultant d’une intrusion frauduleuse ayant entraîné une modification des informations sur le site ;</li>
    <li>et plus généralement de tout dommage direct ou indirect résultant de l'utilisation du site.</li>
</ul>

<h3>8. Droit applicable et juridiction compétente</h3>
<p>Les présentes mentions légales sont régies par le droit français. En cas de litige, les tribunaux français seront seuls compétents.</p>

<h3>9. Modification des mentions légales</h3>
<p>Les présentes mentions légales peuvent être modifiées à tout moment et sans préavis. Les utilisateurs sont invités à les consulter régulièrement.</p>

<h3>10. Médiation et résolution des litiges</h3>
<p>En cas de litige, les utilisateurs peuvent recourir à la médiation de la consommation. Pour cela, ils doivent d'abord contacter le Service Client. En cas d'insatisfaction, ils peuvent saisir la Commission européenne via la plateforme de règlement en ligne des litiges à l'adresse suivante : <a href="https://ec.europa.eu/odr" target="_blank">ec.europa.eu/odr</a>.</p>
<p>Pour toute question relative à un litige, veuillez nous contacter à l'adresse suivante : {{ env('MAIL_FROM_ADDRESS') }}.</p>

<p class="mt-[4%]">Merci de votre confiance et bonne navigation sur {{ env('APP_URL') }} !</p>
@endsection

@section('scripts')
@parent
@endsection