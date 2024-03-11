/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Roboto', 'Helvetica', 'Arial', 'sans-serif'],
                'serif': ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
                'mono': ['Courier New', 'monospace']
            },
        },
    },
    plugins: [],
}
