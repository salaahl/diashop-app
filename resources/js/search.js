let $ = (id) => {
    return document.querySelector(id);
};
const popUp = $("#popup");
const popUpTimer = 5000;

let timer;

const searchProducts = () => {
    clearTimeout(timer);

    timer = setTimeout(function () {
        if ($("#search-input").value.length > 2) {
            $("#search-results").innerHTML = "";
            document.getElementById("search-loader").classList.add("show");

            let data = {
                input: $("#search-input").value,
                catalog: $("#search-modal [name='catalog']:checked").value,
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
                    if (data.results && data.results.length > 0) {
                        data.results.forEach((product) => {
                            $("#search-results").innerHTML +=
                                '<article class="product">' +
                                '<a href="/' +
                                "catalog/" +
                                $("#search-modal [name='catalog']:checked")
                                    .value +
                                "/" +
                                product["category"] +
                                "/" +
                                product["id"] +
                                '">' +
                                '<div class="thumbnail">' +
                                '<img src="https://res.cloudinary.com/dq8yfrr3w/image/upload/v1/' +
                                product["img"][0] +
                                '" />' +
                                '<img src="https://res.cloudinary.com/dq8yfrr3w/image/upload/v1/' +
                                product["img"][1] +
                                '" />' +
                                "</div>" +
                                '<div class="details lg:flex justify-between px-1 py-2 mt-1">' +
                                '<div class="w-full flex flex-wrap items-baseline justify-between">' +
                                '<h4 class="title lg:max-w-[75%] text-ellipsis overflow-hidden">' +
                                product["name"] +
                                "</h4>" +
                                '<div class="flex items-center">' +
                                '<span class="message text-sm font-thin text-red-500">' +
                                product["message"] +
                                "</span>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</a>" +
                                "</article>";
                        });
                        $("#more-results").classList.add("show");
                    } else {
                        $("#more-results").classList.remove("show");
                        $("#search-results").innerHTML =
                            "<span class='mt-16 mx-auto'>AUCUN RESULTAT</span>";
                    }

                    document
                        .getElementById("search-loader")
                        .classList.remove("show");
                })
                .catch((error) => {
                    console.log(error.message);
                });
        } else {
            $("#more-results").classList.remove("show");
            $("#search-results").innerHTML = "";
        }
    }, 500);
};

// Désactive la fonction submit du formulaire
document.getElementById("search-form").addEventListener("submit", function (e) {
    e.preventDefault();
});

// EventListener sur les inputs pour lancer la recherche dynamiquement
document
    .querySelectorAll("#search-modal [name='catalog']")
    .forEach((catalog) => {
        catalog.addEventListener("change", function () {
            searchProducts();
        });
    });

document.getElementById("search-input").addEventListener("input", function () {
    searchProducts();
});

$("#more-results").addEventListener("click", () => {
    let catalog = $("#search-modal [name='catalog']:checked").value;
    let input = $("#search-input").value;

    window.location = "/search/" + catalog + "/" + input;
});
