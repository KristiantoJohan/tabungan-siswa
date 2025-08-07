import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/sbadmin/sb-admin-2.min.css',
                'resources/js/sbadmin/sb-admin-2.min.js',
            ],
            refresh: true,
        }),
    ],
});
