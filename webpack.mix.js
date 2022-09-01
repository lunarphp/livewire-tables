let mix = require('laravel-mix')

mix
  .js('resources/js/app.js', 'dist/livewire-tables.js')
  .postCss('resources/css/app.css', 'dist/livewire-tables.css', [
    require('tailwindcss'),
  ])
