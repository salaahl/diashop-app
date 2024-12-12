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

document.querySelectorAll("main > section:nth-of-type(n+2)").forEach((ele) => {
    gsap.from(ele, {
        y: "25%",
        opacity: 0,
        duration: 0.4,
        scrollTrigger: {
            trigger: ele,
            start: "0% 75%",
        },
    });
});
