import { removeProduct } from "./basket";

let $ = (id) => {
    return document.querySelector(id);
};
const popUp = $("#popup");
const popUpTimer = 5000;
let url = window.location.href;

console.log("🔍 RENDER TEST - Variables:", {
    stripeKey: !!process.env.STRIPE_KEY,
    deliveryCharges: process.env.STANDARD_DELIVERY_CHARGES,
});

// Loupe pour les photos d'articles en mode PC
if (window.innerWidth > 1023) {
    let zoomer = (function () {
        document.querySelectorAll("#slides-container img").forEach((img) => {
            img.addEventListener(
                "mousemove",
                function (e) {
                    let original = img,
                        magnified = img.nextElementSibling,
                        style = magnified.style,
                        x = e.clientX - $(".carousel-container").offsetLeft,
                        y = e.clientY - $(".carousel-container").offsetTop,
                        imgWidth = original.offsetWidth,
                        imgHeight = original.offsetHeight,
                        xperc = (x / imgWidth) * 100,
                        yperc = (y / imgHeight) * 100;

                    style.backgroundImage = "url('" + original.src + "')";
                    style.backgroundSize =
                        imgWidth * 2 + "px " + imgHeight * 2 + "px";
                    style.backgroundRepeat = "no-repeat";
                    style.backgroundPositionX = xperc + "%";
                    style.backgroundPositionY = yperc + "%";

                    // Empêche les débordements sur l'axe horizontal
                    if (xperc < 0.0) {
                        style.backgroundPositionX = "0%";
                    }

                    if (xperc > 100) {
                        style.backgroundPositionX = "100%";
                    }

                    // Empêche les débordements sur l'axe vertical
                    if (yperc < 0.0) {
                        style.backgroundPositionY = "0%";
                    }

                    if (yperc > 100) {
                        style.backgroundPositionY = "100%";
                    }
                },
                false
            );
        });
    })();
}

// Chargement des options de taille
document.querySelectorAll(".radio_label").forEach((size) => {
    size.addEventListener("click", function () {
        let data = {
            size: this.previousElementSibling.value.toLowerCase(),
            product_id: url.split("/").pop(),
        };

        const request = new Request("/get-stock", {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        });

        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                const select = $("#quantity");
                let options;

                for (let i = 0; i < data.quantity; i++) {
                    options +=
                        '<option value="' +
                        (i + 1) +
                        '">' +
                        (i + 1) +
                        "</option>";
                }

                select.innerHTML = options;
            })
            .catch((error) => {
                popUp.innerHTML =
                    "Une erreur est survenue. Veuillez recharger la page et reessayer.";
                popUp.classList.add("show");

                setTimeout(function () {
                    popUp.classList.remove("show");
                }, popUpTimer);
            });
    });
});

