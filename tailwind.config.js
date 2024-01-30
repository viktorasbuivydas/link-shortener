/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.vue",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            container: {
                center: true,
            }
        },
    },
    plugins: [],
}

