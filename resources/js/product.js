let $ = (id) => {
    return document.querySelector(id);
};

//
window.addEventListener("load", () => {
    if (
        window.innerWidth < 767 &&
        $("#product-images-container li:nth-of-type(2)")
    ) {
        setTimeout(function () {
            $("#product-images-container li:first-of-type").style.animation =
                "translate 2s";
            $("#product-images-container li:nth-of-type(2)").style.animation =
                "translate 2s";
        }, 2000);
    }
});

let url = window.location.href;

document.querySelectorAll(".radio_label").forEach((radio) => {
    radio.addEventListener("click", function () {
        let data = {
            size: this.previousElementSibling.value.toLowerCase(),
            product_id: url.split("/").pop(),
        };
        console.log(url.split("/").pop());

        const request = new Request("/get-quantity", {
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

                select.innerHTML =
                    '<option value="" selected>Selectionner une quantité</option>' +
                    options;
            })
            .catch((error) => {
                console.log(error.message);
            });
    });
});

//
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
                        alert("Article ajouté au panier !");
                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            } else {
                alert(
                    "Veuillez d'abord sélectionner une taille et une quantité."
                );
            }
        });
}

//
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
                    alert("Article ajouté aux favoris !");
                    document
                        .getElementById("remove-favorite")
                        .classList.remove("hidden");
                    document
                        .getElementById("add-favorite")
                        .classList.add("hidden");
                })
                .catch((error) => {
                    console.log(error.message);
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
                    alert("Article retiré des favoris !");
                    document
                        .getElementById("remove-favorite")
                        .classList.add("hidden");
                    document
                        .getElementById("add-favorite")
                        .classList.remove("hidden");
                })
                .catch((error) => {
                    console.log(error.message);
                });
        });
}
