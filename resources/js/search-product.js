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
            $("#search-results").innerHTML = "";
            document.getElementById("lds-hourglass").classList.add("show");

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
                    if (data.results != "") {
                        data.results.forEach((product) => {
                            $("#search-results").innerHTML +=
                                '<article class="product">' +
                                '<a href="/' +
                                "catalog/" +
                                $("#search-container [name='catalog']:checked")
                                    .value +
                                "/" +
                                product["category"] +
                                "/" +
                                product["id"] +
                                '">' +
                                '<div class="thumbnail">' +
                                '<img src="' +
                                product["img"][0] +
                                '" />' +
                                '<img src="' +
                                product["img"][1] +
                                '" />' +
                                "</div>" +
                                '<div class="details lg:flex justify-between px-1 py-2 mt-1">' +
                                '<div class="w-full flex flex-wrap items-baseline justify-between">' +
                                '<h4 class="title lg:max-w-[75%] text-ellipsis overflow-hidden">' +
                                product["name"] +
                                "</h4>" +
                                '<div class="flex items-center">' +
                                '<span class="message text-sm font-thin text-red-500">' + product["message"] + '</span>' +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</a>" +
                                "</article>";
                        });
                    } else {
                        $("#search-results").innerHTML = "AUCUN RESULTAT";
                    }

                    document
                        .getElementById("lds-hourglass")
                        .classList.remove("show");
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
