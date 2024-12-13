import { gsap, ScrollTrigger } from "gsap/all";

// Enregistrement des plugins
gsap.registerPlugin(ScrollTrigger);

// Configuration globale de GSAP
gsap.config({
    trialWarn: true, // Affiche un avertissement si un plug-in payant est utilisé
});
gsap.defaults({ ease: "power1.out" });

// Filtres
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

gsap.from([".catalog-name",".category"], {
    x: -50,
    opacity: 0,
    duration: 0.4,
    delay: 0.8,
    stagger: 0.2,
});

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
