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
                'poppins': ['Poppins',...defaultTheme.fontFamily.sans],
            },
        },
        animation: {
            'text-slide': 'text-slide 12.5s cubic-bezier(0.83, 0, 0.17, 1) infinite',
        },  
        keyframes: {
            'text-slide': {
                '0%, 16%': {
                    transform: 'translateY(0%)',
                },
                '20%, 36%': {
                    transform: 'translateY(-16.66%)',
                },
                '40%, 56%': {
                    transform: 'translateY(-33.33%)',
                },
                '60%, 76%': {
                    transform: 'translateY(-50%)',
                },
                '80%, 96%': {
                    transform: 'translateY(-66.66%)',
                },
                '100%': {
                    transform: 'translateY(-83.33%)',
                },
            },                    
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
