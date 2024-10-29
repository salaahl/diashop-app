const stripe = Stripe(process.env.STRIPE_KEY);

document.querySelectorAll(".carrier").forEach((carrier) => {
    carrier.addEventListener("click", () => {
        if (carrier.nextElementSibling.value == "mondial-relay") {
            initializeMondialRelayWidget();
            document.querySelector("#mr-widget").classList.add("show");
        } else {
            document.querySelector("#delivery-choice").classList.add("hidden");
            initialize(carrier.nextElementSibling.value);
        }
    });
});

async function initialize(carrier) {
    let data = {
        delivery_method: carrier,
    };

    try {
        const response = await fetch("/checkout", {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('[name="csrf-token"]')
                    .getAttribute("content"),
            },
        });

        const { clientSecret } = await response.json();

        const checkout = await stripe.initEmbeddedCheckout({
            clientSecret,
        });

        // Mount Checkout
        checkout.mount("#checkout");
    } catch (e) {
        alert("Erreur lors du chargement de votre panier. Veuillez réessayer.");
        window.location.href = "/";
    }
}

function initializeMondialRelayWidget() {
    // Charge le widget dans la DIV d'id "mr-widget" avec les paramètres indiqués
    // et renverra le Point Relais sélectionné par l'utilisateur dans le champs d'ID "Retour_Widget"
    $("#mr-widget").MR_ParcelShopPicker({
        Brand: "BDTEST", // Votre code client Mondial Relay
        Country: "FR", // Code ISO 2 lettres du pays utilisé pour la recherche,
        // Habiller le widget aux couleurs Mondial Relay (thème par défaut si ce paramètre n'est pas renseigné)
        Theme: "inpost", // Mettre la valeur "inpost" (en minuscule) pour utiliser le thème graphique Inpost
        OnNoResultReturned: function (e) {
            alert("Aucun résultat pour cette recherche.");
        },
        OnParcelShopSelected: function (data) {
            console.log(data);
            $("#mr-response").html("");

            let button = $(
                '<button class="button-stylised-1 w-fit">Sélectionner</button>'
            );
            $("#mr-response").append(button);

            // Ajouter un événement clic au bouton
            button.on("click", function () {
                // Créer un champ de texte pour afficher les données et l'ajouter
                let outputField = $('<div id="mr-selected-address"></div>');
                $("#mr-response").append(outputField);
                // Afficher les données dans le champ de texte
                outputField.html(
                    "<h6>Adresse selectionnée :</h6>" +
                        '<h6 id="mr-selected-address-name" class="font-bold">' +
                        data.name +
                        "</h6>" +
                        '<h6 id="mr-selected-address-address">' +
                        data.line1 +
                        "</h6>" +
                        '<h6 id="mr-selected-address-postal-code">' +
                        data.postal_code +
                        "</h6>" +
                        '<h6 id="mr-selected-address-city"> ' +
                        data.city +
                        "</h6>" +
                        '<h6 id="mr-selected-address-country">' +
                        data.country +
                        "</h6>"
                );

                // Supprimer le bouton
                button.remove();
            });
        },
    });

    // Affiche le widget dans la DIV d'id "mr-widget"
    document.querySelector("#mr-widget").classList.remove("hidden");
}
