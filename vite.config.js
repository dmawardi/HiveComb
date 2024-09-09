import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        https: {
            key: fs.readFileSync(
                path.resolve(__dirname, "certs/localhost-key.pem")
            ),
            cert: fs.readFileSync(
                path.resolve(__dirname, "certs/localhost.pem")
            ),
        },
        hmr: {
            host: "localhost",
        },
    },
});
