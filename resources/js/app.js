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
    let layers = document.querySelectorAll(".right-layer");
    for (const layer of layers) {
        layer.classList.remove("show");
    }
    document.querySelector("#loader-container").classList.remove("show");
});

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
        var layers = document.querySelectorAll(".left-layer");
        document.querySelector("#loader-container").classList.add("show");

        for (const layer of layers) {
            layer.classList.remove("show");
        }

        // Attendre la fin de l'animation avant de naviguer
        setTimeout(function () {
            window.location.href = link.href;
        }, 1000); // 500ms ou la durée de ton animation
    });
});
