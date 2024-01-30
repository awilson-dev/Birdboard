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
      },
      backgroundColor: {
        'page': 'var(--page-background-color)',
        'card': 'var(--card-background-color)',
        'button': 'var(--button-background-color)',
        'header': 'var(--header-background-color)'
      },
      textColor: {
        'default': 'var(--text-default-color)'
      },
      boxShadowColor: {
        'button': 'var(--button-shadow-color)'
      }
    },
  },
  plugins: [],
}
