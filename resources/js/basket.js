let $ = (id) => {
    return document.querySelector(id);
};
const popUp = $("#popup");
const popUpTimer = 5000;

// Supprimer un produit
document.querySelectorAll(".remove-button").forEach((button) => {
    button.addEventListener("click", function () {
        removeProduct(this.parentElement.parentElement);
    });
});

function removeProduct(product) {
    let data = {
        product_id: product.querySelector("input").value,
        size: product
            .closest("tr")
            .querySelector(".size")
            .innerHTML.toLowerCase(),
    };

    data.size == "unique" ? (data.size = "os") : false;

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
            let table = product.closest("table");
            let newTotal =
                parseFloat($("#basket-footer .total").innerHTML) -
                (parseFloat(product.closest('tr').querySelector(".quantity").innerHTML) *
                parseFloat(product.closest('tr').querySelector(".price").innerHTML));

            $("#basket-footer .total").innerHTML = newTotal.toFixed(2);
            product.closest("tr").remove();

            // Si le panier est vide
            if (table.querySelectorAll("tr").length == 1) {
                table.remove();
                $("#summary-container").innerHTML = `
                <div id="basket-empty" class="h-full w-full flex justify-center items-center">
                    <h3 class="mb-0">Vous n'avez pas de produits dans votre panier</h3>
                </div>`;
                $("#basket-footer").innerHTML = "";
            }

            popUp.innerHTML = "Produit supprimé avec succès.";
            popUp.classList.add("show");

            setTimeout(function () {
                popUp.classList.remove("show");
            }, popUpTimer);
        })
        .catch((error) => {
            console.log(error.message);
        });
}
