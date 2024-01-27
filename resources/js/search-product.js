document.querySelector("#search-btn").addEventListener("click", (e) => {
    document.querySelector("#search-container").classList.add("show");
    document.querySelector("#search-container").classList.remove("hide");
});

document.querySelector("#close-search-btn").addEventListener("click", (e) => {
    document.querySelector("#search-container").classList.add("hide");
    document.querySelector("#search-container").classList.remove("show");
});

let timer;

document.querySelector("#default-search").addEventListener("input", (e) => {
    e.preventDefault();

    clearTimeout(timer);

    let $ = (id) => {
        return document.querySelector(id);
    };

    timer = setTimeout(function () {
        if ($("#default-search").value.length > 0) {
            $("#search-results").innerHTML = "";

            let data = {
                input: $("#default-search").value,
                catalog_id: $("#search-container input:checked").value,
            };

            const request = new Request("/search", {
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
                    if (data.products != "") {
                        data.products.forEach((product) => {
                            let gender =
                                product.gender == "femme" ? "woman" : "men";

                            let names = product.name
                                .replace(/[[\]\"]/g, "")
                                .split(",", 2);

                            let thumbnails = product.img_thumbnail
                                .replace(/[ [\]\"]/g, "")
                                .split(",", 2);
                            console.log(product);
                            $("#search-results").innerHTML +=
                                '<article class="product">' +
                                '<a href="/' +
                                gender +
                                "/catalog/" +
                                names[0] +
                                "/" +
                                product.id +
                                '">' +
                                '<div class="thumbnail">' +
                                '<img src="/images/' +
                                thumbnails[0] +
                                '" />' +
                                '<img src="/images/' +
                                thumbnails[1] +
                                '" />' +
                                "</div>" +
                                '<div class="details">' +
                                '<h4 class="title">' +
                                names[1] +
                                "</h4>" +
                                '<div class="price">' +
                                product.price +
                                "</div>" +
                                "</div>" +
                                "</a>" +
                                "</article>";
                        });
                    } else {
                        $("#search-results").innerHTML = "Aucun résultat";
                    }
                })
                .catch((error) => {
                    console.log(error.message);
                });
        } else {
            $("#search-results").innerHTML = "";
        }
    }, 600);
});
