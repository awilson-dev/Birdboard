/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {
      colors: {
        'blue': '#47cdff',
        'blue-light': '#8ae2fe'
      }
    },
  },
  plugins: [],
}
