const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/.js",
        "./resources/*/.vue",
        // "./src/**/*.{html,js}",
        // "./node_modules/tw-elements/dist/js/**/*.js",
    ],

    theme: {
        extend: {
            backgroundImage: {
                'corps': "url('/public/img/fde.jpg')",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
