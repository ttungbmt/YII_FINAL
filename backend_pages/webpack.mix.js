const mix = require('laravel-mix');
const {resolve} = require('path')

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

mix
    .setPublicPath('../backend_yii/public/pcd/pages/dist')
    .webpackConfig({
        externals: {
            vue: 'Vue',
            jquery: '$',
            lodash: '_',
            axios: 'axios',
        },
        resolve: {
            alias: {

            },
        },
    })

mix
    .js('src/phun-hc/app.js', 'dist/phun-cd')
    .vue()
    .disableNotifications()

