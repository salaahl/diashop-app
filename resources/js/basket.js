document.querySelectorAll(".quantity-button").forEach((button) => {
    button.addEventListener("click", function () {
        let delta;
        if (this.classList.contains("quantity-down")) {
            delta = -1;
        } else {
            delta = 1;
        }
        updateQuantity(this.parentElement.querySelector("input"), delta);
    });
});

document.querySelectorAll(".remove-button").forEach((button) => {
    button.addEventListener("click", function () {
        removeProduct(this.parentElement.parentElement);
    });
});

function updateQuantity(quantityInput, delta) {
    /*
     * Mettre ici le code qui ira mettre à jour le produit dans le back-end puis conditionner le product.remove à la réussite de la fonction.
     * Ajouter également un timer pour éviter les appels trop rapprochés.
     */
    var quantity = quantityInput;
    var currentQuantity = parseInt(quantity.value);
    var newQuantity = currentQuantity + delta;
    if (newQuantity > 0) {
        let data = {
            option_id: quantity.closest("tr").querySelector("input").value,
            quantity: newQuantity,
        };

        const request = new Request("/basket/update", {
            method: "PATCH",
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
                location.reload();
            })
            .catch((error) => {
                console.log(error.message);
            });
    }
}

function removeProduct(product) {
    /*
     * Mettre ici le code qui ira supprimer le produit dans le back-end
     * puis conditionner le product.remove à la réussite de la fonction
     */
    //
    let data = {
        option_id: product.querySelector("input").value,
    };

    const request = new Request("/basket/remove", {
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
            product.remove();
            alert("Produit supprimé: " + product);
        })
        .catch((error) => {
            console.log(error.message);
        });
}
