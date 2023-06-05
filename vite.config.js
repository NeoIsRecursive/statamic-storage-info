import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: 'resources/dist',
            input: ['resources/js/main.ts'], // Specify the entry points...
        }),
    ],
});