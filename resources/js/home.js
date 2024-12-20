import { gsap, ScrollTrigger } from "gsap/all";

gsap.registerPlugin(ScrollTrigger);
gsap.config({
    trialWarn: true,
});
gsap.defaults({
    ease: "power1.out",
});

if (window.innerWidth > 768) {
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
