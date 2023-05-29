/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./templates/**/*.html.twig'],
  theme: {
    extend: {
      colors: {
        'greenc': '#cfeed1'
      },
      backgroundImage: {
        'header': "url('/assets/media/facile.jpg')"
      }
    },
  },
  plugins: [],
}

