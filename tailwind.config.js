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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                indigo: {
                  50: '#effbff',
                  100: '#beeffc',
                  200: '#aadff8',
                  300: '#81cae0',
                  400: '#2db3d4',
                  500: '#2db3d4',
                  600: '#2db3d4',
                  700: '#2db3d4',
                  800: '#2db3d4',
                  900: '#2db3d4',
                }
            },
        },
    },

    plugins: [forms],
};
