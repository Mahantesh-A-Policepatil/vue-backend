import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        // serve index.html for any 404 requests (SPA routing support)
        historyApiFallback: true,

        // proxy API requests to the Laravel server when running via Vite
        proxy: {
            // forward '/api/*' to the backend on port 8000
            '/api': {
                target: 'http://127.0.0.1:8000',
                changeOrigin: true,
                secure: false,
            },
        },
    },
});
