import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig(({ command, mode }) => {
    // Debug des variables pour Render
    console.log("🔍 Vite Build - Mode:", mode, "Command:", command);
    console.log("🌍 Variables d'environnement disponibles:");
    console.log("  NODE_ENV:", process.env.NODE_ENV);
    console.log("  APP_DEBUG:", process.env.APP_DEBUG);
    console.log("  STRIPE_KEY présente:", !!process.env.STRIPE_KEY);
    console.log(
        "  STRIPE_KEY preview:",
        process.env.STRIPE_KEY
            ? process.env.STRIPE_KEY.substring(0, 10) + "***"
            : "❌ UNDEFINED"
    );
    console.log(
        "  STANDARD_DELIVERY_CHARGES:",
        process.env.STANDARD_DELIVERY_CHARGES
    );

    // Vérification critique pour la production
    const isProduction =
        mode === "production" || process.env.NODE_ENV === "production";

    if (isProduction && !process.env.STRIPE_KEY) {
        console.error("❌ ERREUR CRITIQUE: STRIPE_KEY manquante en production");
        console.error(
            "👉 Vérifiez les Environment Variables dans Render Dashboard"
        );
        console.error(
            "👉 Variables disponibles:",
            Object.keys(process.env).filter((k) => k.includes("STRIPE"))
        );
        // Ne pas faire échouer le build, mais avertir
        console.warn(
            "⚠️  Continuing build without STRIPE_KEY - app may not function correctly"
        );
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

        // Définir les variables d'environnement pour le JavaScript
        define: {
            // Variables d'environnement standard
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

            // Variables supplémentaires utiles
            __APP_VERSION__: JSON.stringify(
                process.env.npm_package_version || "1.0.0"
            ),
            __BUILD_TIME__: JSON.stringify(new Date().toISOString()),
            __IS_PRODUCTION__: JSON.stringify(isProduction),
        },

        // Configuration de build pour Render
        build: {
            // Source maps pour debug en développement
            sourcemap: !isProduction,

            // Optimisations pour production
            minify: isProduction ? "esbuild" : false,

            // Configuration des chunks pour de meilleures performances
            rollupOptions: {
                output: {
                    // Noms de fichiers optimisés pour le cache
                    entryFileNames: isProduction
                        ? "assets/[name]-[hash].js"
                        : "assets/[name].js",
                    chunkFileNames: isProduction
                        ? "assets/[name]-[hash].js"
                        : "assets/[name].js",
                    assetFileNames: isProduction
                        ? "assets/[name]-[hash].[ext]"
                        : "assets/[name].[ext]",

                    // Séparation des vendor chunks
                    manualChunks: isProduction
                        ? {
                              vendor: ["stripe"],
                              utils: ["lodash", "axios"],
                          }
                        : undefined,
                },
            },

            // Taille limite des chunks
            chunkSizeWarningLimit: 1000,
        },

        // Configuration du serveur de développement
        server: {
            host: true,
            port: 3000,
            hmr: {
                host: "localhost",
            },
        },

        // Résolution des modules
        resolve: {
            alias: {
                "@": "/resources/js",
                "@css": "/resources/css",
            },
        },

        // Variables d'environnement avec préfixes (alternative)
        envPrefix: ["VITE_", "APP_", "STRIPE_", "STANDARD_"],

        // Configuration CSS
        css: {
            devSourcemap: !isProduction,
            preprocessorOptions: {
                scss: {
                    additionalData: `$env: "${mode}";`,
                },
            },
        },

        // Plugin personnalisé pour debug post-build
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

            // Plugin personnalisé pour debug et vérification
            {
                name: "render-environment-check",
                buildStart() {
                    console.log("🚀 Build démarré pour Render");
                },
                buildEnd() {
                    console.log("✅ Build terminé");
                    console.log("📊 Variables injectées dans le bundle:");
                    console.log(
                        "  STRIPE_KEY:",
                        process.env.STRIPE_KEY ? "✅ INJECTÉE" : "❌ MANQUANTE"
                    );
                    console.log(
                        "  DELIVERY_CHARGES:",
                        process.env.STANDARD_DELIVERY_CHARGES || "DÉFAUT (699)"
                    );
                },
                generateBundle(options, bundle) {
                    // Vérifier que les variables sont dans le bundle
                    const jsFiles = Object.keys(bundle).filter((key) =>
                        key.endsWith(".js")
                    );
                    let hasStripeKey = false;

                    jsFiles.forEach((file) => {
                        if (
                            bundle[file].code &&
                            bundle[file].code.includes("STRIPE_KEY")
                        ) {
                            hasStripeKey = true;
                        }
                    });

                    console.log(
                        hasStripeKey
                            ? "✅ STRIPE_KEY trouvée dans le bundle JS"
                            : "❌ STRIPE_KEY absente du bundle JS"
                    );
                },
            },
        ],
    };
});
