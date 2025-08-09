import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig(({ command, mode }) => {
    // Debug des variables pour Render
    console.log("🔍 Vite Build - Mode:", mode);
    console.log("🌍 Variables d'environnement:");
    console.log("  STRIPE_KEY présente:", !!process.env.STRIPE_KEY);
    console.log(
        "  STANDARD_DELIVERY_CHARGES:",
        process.env.STANDARD_DELIVERY_CHARGES
    );

    const isProduction = mode === "production";

    if (isProduction && !process.env.STRIPE_KEY) {
        console.warn("⚠️  STRIPE_KEY manquante en production");
    }

    return {
        plugins: [
            laravel({
                input: [
                    "resources/css/app/app.css",
                    "resources/css/app/navigation.css",
                    "resources/css/app/modals.css",
                    "resources/css/404.css",
                    "resources/css/products_list.css",
                    "resources/css/home.css",
                    "resources/css/product.css",
                    "resources/js/stripe/checkout.js",
                    "resources/js/app.js",
                    "resources/js/search.js",
                    "resources/js/home.js",
                    "resources/js/product.js",
                    "resources/js/basket.js",
                    "resources/js/bootstrap.js",
                    "resources/js/products-list.js",
                ],
                refresh: true,
            }),
        ],

        // Variables d'environnement pour JavaScript
        define: {
            "process.env.NODE_ENV": JSON.stringify(mode),
            "process.env.APP_DEBUG": JSON.stringify(
                process.env.APP_DEBUG === "true"
            ),
            "process.env.STRIPE_KEY": JSON.stringify(
                process.env.STRIPE_KEY || ""
            ),
            "process.env.STANDARD_DELIVERY_CHARGES": JSON.stringify(
                process.env.STANDARD_DELIVERY_CHARGES || "699"
            ),
        },

        // Configuration de build simplifiée
        build: {
            sourcemap: !isProduction,
            minify: isProduction,
        },

        // Résolution des modules
        resolve: {
            alias: {
                "@": "/resources/js",
                "@css": "/resources/css",
            },
        },
    };
});
