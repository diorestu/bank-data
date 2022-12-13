import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        },
    },
    build: {
        // manifest: true,
        outDir: "public/build",
        rollupOptions: {
            input: ["resources/sass/app.scss", "resources/js/app.js"],
        },
    },
});
