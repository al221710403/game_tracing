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
        require('tailwindcss'),
    ])
    .scripts([
        'resources/js/nav.js',
        'resources/js/tab.js',
    ], 'public/js/vendor.js')
    .version()
    module.exports = {
        stats: {
          children: true,
        },
    }
    // mix.webpackConfig({
    //     stats: {
    //         children: true,
    //     },
    // });
