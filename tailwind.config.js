/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './resources/**/*.{css,js}',
    './resources/**/*.blade.php',
    './resources/**/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')({
      strategy: 'class',
    }),
  ],
}
