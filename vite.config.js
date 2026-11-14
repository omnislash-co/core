import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { local } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            fonts: [
                local('Oswald Stencil', {
                    alias: 'oswald-stencil',
                    src: 'resources/fonts/oswald-stencil.ttf',
                }),
                local('Altima', {
                    alias: 'altima',
                    src: 'resources/fonts/altima.woff',
                }),
            ],
        }),
    ],
});