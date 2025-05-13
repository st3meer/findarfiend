import Components from 'unplugin-vue-components/vite'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Vuetify, { transformAssetUrls } from 'vite-plugin-vuetify'
import ViteFonts from 'unplugin-fonts/vite'
import VueRouter from 'unplugin-vue-router/vite'
import mkcert from 'vite-plugin-mkcert'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
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
        Vuetify({
            autoImport: true,
            styles: {
              configFile: 'src/styles/settings.scss',
            },
          }),
        Components(),
        ViteFonts({
        google: {
            families: [{
            name: 'Roboto',
            styles: 'wght@100;300;400;500;700;900',
            }],
        },
        }),
        VueRouter(),
    ],
});
