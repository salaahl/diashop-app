let $ = (id) => {
    return document.querySelector(id);
};

// Effet de translate en mode mobile pour notifier à l'utilisateur qu'il peut swipe
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
        }, 1000);
    }
});

function magnify(imgID, zoom) {
  let img, glass, w, h, bw;
  img = document.getElementById(imgID);
    console.log(img.width)

  /* Create magnifier glass: */
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");

  /* Insert magnifier glass: */
  img.parentElement.insertBefore(glass, img);

  /* Set background properties for the magnifier glass: */
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;

  /* Execute a function when someone moves the magnifier glass over the image: */
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);

  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    let pos, x, y;
    /* Prevent any other actions that may occur when moving over the image */
    e.preventDefault();
    /* Get the cursor's x and y positions: */
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /* Prevent the magnifier glass from being positioned outside the image: */
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /* Set the position of the magnifier glass: */
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /* Display what the magnifier glass "sees": */
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }

  function getCursorPos(e) {
    let a, x = 0, y = 0;
    e = e || window.event;
    /* Get the x and y positions of the image: */
    a = img.getBoundingClientRect();
    /* Calculate the cursor's x and y coordinates, relative to the image: */
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /* Consider any page scrolling: */
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}

document.querySelectorAll(".product-img").forEach((img) => {
    img.addEventListener("click", function () {
        document.querySelector('#modal-image').src = this.src;
        magnify("modal-image", 2);
    });
});

let url = window.location.href;

document.querySelectorAll(".radio_label").forEach((radio) => {
    radio.addEventListener("click", function () {
        let data = {
            size: this.previousElementSibling.value.toLowerCase(),
            product_id: url.split("/").pop(),
        };

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
