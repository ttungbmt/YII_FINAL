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

mix
    .setPublicPath('dist')
    .webpackConfig({
        resolve: {
            alias: {
                "@ttungbmt/vue-form": path.resolve(__dirname, "vendor/vue-form/src"),
            }
        },
        externals: {
            vue: 'Vue'
        }
    })
    .js('src/baocao-cln/index.js', 'baocao-cln/main.js')
    .disableNotifications();
