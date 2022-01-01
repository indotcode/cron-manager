let mix = require('laravel-mix');

mix.js('source/app.js', 'assets/js');
mix.sass('source/app.scss', 'assets/css', {}, [
    require('tailwindcss')
]);
