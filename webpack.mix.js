const mix     = require('laravel-mix');
const webpack = require('webpack'); // Thêm dòng này để yêu cầu Webpack

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
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                'process.env': {
                    VUE_APP_API_URL: JSON.stringify(process.env.URL_API),
                }
            })
        ]
    });

    mix.styles([
        'public/css/main.css',
        'public/css/grid.min.css',
    ], 'public/css/app.css');

