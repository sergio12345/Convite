/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Montserrat Alternates', 'Helvetica', 'Arial', 'sans-serif'],
      },
      colors: {
        'transparent': 'transparent',
        'current': 'currentColor',
        'primary': {
          100: '#F5F5FF',
          200: '#F3F5FF',
          300: '#E5E5FE',
          500: '#6140E3'
        },
        danger: {
          500: '#E66C76'
        },
        'dark': {
          100: '#E3E3E3',
          200: '#C0C0C0',
          500: '#808080',
          700: '#000000'
        },
        blue: {
          500: '#6140E3',
          600: '#6140E3',
          700: '#6140E3',
        }
      },
      backgroundImage: {
        'auth': "url('../img/auth-bg.svg')",
        'new-event': "url('../img/new-event-bg.svg')",
      }
    },
    container: {
      center: true,
      padding: '0rem',
      screens: {
        sm: '540px',
        md: '720px',
        lg: '960px',
        xl: '1140px',
        '2xl': '1320px',
      },
    },
  },
  plugins: [require('flowbite/plugin')],
}
