let mix = require('laravel-mix');
const path = require('path');
const pathDir = path.resolve(__dirname, '../../../../')
mix.setPublicPath(pathDir);
mix.js('source/app.js', 'public/cron-manager/js');
mix.sass('source/app.scss', 'public/cron-manager/css', {}, [
    require('tailwindcss')
]);
