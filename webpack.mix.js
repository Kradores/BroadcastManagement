const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
    'public/css/app.css',
    'vendor/almasaeed2010/adminlte/dist/css/adminlte.css',
    'vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.css'
    ], 'public/css/all.css')
    .scripts([
        'vendor/almasaeed2010/adminlte/plugins/jquery/jquery.js',
        'vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.js',
        'vendor/almasaeed2010/adminlte/dist/js/adminlte.js'
    ], 'public/js/all.js');
