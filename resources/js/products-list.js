import { gsap, ScrollTrigger } from "gsap/all";

// Enregistrement des plugins
gsap.registerPlugin(ScrollTrigger);

// Configuration globale de GSAP
gsap.config({
    trialWarn: true, // Affiche un avertissement si un plug-in payant est utilisé
});
gsap.defaults({ ease: "power1.out" });

gsap.from(".category", {
    x: -50,
    opacity: 0,
    duration: 0.4,
    delay: 0.8,
    stagger: 0.2,
});

// Boutons de défilement des catégories
if (window.innerWidth > 768) {
    const scrollableDiv =
        document.querySelector(".scroll-controls").nextElementSibling;
    const scrollLeftButton = document.querySelector(
        ".scroll-controls > .scroll-left"
    );
    const scrollRightButton = document.querySelector(
        ".scroll-controls > .scroll-right"
    );

    const updateButtons = () => {
        if (scrollableDiv.scrollLeft < 20) {
            scrollLeftButton.classList.add("hide");
        } else {
            scrollLeftButton.classList.remove("hide");
        }

        if (
            scrollableDiv.scrollLeft + scrollableDiv.clientWidth >=
            scrollableDiv.scrollWidth
        ) {
            scrollRightButton.classList.add("hide");
        } else {
            scrollRightButton.classList.remove("hide");
        }
    };

    scrollLeftButton.addEventListener("click", () => {
        scrollableDiv.scrollBy({ left: -100, behavior: "smooth" });
    });

    scrollRightButton.addEventListener("click", () => {
        scrollableDiv.scrollBy({ left: 100, behavior: "smooth" });
    });

    scrollableDiv.addEventListener("scroll", updateButtons);

    updateButtons();
}

const products =
    window.innerWidth < 768
        ? gsap.utils.toArray(".product:nth-of-type(n+3)")
        : gsap.utils.toArray(".product:nth-of-type(n+4)");

products.forEach((product) => {
    gsap.from(product, {
        pointerEvents: "none",
        y: "25%",
        duration: window.innerWidth < 768 ? 0.35 : 0.5,
        scrollTrigger: {
            trigger: product,
            start: window.innerWidth < 768 ? "0% 75%" : "0% 100%",
        },
    });
});

// Filtres
// Je m'assure que le code ne s'exécute pas sur la page de recherche (qui utilise le même fichier JS)
if (
    window.location.pathname
        .split("/")
        .filter((segment) => segment !== "")[0] !== "search"
) {
    document.getElementById("filter_select").addEventListener("change", () => {
        let myform = document.createElement("form");
        myform.action = "";
        myform.method = "post";

        let filter = document.createElement("input");
        filter.value = document.getElementById("filter_select").value;
        filter.name = "filter";

        let token = document.createElement("input");
        token.value = document
            .querySelector('[name="csrf-token"]')
            .getAttribute("content");
        token.name = "_token";

        myform.appendChild(filter);
        myform.appendChild(token);

        document.body.appendChild(myform);
        myform.submit();
    });
}
