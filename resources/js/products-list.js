import { gsap, ScrollTrigger } from "gsap/all";

// Enregistrement des plugins
gsap.registerPlugin(ScrollTrigger);

// Configuration globale de GSAP
gsap.config({
    trialWarn: true, // Affiche un avertissement si un plug-in payant est utilisé
});
gsap.defaults({ ease: "power1.out" });

if (document.querySelector("#categories")) {
    gsap.from(".category", {
        x: -50,
        opacity: 0,
        duration: 0.4,
        delay: 0.8,
        stagger: 0.2,
    });

    // Boutons de défilement des catégories
    if (window.innerWidth > 767) {
        const scrollableDiv =
            document.querySelector(".scroll-controls").nextElementSibling;
        const scrollLeftButton = document.querySelector(
            ".scroll-controls > .scroll-left"
        );
        const scrollRightButton = document.querySelector(
            ".scroll-controls > .scroll-right"
        );

        const updateButtons = () => {
            // La marge de 20px est ajoutée pour éviter les erreurs de calcul liées aux marges
            if (scrollableDiv.scrollLeft < 20) {
                scrollLeftButton.classList.add("hide");
            } else {
                scrollLeftButton.classList.remove("hide");
            }

            if (
                scrollableDiv.scrollLeft + 20 + scrollableDiv.clientWidth >=
                scrollableDiv.scrollWidth
            ) {
                scrollRightButton.classList.add("hide");
            } else {
                scrollRightButton.classList.remove("hide");
            }
        };

        scrollLeftButton.addEventListener("click", () => {
            scrollableDiv.scrollBy({ left: -300, behavior: "smooth" });
        });

        scrollRightButton.addEventListener("click", () => {
            scrollableDiv.scrollBy({ left: 300, behavior: "smooth" });
        });

        scrollableDiv.addEventListener("scroll", updateButtons);

        updateButtons();
    }
}

const products =
    window.innerWidth < 768
        ? gsap.utils.toArray(".product:nth-of-type(n+3)")
        : gsap.utils.toArray(".product:nth-of-type(n+4)");

products.forEach((product) => {
    gsap.from(product, {
        pointerEvents: "none",
        y: "25%",
        opacity: 0,
        duration: window.innerWidth < 768 ? 0.35 : 0.5,
        scrollTrigger: {
            trigger: product,
            start: window.innerWidth < 768 ? "0% 75%" : "0% 100%",
        },
    });
});

// Filtres
if (document.querySelector("#filters-form")) {
    document.querySelector("#filters-form").addEventListener("change", function () {
        this.submit();
    });
}
