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
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "tertiary-fixed-dim": "#c6c6c7",
                "secondary-fixed": "#ffdea2",
                "secondary-container": "#fcc02f",
                "surface-variant": "#e5e2e1",
                "secondary-fixed-dim": "#f9bd2c",
                "on-secondary-fixed": "#261900",
                "background": "#fcf9f8",
                "secondary": "#7a5900",
                "on-primary-fixed": "#002116",
                "inverse-on-surface": "#f3f0ef",
                "inverse-primary": "#5ddcaf",
                "tertiary-fixed": "#e2e2e2",
                "on-surface": "#1c1b1b",
                "on-secondary-container": "#6d4f00",
                "surface-dim": "#dcd9d9",
                "surface-container-highest": "#e5e2e1",
                "on-tertiary-fixed-variant": "#454747",
                "on-secondary": "#ffffff",
                "outline": "#6d7a73",
                "on-error-container": "#93000a",
                "error-container": "#ffdad6",
                "on-tertiary": "#ffffff",
                "primary-fixed": "#7cf9ca",
                "surface": "#fcf9f8",
                "inverse-surface": "#313030",
                "surface-tint": "#006c50",
                "primary-fixed-dim": "#5ddcaf",
                "on-primary-fixed-variant": "#00513b",
                "surface-container-lowest": "#ffffff",
                "surface-container": "#f0eded",
                "outline-variant": "#bccac1",
                "on-tertiary-container": "#313333",
                "tertiary-container": "#9a9b9b",
                "on-tertiary-fixed": "#1a1c1c",
                "surface-container-low": "#f6f3f2",
                "primary": "#006c50",
                "on-primary": "#ffffff",
                "tertiary": "#5d5f5f",
                "primary-container": "#22af85",
                "on-secondary-fixed-variant": "#5c4200",
                "on-error": "#ffffff",
                "on-primary-container": "#003b2a",
                "surface-bright": "#fcf9f8",
                "error": "#ba1a1a",
                "on-surface-variant": "#3d4a43",
                "on-background": "#1c1b1b",
                "surface-container-high": "#eae7e7"
            },
            spacing: {
                "margin-desktop": "40px",
                "container-max": "1280px",
                "base": "8px",
                "margin-mobile": "16px",
                "gutter": "24px",
                "stack-lg": "80px",
                "stack-md": "40px"
            },
        },
    },

    plugins: [forms],
};
