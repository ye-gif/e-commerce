import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Define your custom brand colors here
                'brand-light': '#6B4226', // Used for main accent, button, links
                'brand-dark': '#4E2C1A',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
