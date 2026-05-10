import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                BSAPri: '#ff8800',
                BSASec: '#232323',
            },

            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
        },
    },

    plugins: [],
}