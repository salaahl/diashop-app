let $ = (id) => {
    return document.querySelector(id);
};
const popUp = $("#popup");
const popUpTimer = 5000;

let timer;

document.getElementById("search-form").addEventListener("change", function (e) {
    e.preventDefault();
    
    clearTimeout(timer);

    timer = setTimeout(function () {
        if ($("#default-search").value) {
            $("#search-results").innerHTML = "";
            document.getElementById("search-loader").classList.add("show");

            let data = {
                input: $("#default-search").value,
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
    }, 1000);
});

$("#more-results").addEventListener("click", () => {
    let catalog = $("#search-modal [name='catalog']:checked").value;
    let input = $("#default-search").value;

    window.location = "/search/" + catalog + "/" + input;
});
