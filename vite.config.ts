import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
            ssr: "resources/js/ssr.ts",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            reactivityTransform: true
        }),
    ],
    resolve: {
        alias: {
            '@ziggy': 'vendor/tightenco/ziggy/dist'
        }
    },
    build: {
        rollupOptions: {
            external: "./compiledZiggy.mjs"
        }
    },
});
