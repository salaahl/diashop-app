let $ = (id) => {
    return document.querySelector(id);
};

$("#search-btn").addEventListener("click", (e) => {
    $("#search-container").classList.add("show");
    $("#search-container").classList.remove("hide");
});

$("#close-search-btn").addEventListener("click", (e) => {
    $("#search-container").classList.add("hide");
    $("#search-container").classList.remove("show");
});

let timer;

$("#default-search").addEventListener("input", (e) => {
    e.preventDefault();

    clearTimeout(timer);

    timer = setTimeout(function () {
        if ($("#default-search").value.length > 0) {
            let hourglass = document.getElementById('lds-hourglass');
            $("#search-results").innerHTML = "";
            hourglass.style.display = 'flex';

            let data = {
                input: $("#default-search").value,
                catalog: $("#search-container [name='catalog']:checked").value,
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
                    hourglass.style.display = 'none';
                    if (data.results != "") {
                        data.results.forEach((product) => {
                            $("#search-results").innerHTML +=
                                '<article class="product">' +
                                '<a href="/' +
                                "catalog/" +
                                product["gender"] +
                                "/" +
                                product["category"] +
                                "/" +
                                product["id"] +
                                '">' +
                                '<div class="thumbnail">' +
                                '<img src="/images/' +
                                product["img_thumbnail"][0] +
                                '" />' +
                                '<img src="/images/' +
                                product["img_thumbnail"][1] +
                                '" />' +
                                "</div>" +
                                '<div class="details">' +
                                '<h4 class="title">' +
                                product["name"] +
                                "</h4>" +
                                '<div class="price">' +
                                product["price"] +
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
    }, 1000);
});

$("#default-search-btn").addEventListener("click", () => {
    let catalog = $("#search-container [name='catalog']:checked").value;
    let input = $("#default-search").value;

    window.location = "/search/" + catalog + "/" + input;
});
