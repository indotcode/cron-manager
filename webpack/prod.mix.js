let mix = require('laravel-mix');

mix.disableNotifications();
mix.js('source/app.js', 'assets/js').vue({version: 3});
mix.sass('source/app.scss', 'assets/css', {}, [
    require('tailwindcss')
]);
