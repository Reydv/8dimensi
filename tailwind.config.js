import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */

export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        "./resources/**/*.blade.php",
        './resources/views/**/*.blade.php',
        './resources/views/testing/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],


    theme: {
        extend: {
            fontFamily:{
                montserrat: ['Montserrat', 'sans'],
            },
            colors: {
                primary: '#000000',
                secondary: '#F7F1F1',
                bgcolor: '#F7F1F1',
                // ...
              },
              spacing: {
                '25' : '25rem',
              },
        },
    },
    

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui'),
    ],
};