// Ajout au panier
if (document.getElementById("add-basket")) {
    document
        .getElementById("add-basket")
        .addEventListener("click", function () {
            if (
                $('#product-details-container input[type="radio"]:checked') &&
                $("#quantity").value
            ) {
                let data = {
                    size: $(
                        '#product-details-container input[type="radio"]:checked'
                    ).value,
                    quantity: parseInt($("#quantity").value),
                    product_id: url.split("/").pop(),
                };

                const request = new Request("/basket/store", {
                    method: "PUT",
                    body: JSON.stringify(data),
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('[name="csrf-token"]')
                            .getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                });

                fetch(request)
                    .then((response) => response.json())
                    .then((data) => {
                        // Récupération des produits
                        let products = "";
                        let count = 0;
                        let total = 0;

                        // Réinitialisation du timeout
                        localStorage.setItem("basket_timeout", 3600000);
                        localStorage.setItem("basket_start_time", Date.now());

                        Object.values(data).forEach((basket) => {
                            Object.values(basket).forEach((sizes) => {
                                Object.values(sizes).forEach((product) => {
                                    products +=
                                        '<tr class="bg-white border-b hover:bg-gray-50">' +
                                        '<td class="column-one py-4 pl-4">' +
                                        '<a href="/catalog/' +
                                        product.catalog +
                                        "/" +
                                        product.category +
                                        "/" +
                                        product.id +
                                        '">' +
                                        '<img class="h-auto w-16 md:w-24" src="https://res.cloudinary.com/dq8yfrr3w/image/upload/v1/' +
                                        product.img +
                                        '">' +
                                        "</a>" +
                                        "</td>" +
                                        '<td class="column-two pl-2 py-4 font-semibold text-gray-900">' +
                                        '<h4 class="w-min md:w-full text-center capitalize">' +
                                        product.name +
                                        "</h4>" +
                                        "</td>" +
                                        '<td class="column-three py-4 font-semibold text-gray-900">' +
                                        '<h4 class="size uppercase">' +
                                        (product.size === "os"
                                            ? "Unique"
                                            : product.size) +
                                        "</h4>" +
                                        "</td>" +
                                        '<td class="column-four py-4">' +
                                        '<div class="flex justify-center items-center">' +
                                        '<h4 class="quantity">' +
                                        product.quantity +
                                        "</h4>" +
                                        "</div>" +
                                        "</td>" +
                                        '<td class="column-five py-4 font-semibold text-gray-900">' +
                                        '<h4 class="price">' +
                                        (product.price * product.quantity).toFixed(2) +
                                        "</h4>" +
                                        "</td>" +
                                        '<td class="column-six py-4">' +
                                        '<div class="flex justify-center align-center">' +
                                        '<button type="button" class="remove-button">' +
                                        "<svg " +
                                        'xmlns="http://www.w3.org/2000/svg" ' +
                                        'viewBox="0 0 448 512" ' +
                                        'class="w-4 transition hover:translate-y-[-0.25rem]">' +
                                        "<path " +
                                        'fill="#000000" ' +
                                        'd="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />' +
                                        "</svg>" +
                                        "</button>" +
                                        "</div>" +
                                        '<input name="product_id" type="hidden" value="' +
                                        product.id +
                                        '" />' +
                                        "</td>" +
                                        "</tr>";

                                    count++;
                                    total += product.price * product.quantity;
                                });
                            });
                        });

                        // Création/mise à jour du tableau
                        $("#summary-container").innerHTML =
                            '<p class="mb-8 text-sm text-center">Les articles vous sont réservés pendant encore <span id="basket-timeout" class="font-bold">' +
                            localStorage.getItem("basket_timeout") / 60000 +
                            "</span> minutes !</p>" +
                            '<table class="w-full text-sm text-gray-500">' +
                            '<thead class="text-xs text-gray-700 uppercase bg-gray-50">' +
                            "<tr>" +
                            '<th class="column-one min-w-[50px] lg:min-w-[100px] py-3">Image</th>' +
                            '<th class="column-two min-w-[50px] lg:min-w-[100px] py-3">Article</th>' +
                            '<th class="column-three min-w-[50px] lg:min-w-[100px] py-3">Taille</th>' +
                            '<th class="column-four min-w-[50px] lg:min-w-[100px] py-3">Quantité</th>' +
                            '<th class="column-five min-w-[50px] lg:min-w-[100px] py-3">Prix</th>' +
                            '<th class="column-six min-w-[50px] lg:min-w-[100px] py-3 pr-1">Supprimer</th>' +
                            "</tr>" +
                            "</thead>" +
                            "<tbody>" +
                            products +
                            "</tbody>" +
                            "</table>";

                        // Mise à jour du prix total et des frais de livraison
                        let basketFooter = "";

                        if (total > 49) {
                            basketFooter = `
                                <div class="w-full">
                                    <h4 class="text-sm text-center text-gray-500 line-through">+ ${
                                        process.env.STANDARD_DELIVERY_CHARGES /
                                        100
                                    }€ de frais de livraison</h4>
                                    <h4 class="mb-2 text-sm text-center text-gray-500">Frais de livraison offerts !</h4>
                                    <h4 class="text-sm text-center text-gray-500">
                                        Options de payement disponiles : Visa, Mastercard, CB & Paypal
                                    </h4>
                                    <h4 class="mb-4 text-sm text-center text-gray-500">
                                        Un code promo ? Entrez-le dans l'écran suivant
                                    </h4>
                                    <a href="/checkout" class="button-stylised-1">
                                        <span>Payer -</span>
                                        <span class="total ml-[5px]">
                                            ${total.toFixed(2)}€
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                                        <path fill="#000000" d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path>
                                        </svg>
                                    </a>
                                </div>
                                `;
                        } else {
                            total +=
                                process.env.STANDARD_DELIVERY_CHARGES / 100;
                            basketFooter = `
                                <div class="w-full">
                                    <h4 class="mb-2 text-sm text-center text-gray-500">+ ${
                                        process.env.STANDARD_DELIVERY_CHARGES /
                                        100
                                    }€ de frais de livraison</h4>
                                    <h4 class="text-sm text-center text-gray-500">
                                        Options de payement disponiles : Visa, Mastercard, CB & Paypal
                                    </h4>
                                    <h4 class="mb-4 text-sm text-center text-gray-500">
                                        Un code promo ? Entrez-le dans l'écran suivant
                                    </h4>
                                    <a href="/checkout" class="button-stylised-1">
                                        <span>Payer -</span>
                                        <span class="total ml-[5px]">
                                            ${total.toFixed(2)}€
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="hidden h-[15px] ml-2">
                                        <path fill="#000000" d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path>
                                        </svg>
                                    </a>
                                </div>
                                `;
                        }

                        $("#basket-footer").innerHTML = basketFooter;

                        // Actualisation du compteur
                        document
                            .querySelectorAll(".basket-counter")
                            .forEach((counter) => {
                                counter.innerHTML = count;
                            });

                        // Actualisation des listeners
                        document
                            .querySelectorAll(".remove-button")
                            .forEach((button) => {
                                button.addEventListener("click", function () {
                                    removeProduct(this.closest("tr"));
                                });
                            });

                        // Ouverture du panier
                        $(".basket-btn").click();
                    })
                    .catch((error) => {
                        popUp.innerHTML = error;
                        popUp.classList.add("show");

                        setTimeout(function () {
                            popUp.classList.remove("show");
                        }, popUpTimer);
                    });
            } else {
                popUp.innerHTML =
                    "Veuillez d'abord sélectionner une taille et une quantité.";
                popUp.classList.add("show");

                setTimeout(function () {
                    popUp.classList.remove("show");
                }, popUpTimer);
            }
        });
}

