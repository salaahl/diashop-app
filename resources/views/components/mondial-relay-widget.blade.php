<style>
    #navbar button,
    .basket-counter {
        display: none;
    }

    #details-table,
    #mr-widget.show,
    #address-element,
    #shipping-options,
    #payment-element,
    #submit {
        margin-bottom: 24px;
    }

    .radio-toolbar {
        max-width: unset;
        margin: 0;
    }

    .separator {
        border-color: rgb(var(--accent-color-1));
    }

    /* Mondial relay widget */
    #mr-widget {
        height: 0;
        margin: 0;
        overflow: hidden;
    }

    #mr-widget.show {
        height: 600px;
        max-height: fit-content;
        transition: all 0.5s ease;
    }

    .MR-Widget.fr-FR {
        position: relative;
        width: 100%;
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        transition: all 1s ease;
    }

    #mr-widget .MR-Widget .MRW-Line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3px;
    }

    #mr-widget .MR-Widget input {
        width: 100% !important;
        background: unset;
    }

    #mr-widget .MR-Widget input+input {
        margin-right: 2%;
    }

    #mr-widget .MR-Widget button {
        padding: 1%;
    }

    #mr-widget .MR-Widget button:first-of-type {
        margin-right: 1%;
    }

    #mr-widget .MR-Widget .MRW-Title {
        padding: 1%;
        background: rgb(249, 250, 251);
    }

    #mr-widget .MR-Widget .MRW-Search {
        background: unset;
    }

    #mr-widget .progressBar {
        width: 50px;
        margin: auto;
    }

    #mr-widget .MR-Widget .MRW-Results>div {
        max-height: 100%;
    }

    #mr-widget .MR-Widget .MRW-Results>div:first-of-type {
        max-width: 65%;
    }

    #mr-widget .MR-Widget .MRW-Results>div:last-of-type {
        max-width: 35%;
    }

    #Img_Pays {
        display: none;
    }

    /* Stripe elements */
    #payment-message {
        color: rgb(105, 115, 134);
        font-size: 16px;
        line-height: 20px;
        padding-top: 12px;
        text-align: center;
    }

    /* Buttons and links */
    #payment-form .button-stylised-1 {
        width: 100%;
    }

    #payment-form .button-stylised-1:hover {
        filter: contrast(115%);
    }

    #payment-form .button-stylised-1:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    #payment-form .spinner,
    #payment-form .spinner:before,
    #payment-form .spinner:after {
        border-radius: 50%;
    }

    #payment-form .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    #payment-form .spinner:before,
    #payment-form .spinner:after {
        position: absolute;
        content: "";
    }

    #payment-form .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #0055DE;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    #payment-form .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #0055DE;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    #retry-button {
        text-align: center;
        background: #0055DE;
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 12px 16px;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }

    @media (min-width: 768px) {
        #navbar-dropdown {
            display: none;
        }
    }

    @media (min-width: 1024px) {

        #details-table,
        .separator {
            top: calc(80px + 1rem);
        }
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes fadeInAnimation {
        to {
            opacity: 1;
        }
    }
</style>

<!-- Mondial relay widget -->
<div id="mr-widget" class="hidden"></div>
<div id="mr-response"></div>

<!-- On charge jquery pour l'affichage de la map -->
<script
    type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Charger Leaflet pour l'affichage de la map-->
<script
    type="text/javascript"
    src="//unpkg.com/leaflet/dist/leaflet.js"></script>
<link
    rel="stylesheet"
    type="text/css"
    href="//unpkg.com/leaflet/dist/leaflet.css" />

<!--On charge le widget mondial relay depuis leurs serveurs-->
<script
    type="text/javascript"
    src="https://widget.mondialrelay.com/parcelshop-picker/jquery.plugin.mondialrelay.parcelshoppicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Charge le widget dans la DIV d'id "mr-widget" avec les paramètres indiqués
        // et renverra le Point Relais sélectionné par l'utilisateur dans le champs d'ID "Retour_Widget"
        $('#mr-widget').MR_ParcelShopPicker({
            Brand: 'BDTEST', // Votre code client Mondial Relay
            Country: 'FR', // Code ISO 2 lettres du pays utilisé pour la recherche,
            // Habiller le widget aux couleurs Mondial Relay (thème par défaut si ce paramètre n'est pas renseigné)
            Theme: 'inpost', // Mettre la valeur "inpost" (en minuscule) pour utiliser le thème graphique Inpost
            OnNoResultReturned: function(e) {
                alert("Aucun résultat pour cette recherche.");
            },
            OnParcelShopSelected: function(data) {
                console.log(data);
                $('#mr-response').html('');

                let button = $('<button class="button-stylised-1 w-fit">Sélectionner</button>');
                $('#mr-response').append(button);

                // Ajouter un événement clic au bouton
                button.on('click', function() {
                    // Créer un champ de texte pour afficher les données et l'ajouter
                    let outputField = $('<div id="mr-selected-address"></div>');
                    $('#mr-response').append(outputField);
                    // Afficher les données dans le champ de texte
                    outputField.html(
                        '<h6>Adresse selectionnée :</h6>' +
                        '<h6 id="mr-selected-address-name" class="font-bold">' + data.name + '</h6>' +
                        '<h6 id="mr-selected-address-address">' + data.line1 + '</h6>' +
                        '<h6 id="mr-selected-address-postal-code">' + data.postal_code + '</h6>' +
                        '<h6 id="mr-selected-address-city"> ' + data.city + '</h6>' +
                        '<h6 id="mr-selected-address-country">' + data.country + '</h6>'
                    );

                    // Supprimer le bouton
                    button.remove();
                });
            },
        });
    });
</script>