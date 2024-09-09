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
        https: {
            key: fs.readFileSync("/etc/ssl/caddy/localhost-key.pem"), // Update to match the mounted path
            cert: fs.readFileSync("/etc/ssl/caddy/localhost.pem"),
        },
        hmr: {
            host: "localhost",
        },
    },
});
