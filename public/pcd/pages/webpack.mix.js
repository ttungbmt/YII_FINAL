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
                "@ttungbmt/vue-form": path.resolve(__dirname, "../../vendor/vue-form/src"),
                "@ttungbmt/vue-toolkit": path.resolve(__dirname, "../../vendor/vue-toolkit/src"),
                "@ttungbmt/vue-leaflet": path.resolve(__dirname, "../../vendor/vue-leaflet/src"),
                "@ttungbmt/vuexy": path.resolve(__dirname, "../../vendor/vuexy/src"),
            }
        },
        externals: {
            vue: 'Vue',
            jquery: '$',
        }
    })
    .js('src/odich-sxh/index.js', 'odich-sxh/main.js')
    .js('src/odich-sxh-thongke/index.js', 'odich-sxh-thongke/main.js')
    .disableNotifications();
