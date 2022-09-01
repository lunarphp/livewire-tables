/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './resources/views/*.blade.php',
    './resources/views/**/*.blade.php',
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
