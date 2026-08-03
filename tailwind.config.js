import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    
    safelist: [
        {
            pattern: /(bg|text)-(brand|blue|green|purple)-(50|500)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                script: ['"Caveat"', 'cursive'],
            },
            colors: {
                brand: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#475569', // Base Slate/Charcoal
                    600: '#334155', // Primary Hover
                    700: '#1e293b', // Deep Slate
                    800: '#0f172a',
                    900: '#020617',
                    950: '#000000',
                },
                accent: {
                    coral: '#FF6B6B',
                    mint: '#4ECDC4',
                    golden: '#FFD93D',
                    violet: '#6C5CE7',
                    peach: '#FFEAA7',
                    sky: '#74B9FF',
                },
                surface: {
                    0: '#FFFFFF',
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                },
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            },
            boxShadow: {
                'float': '0 8px 30px rgba(0, 0, 0, 0.06)',
                'float-lg': '0 16px 50px rgba(0, 0, 0, 0.08)',
                'glow-brand': '0 0 40px rgba(245, 158, 11, 0.2)',
            },
            animation: {
                'fade-up': 'fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both',
                'fade-in': 'fadeIn 0.6s ease-out both',
                'slide-in-r': 'slideInR 0.7s cubic-bezier(0.16, 1, 0.3, 1) both',
                'scale-in': 'scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) both',
                'float': 'float 6s ease-in-out infinite',
                'marquee': 'marquee 30s linear infinite',
                'blob': 'blob 7s infinite',
            },
            keyframes: {
                fadeUp: { from: { opacity: '0', transform: 'translateY(30px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                fadeIn: { from: { opacity: '0' }, to: { opacity: '1' } },
                slideInR: { from: { opacity: '0', transform: 'translateX(-40px)' }, to: { opacity: '1', transform: 'translateX(0)' } },
                scaleIn: { from: { opacity: '0', transform: 'scale(0.9)' }, to: { opacity: '1', transform: 'scale(1)' } },
                float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-12px)' } },
                marquee: { '0%': { transform: 'translateX(0)' }, '100%': { transform: 'translateX(-50%)' } },
                blob: { '0%': { transform: 'translate(0px, 0px) scale(1)' }, '33%': { transform: 'translate(30px, -50px) scale(1.1)' }, '66%': { transform: 'translate(-20px, 20px) scale(0.9)' }, '100%': { transform: 'translate(0px, 0px) scale(1)' } },
            },
        },
    },

    plugins: [forms],
};
