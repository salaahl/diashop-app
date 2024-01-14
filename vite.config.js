import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import EnvironmentPlugin from "vite-plugin-environment";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app/app.css",
                "resources/css/app/footer.css",
                "resources/css/app/navigation.css",
                "resources/css/404.css",
                "resources/css/basket.css",
                "resources/css/catalog.css",
                "resources/css/home.css",
                "resources/css/product.css",
                "resources/css/return.css",
                "resources/js/stripe/checkout.js",
                "resources/js/stripe/return.js",
                "resources/js/app.js",
                "resources/js/basket.js",
                "resources/js/bootstrap.js",
                "resources/js/catalog.js",
                "resources/js/home.js",
                "resources/js/product.js",
            ],
            refresh: true,
        }),
        EnvironmentPlugin("all", { prefix: "" }),
    ],
});
