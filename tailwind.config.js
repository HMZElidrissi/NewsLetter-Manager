/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    mode: "jit",
    theme: {
    extend: {},
    },
    plugins: [require("@tailwindcss/forms"), require("@tailwindcss/aspect-ratio")],
}

