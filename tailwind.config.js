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
                brand: {
                    DEFAULT: '#2563EB', // RigRadar blue
                    dark: '#1D4ED8',
                    light: '#EFF6FF',
                },
                dark: {
                    DEFAULT: '#111827', // Deep dark blue/black
                    lighter: '#1F2937',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.5s ease-out',
                'scale-up': 'scaleUp 0.3s ease-out forwards',
                'marquee': 'marquee 25s linear infinite',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                scaleUp: {
                    '0%': { transform: 'scale(1)' },
                    '100%': { transform: 'scale(1.02)' },
                },
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-100%)' },
                }
            }
        },
    },

    plugins: [forms],
};
