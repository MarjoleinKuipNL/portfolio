const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
        require('tailwindcss'),
    ]);
mix.sass('resources/sass/app.sass', 'public/css')
    .sass('resources/sass/admin.sass', 'public/css/admin');
mix.sass('resources/sass/app.scss', 'public/css').options({
    processCssUrls: false
});
mix.js('resources/js/app.js', 'public/js')
    .sourceMaps();
let productionSourceMaps = false;

mix.js('resources/js/app.js', 'public/js')
    .sourceMaps(productionSourceMaps, 'source-map');
mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/app.js', 'public/js')
    .vue();