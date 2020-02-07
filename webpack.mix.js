let mix = require('laravel-mix');

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

mix.copy('node_modules/jquery-smartcart/dist/js/jquery.smartCart.min.js', 'public/js/smartcart.js')
    .copy('node_modules/jquery-smartcart/dist/css/smart_cart.min.css', 'public/css/smartcart.css');


// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
