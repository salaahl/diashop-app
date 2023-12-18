import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import EnvironmentPlugin from "vite-plugin-environment";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/*.css",
                "resources/css/app/*.css",
                "resources/js/*.js",
            ],
            refresh: true,
        }),
        EnvironmentPlugin("all", { prefix: "" }),
    ],
});
