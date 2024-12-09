import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

/*
Retracte la barre de navigation en mode desktop
if (window.innerWidth > 1023) {
    var prevScrollpos = window.scrollY;
    window.onscroll = function () {
        var currentScrollPos = window.scrollY;
        if (prevScrollpos > currentScrollPos) {
            document.querySelector("header").style.top = "0";
        } else {
            document.querySelector("header").style.top = "-80px";
        }
        prevScrollpos = currentScrollPos;
    };
}
*/

// Redimentionne dynamiquement la hauteur de la fenêtre. Permet de corriger le souci de viewheight en mode mobile
function resetHeight() {
    // reset the body height to that of the inner browser
    document.body.style.height = window.innerHeight + "px";
}
// reset the height whenever the window's resized
window.addEventListener("resize", resetHeight);
// called to initially set the height.
resetHeight();

// Loader des pages
window.addEventListener("load", () => {
    // Gère l'affichage du loader
    document.querySelector("#loader-container").classList.add("close");

    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (event) {
            const isExternal = link.hostname !== window.location.hostname;
            const isNewTab = link.target === "_blank";
            const isSpecialProtocol =
                link.href.startsWith("mailto:") || link.href.startsWith("tel:");

            if (isExternal || isNewTab || isSpecialProtocol) {
                return; // Ne pas lancer l'animation
            }

            event.preventDefault();

            document
                .querySelector("#loader-container")
                .classList.remove("close");

            setTimeout(function () {
                window.location.href = link.href;
            }, 500);
        });
    });

    // Gestiiion des menus déroulants de la barre de navigation en mode mobile
    const dropdownButtons = document.querySelectorAll(".dropdownNavbarBtn");

    dropdownButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Fermer les autres menus déroulants
            dropdownButtons.forEach((button) => {
                if (
                    button !== this &&
                    button.getAttribute("aria-expanded") === "true"
                ) {
                    button.setAttribute("aria-expanded", "false");
                }
            });
        });
    });

    // Fermer les menus lorsqu'on clique en dehors
    document.addEventListener("click", function (event) {
        const isClickInside = event.target.closest(".has-dropdown");
        if (!isClickInside) {
            document.querySelectorAll(".dropdownNavbar").forEach((dropdown) => {
                dropdown.classList.add("hidden");
            });
        }
    });
});

// Affichage du menu déroulant de la barre de navigation en mode mobile
const button = document.getElementById("navbar-dropdown-btn");
const navbar = document.getElementById("navbar-container");

button.addEventListener("click", function () {
    // Basculer l'état aria-expanded
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !isExpanded); // Inverse l'état
    navbar.classList.toggle("show-navbar-dropdown", !isExpanded); // Affiche ou cache le contenu
});
