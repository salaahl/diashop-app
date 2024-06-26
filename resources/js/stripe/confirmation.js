let $ = (id) => {
    return document.querySelector(id);
};

initialize();

async function initialize() {
    const sessionId = window.location.pathname.split("/").pop();
    const response = await fetch("/status", {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        method: "POST",
        body: JSON.stringify({ session_id: sessionId }),
    });
    const session = await response.json();

    if (session.status == "open") {
        window.replace("/checkout");
    } else if (session.status == "complete") {
        const timeElapsed = Date.now();
        const today = new Date(timeElapsed);
        const shipping_date_start = today.toLocaleDateString();

        let customer_details = session.customer_details;
        let shipping_details = session.shipping_details;
        let amount_total = session.amount_total;
        let shipping_cost = session.shipping_cost;

        document.getElementById("success").classList.remove("hidden");
        document.getElementById("customer-name").textContent =
            customer_details.name;

        document.getElementById("command-number").textContent =
            session.command_number;
        document.getElementById("command-date").textContent =
            today.toLocaleDateString();

        if (shipping_cost == 1000) {
            const shipping_express = today.setDate(today.getDate() + 2);
            let shipping_div = $("#shipping-express .shipping-date");
            shipping_div.closest("ul").classList.remove("hidden");

            shipping_div.textContent =
                "Entre le " +
                shipping_date_start +
                " et le " +
                today.toLocaleDateString();
        } else {
            const shipping_stantard = today.setDate(today.getDate() + 5);
            let shipping_div = $("#shipping-standard .shipping-date");
            shipping_div.closest("ul").classList.remove("hidden");

            shipping_div.textContent =
                "Entre le " +
                shipping_date_start +
                " et le " +
                today.toLocaleDateString();
        }

        $("#billing-line1").textContent = customer_details.address["line1"];
        $("#billing-line2").textContent = customer_details.address["line2"];
        $("#billing-postal_code").textContent =
            customer_details.address["postal_code"];
        $("#billing-city").textContent = customer_details.address["city"];
        $("#billing-country").textContent = customer_details.address["country"];

        $("#shipping-line1").textContent = shipping_details.address["line1"];
        $("#shipping-line2").textContent = shipping_details.address["line2"];
        $("#shipping-postal_code").textContent =
            shipping_details.address["postal_code"];
        $("#shipping-city").textContent = shipping_details.address["city"];
        $("#shipping-country").textContent =
            shipping_details.address["country"];

        document.getElementById("shipping-cost").textContent =
            shipping_cost.amount_total / 100 + "€";

        document.getElementById("amount-total").textContent =
            amount_total / 100 + "€";
    }
}
