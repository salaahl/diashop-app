import { gsap, ScrollTrigger } from "gsap/all";

gsap.registerPlugin(ScrollTrigger);
gsap.config({
    trialWarn: true,
});
gsap.defaults({
    ease: "power1.out",
});

// Redimensionnement des images de catalogue
if (window.innerWidth > 767) {
    document
        .querySelectorAll("#catalogs-container .catalog .img-placeholder")
        .forEach((ele) => {
            ele.style.backgroundSize =
                document.querySelector("#catalogs-container .catalog")
                    .offsetWidth +
                document.querySelector("#catalogs-container .catalog")
                    .offsetWidth /
                    5 +
                "px";
        });
}

// Animation des différentes sections
document
    .querySelectorAll(
        window.innerWidth < 768
            ? "main > section:nth-of-type(n+2)"
            : "main > section:nth-of-type(n+3)"
    )
    .forEach((ele) => {
        gsap.from(ele, {
            y: window.innerWidth < 768 ? "15%" : "250",
            opacity: window.innerWidth < 768 ? 0 : 1,
            duration: 0.4,
            scrollTrigger: {
                trigger: ele,
                start: window.innerWidth < 768 ? "0 85%" : "0 100%",
            },
        });
    });

// Boutons de défilement des catégories
if (window.innerWidth > 767) {
    const scrollableDiv =
        document.querySelector(".scroll-controls").parentElement;
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
