import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    //FOR OTHER DEVICES TEST ONLY
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173,
    //     hmr: {
    //         host: '192.168.8.37', // 👈 CHANGE THIS to your Mac IP
    //     },
    // },

});
