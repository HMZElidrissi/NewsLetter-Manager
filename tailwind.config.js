/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    mode: "jit",
    theme: {
    extend: {},
    },
    plugins: [
        require('flowbite/plugin')

    ],
}

