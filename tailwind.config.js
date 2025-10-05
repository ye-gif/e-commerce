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
                'brown-dark': '#4B2E2E',   // header, nav bar, buttons
                'brown-medium': '#7B4B3A', // hover states, secondary buttons
                'brown-light': '#D9C4B1',  // backgrounds, cards, sections
                'cream': '#FFF8F0',         // text backgrounds, highlights
                'rust': '#C45A3C',          // buttons, call-to-action elements
                'gold': '#E6C384',          // subtle highlights, icons
                'text-dark': '#2B1B17',     // headings, primary text
                'text-gray': '#5C4A3D',     // secondary text
                'white': '#FFFFFF',          // text on dark brown buttons
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
