import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            container: {
                padding: '1rem',
            },
            screens: {
                sm: '576px',   // Small screens and up
                md: '768px',   // Medium screens and up
                lg: '992px',   // Large screens and up
                xl: '1200px',  // Extra large screens and up
                xxl: '1400px', // 2XL screens and up
            },
        },
    },
    plugins: [],
};
