const stripe = Stripe(process.env.STRIPE_KEY);

initialize();

async function initialize() {
    const response = await fetch("/checkout", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
        },
    });

    const { clientSecret } = await response.json();

    const checkout = await stripe.initEmbeddedCheckout({
        clientSecret,
    });

    // Mount Checkout
    checkout.mount("#checkout");
}