// Favoris
if (document.getElementById("add-favorite")) {
    document
        .getElementById("add-favorite")
        .addEventListener("click", function () {
            let data = {
                product_id: url.split("/").pop(),
            };

            const request = new Request("/favorites/add", {
                method: "PUT",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
            });

            fetch(request)
                .then((response) => response.json())
                .then((data) => {
                    popUp.innerHTML = "Article ajouté aux favoris !";
                    popUp.classList.add("show");

                    setTimeout(function () {
                        popUp.classList.remove("show");
                    }, popUpTimer);

                    document
                        .getElementById("remove-favorite")
                        .classList.remove("hidden");
                    document
                        .getElementById("add-favorite")
                        .classList.add("hidden");
                })
                .catch((error) => {
                    popUp.innerHTML =
                        "Une erreur est survenue. Veuillez recharger la page et reessayer.";
                    popUp.classList.add("show");

                    setTimeout(function () {
                        popUp.classList.remove("show");
                    }, popUpTimer);
                });
        });
}

//
if (document.getElementById("remove-favorite")) {
    document
        .getElementById("remove-favorite")
        .addEventListener("click", function () {
            let data = {
                product_id: url.split("/").pop(),
            };

            const request = new Request("/favorites/remove", {
                method: "DELETE",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
            });

            fetch(request)
                .then((response) => response.json())
                .then((data) => {
                    popUp.innerHTML = "Article retiré des favoris !";
                    popUp.classList.add("show");

                    setTimeout(function () {
                        popUp.classList.remove("show");
                    }, popUpTimer);

                    document
                        .getElementById("remove-favorite")
                        .classList.add("hidden");
                    document
                        .getElementById("add-favorite")
                        .classList.remove("hidden");
                })
                .catch((error) => {
                    popUp.innerHTML =
                        "Une erreur est survenue. Veuillez recharger la page et reessayer.";
                    popUp.classList.add("show");

                    setTimeout(function () {
                        popUp.classList.remove("show");
                    }, popUpTimer);
                });
        });
}
