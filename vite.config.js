import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import { glob } from "glob";

const cssFiles = glob.sync("resources/css/**/*.{css,scss,less}");

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ["resources/js/app.js", ...cssFiles],
            refresh: [
                ...refreshPaths,
                "app/**/*",
                "resources/css/**/*.{css,scss,less}",
            ],
        }),
    ],
});
