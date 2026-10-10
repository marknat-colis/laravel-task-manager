import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: { sans: ['Figtree', ...defaultTheme.fontFamily.sans] },
            colors: {
                ink: '#17243c',
                brand: { 50:'#eef5ff', 100:'#dceaff', 200:'#bbd6ff', 500:'#4b7cf3', 600:'#3264dc', 700:'#2451bd' },
            },
        },
    },
    plugins: [forms],
};
