@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Confirmation de commande')

@section('links')
@parent
@vite('resources/css/return.css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('header')
@parent
@endsection

@section('main')
<h2>Confirmation de Commande chez DiaShop-b</h2>

<p>Cher(e) client(e),</p>

<p>Merci d'avoir choisi DiaShop-b ! Nous sommes ravis de confirmer la réception de votre commande.</p>

<h3>Récapitulatif de votre commande :</h3>

<ul>
    <!-- -->
    <li><strong>Numéro de commande :</strong> #123456</li>
    <li><strong>Date de commande :</strong> [Date de la commande]</li>
    <li><strong>Articles Commandés :</strong>
        <ul>
            <li>[Nom de l'article 1] - [Quantité]</li>
            <li>[Nom de l'article 2] - [Quantité]</li>
            <!-- Ajoutez autant d'articles que nécessaire -->
        </ul>
    </li>
</ul>

<h3>Adresse de Livraison :</h3>

<p>[Adresse de Livraison]</p>

<h3>Détails de Livraison :</h3>

<ul>
    <li><strong>Mode de Livraison :</strong> Livraison Express</li>
    <li><strong>Estimation de Livraison :</strong> Sous 5 jours ouvrés</li>
    <li><strong>Société de Livraison :</strong> La Poste</li>
</ul>

<h3>Total de la Commande :</h3>

<ul>
    <li><strong>Total des Articles :</strong> [Montant total des articles]</li>
    <li><strong>Frais de Livraison :</strong> [Montant des frais de livraison]</li>
    <li><strong>Total à Payer :</strong> [Montant total à payer]</li>
</ul>

<h3>Détails de Paiement :</h3>

<ul>
    <li><strong>Mode de Paiement :</strong> [Mode de paiement choisi]</li>
    <li><strong>Statut du Paiement :</strong> Paiement confirmé</li>
</ul>

<h3>Suivi de Commande :</h3>

<p>Vous pourrez suivre l'évolution de votre commande en temps réel grâce au numéro de suivi qui vous sera envoyé dès l'expédition de votre colis.</p>

<h3>Contactez-nous :</h3>

<p>Si vous avez des questions ou des préoccupations concernant votre commande, n'hésitez pas à nous contacter via notre <a href="[lien vers le formulaire de contact]">formulaire de contact sur le site</a>.</p>

<p>Nous tenons à vous remercier sincèrement pour votre confiance. Chez DiaShop-b, chaque commande est spéciale, et nous sommes impatients de vous voir rayonner dans nos pièces tendance.</p>

<p>Happy shopping !</p>

<p>Bien à vous, <br>L'équipe DiaShop-b</p>
</div>
<section id="success" class="hidden">
    <p>
        We appreciate your business! A confirmation email will be sent to <span id="customer-email"></span>.

        If you have any questions, please email <a href="mailto:orders@example.com">orders@example.com</a>.
    </p>
</section>
@endsection

@section('scripts')
@parent
@vite('resources/js/stripe/return.js')
@endsection