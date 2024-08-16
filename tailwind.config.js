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
                  50: '#EFF6FF',
                  100: '#DBEAFE',
                  200: '#BFDBFE',
                  300: '#93C5FD',
                  400: '#60A5FA',
                  500: '#3B82F6',
                  600: '#22d3ee',
                  700: '#158394',
                  800: '#1E40AF',
                  900: '#1E3A8A',
                }
            },
        },
    },

    plugins: [forms],
};
