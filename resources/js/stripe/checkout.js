const stripe = Stripe(import.meta.env.VITE_STRIPE_KEY);

initialize();

async function initialize() {
    try {
        const clientSecret = document.getElementById("clientSecret").value;
        const checkout = await stripe.initEmbeddedCheckout({
            clientSecret,
        });

        // Mount Checkout
        checkout.mount("#checkout");
    } catch (e) {
        alert("Erreur lors du chargement de la page. Veuillez réessayer.");
        window.location.href = "/";
    }
}
