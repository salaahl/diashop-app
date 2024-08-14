import "./bootstrap";
import Alpine from "alpinejs";
import * as Turbo from "@hotwired/turbo";

window.Alpine = Alpine;

Alpine.start();
Turbo.start();

let navigationDelay = 800;

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

let isNavigating = false; // Variable de contrôle pour éviter la boucle

document.addEventListener("turbo:before-visit", (event) => {
    // Évitez de lancer la logique si une navigation est déjà en cours
    if (isNavigating) {
        return;
    }

    // Définir la variable de contrôle pour indiquer qu'une navigation est en cours
    isNavigating = true;

    // Obtenez l'URL du lien
    const link = event.detail.url;

    // Vérifiez les conditions pour éviter la navigation par Turbo
    const isExternal = new URL(link).hostname !== window.location.hostname;
    const isSpecialProtocol =
        link.startsWith("mailto:") || link.startsWith("tel:");

    if (isExternal || isSpecialProtocol) {
        // Si le lien est externe ou utilise un protocole spécial, laissez Turbo gérer normalement
        isNavigating = false; // Réinitialiser la variable de contrôle
        return;
    }

    // Prévenir la navigation pour ajouter un délai
    event.preventDefault();

    // Montrer le loader ou autre animation
    var layers = document.querySelectorAll(".left-layer");

    for (const layer of layers) {
        layer.classList.remove("show");
    }

    document.querySelector("#loader-container").classList.add("show");

    // Attendre la fin du délai avant de naviguer
    setTimeout(() => {
        Turbo.visit(link);
    }, navigationDelay);

    // Réinitialiser la variable de contrôle après le délai
    setTimeout(() => {
        isNavigating = false;
    }, navigationDelay);
});

// Loader des pages
window.addEventListener("turbo:load", () => {
    // Empêche que le CSS d'une page empiète sur les autres
        const lastCSS = document.querySelector('link[rel="stylesheet"]:last-of-type');
        lastCSS.setAttribute('data-turbo-track', 'dynamic');

    // Lorsque la page est vraiment chargée (car turbo:load est en fait un DOMContentLoader)
    window.addEventListener("load", () => {
        // Effacer le loader
        let layers = document.querySelectorAll(".right-layer");
    
        for (const layer of layers) {
            layer.classList.remove("show");
        }
    
        document.querySelector("#loader-container").classList.remove("show");
    
        // Gestions des liens hors Turbo
        document.querySelectorAll("a[data-turbo='false']").forEach(function (link) {
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
                }, navigationDelay);
            });
        });
    });
});
