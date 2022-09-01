let mix = require('laravel-mix')

mix
  .js('resources/js/app.js', 'dist/livewire-tables/app.js')
  .setPublicPath('dist')
  .version()

mix
  .postCss('resources/css/app.css', 'dist/livewire-tables/app.css', [
    require('tailwindcss'),
  ])
  .setPublicPath('dist')
  .version()
