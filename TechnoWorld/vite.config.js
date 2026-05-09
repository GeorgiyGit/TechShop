import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/signup.css', 'resources/css/login.css', 'resources/css/products.css', 'resources/css/home.css', 'resources/css/cart.css', 'resources/css/create-order.css', 'resources/css/order.css', 'resources/css/admin.css', 'resources/css/account.css', 'resources/js/products.js', 'resources/js/product-gallery.js', 'resources/js/admin-category-form.js', 'resources/js/admin-product-form.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
