import forms from "@tailwindcss/forms";
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                shadow: {
                    "0%": { width: "27%" },
                    "25%": { width: "30%" },
                    "50%": { width: "60%" },
                    "100%": { width: "27%" },
                },
            },
            animation: {
                shadow: "shadow 5s ease infinite",
            },
            backgroundImage: {
                'guest-hp': "url('/public/logo/abs2.svg')",
                'guest-pc': "url('/public/logo/abs4.svg')",
                'guest-head': "url('/public/logo/abs1.svg')"
            }
        },
    },

    daisyui: {
        themes: ["bumblebee"],
    },

    plugins: [forms, require("daisyui"), require("@tailwindcss/forms")],
};
