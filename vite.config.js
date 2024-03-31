import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import VitePluginRequire from "vite-plugin-require";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/admin.css",
                "resources/css/home.css",
                "resources/js/admin.js",
                "resources/js/home.js",
            ],
            refresh: true,
        }),
         // VitePluginRequire.default(),
    ],
    resolve: {
        alias: {
            $: "jQuery",
        },
    },
});
