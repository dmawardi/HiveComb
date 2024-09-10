import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        https: true, // Ensure Vite's development server uses HTTPS
        hmr: {
            host: "localhost",
        },
    },
});
