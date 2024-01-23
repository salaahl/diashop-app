import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.scrollY;
window.onscroll = function() {
    var currentScrollPos = window.scrollY;
    if (prevScrollpos > currentScrollPos) {
        document.querySelector("header").style.top = "0%";
    } else {
        document.querySelector("header").style.top = "-10%";
    }
    prevScrollpos = currentScrollPos;
}

// Loader des pages
window.addEventListener("load", () => {
    document.querySelector("#loader-container").style.display = "none";
    document.querySelector(".main-container").style.opacity = "1";
});
