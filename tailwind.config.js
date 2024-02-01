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
        'accent': 'var(--accent-color)'
      },
      backgroundColor: {
        'page': 'var(--page-background-color)',
        'card': 'var(--card-background-color)',
        'button': 'var(--button-background-color)',
        'header': 'var(--header-background-color)'
      },
      textColor: {
        'default': 'var(--text-default-color)',
        'accent': 'var(--text-accent-color)',
        'muted': 'var(--text-muted-color)'
      },
      boxShadowColor: {
        'button': 'var(--button-shadow-color)'
      },
      borderColor: {
        'muted': 'var(--border-muted-color)',
        'accent': 'var(--border-accent-color)'
      }
    },
  },
  plugins: [],
}
