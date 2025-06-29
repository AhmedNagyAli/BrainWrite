/** @type {import('tailwindcss').Config} */
const rtl = require('tailwindcss-rtl')
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                almarai: ['Almarai', 'sans-serif'],
            },
            maxWidth: {
                '8xl': '90rem', // 1440px
                '9xl': '100rem', // 1600px
                '10xl': '110rem', // 1760px
            }
        },

    },
    plugins: [
        rtl,
    ],
}