let mix = require('laravel-mix');
const path = require('path');
const pathDir = path.resolve(__dirname, '../../../../')

mix.disableNotifications();
mix.setPublicPath(pathDir);
mix.js('source/app.js', 'public/cron-manager/js').vue({version: 3});
mix.sass('source/app.scss', 'public/cron-manager/css', {}, [
    require('tailwindcss')
]);


