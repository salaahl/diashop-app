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
    var quantity = quantityInput;
    var currentQuantity = parseInt(quantity.value);
    var newQuantity = currentQuantity + delta;
    if (newQuantity > 0) {
        let data = {
            product_id: quantity
                .closest("tr")
                .querySelector('[name="product_id"]').value,
            size: quantity
                .closest("tr")
                .querySelector(".size")
                .innerHTML.toLowerCase(),
            quantity: newQuantity,
        };

        data.size == "unique" ? (data.size = "os") : false;

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
                if (data.error) {
                    alert(data.error);
                } else {
                    location.reload();
                }
            })
            .catch((error) => {
                alert(error);
            });
    }
}

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
            location.reload();
        })
        .catch((error) => {
            console.log(error.message);
        });
}
