const stripe = Stripe(process.env.STRIPE_KEY);

initialize();

async function initialize() {
    try {
        const clientSecret = document.getElementById('#clientSecret').value;
        const checkout = await stripe.initEmbeddedCheckout({
            clientSecret,
        });

        // Mount Checkout
        checkout.mount("#checkout");
    } catch (e) {
        alert("Erreur lors du chargement de votre panier. Veuillez réessayer.");
        window.location.href = "/";
    }
}
