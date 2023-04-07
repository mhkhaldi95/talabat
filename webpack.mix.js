let mix = require('laravel-mix');

mix.setPublicPath('public_html');
mix.js('resources/js/app.js', 'js').sass('resources/sass/app.scss', 'css');
// mix.js('resources/js/app.js', 'public_html/js');
