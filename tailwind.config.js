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
                secondary_button:'#B38F6F',
                body:'#E8DED6',//white coffee
                hero:'#7E2625',//bow
                category:'#292F17',//juniper
                text: '#F1ECD8', //candle
                product_cards:'#9A8670',//Product cards → Beaver (#9A8670) background + Coffee (#795434) buttons
                hover:'#4f1818ff', //crimson depth
                midnight: '#3a050fff',
                button:'#795434', //coffee
                navigation:'#2C261E',
                hover1:'#4D1514',
                section:'#9A8670 ',
                hover1:'#816344ff',
                headings:'#5A3D29',//van dyke
                footer:'#2C261E', //obsidian black
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
