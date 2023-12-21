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
    console.log(quantityInput);
    /*
     * Mettre ici le code qui ira mettre à jour le produit dans le back-end puis conditionner le product.remove à la réussite de la fonction.
     * Ajouter également un timer pour éviter les appels trop rapprochés.
     */
    var quantity = quantityInput;
    var currentQuantity = parseInt(quantity.value);
    var newQuantity = currentQuantity + delta;
    if (newQuantity > 0) {
        quantity.value = newQuantity;
    }
}

function removeProduct(product) {
    /*
     * Mettre ici le code qui ira supprimer le produit dans le back-end
     * puis conditionner le product.remove à la réussite de la fonction
     */
    product.remove();
    alert("Produit supprimé: " + product);
}
