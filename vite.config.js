import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.js",
                "resources/sass/app.scss",
                "node_modules/@splidejs/vue-splide/dist/css/splide-core.min.css",
                "node_modules/@splidejs/vue-splide/dist/css/themes/splide-default.min.css",
            ],
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
