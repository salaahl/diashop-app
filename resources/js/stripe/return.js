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
        document.getElementById("success").classList.remove("hidden");
        document.getElementById("customer-email").textContent =
            session.customer_email;
    }
}
