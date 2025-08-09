import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import EnvironmentPlugin from "vite-plugin-environment";

export default defineConfig({
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
        EnvironmentPlugin({
            VITE_TEST: process.env.VITE_TEST,
            APP_DEBUG: false,
            STRIPE_KEY: '',
            STANDARD_DELIVERY_CHARGES: 0,
        }),
    ],
});
