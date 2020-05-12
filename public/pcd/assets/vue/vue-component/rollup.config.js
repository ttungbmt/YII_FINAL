import vue from 'rollup-plugin-vue'
import babel from 'rollup-plugin-babel'
import buble from "rollup-plugin-buble";
import commonjs from 'rollup-plugin-commonjs'
import resolve from 'rollup-plugin-node-resolve'
import replace from 'rollup-plugin-replace'
import json from '@rollup/plugin-json';
import pkg from './package.json'
import postcss from 'rollup-plugin-postcss'
import scss from 'rollup-plugin-scss'
import css from 'rollup-plugin-css-only'

let external = Object.keys(pkg.devDependencies).concat([
    'lodash-es', 'jquery', 'moment', 'vue', 'vuex', 'leaflet',
    // 'vuex-pathify'
]);

export default [
    // ESM build to be used with webpack/rollup.
    // {
    //     input: 'src/index.js',
    //     output: {
    //         format: 'esm',
    //         file: 'dist/library.esm.js'
    //     },
    //     plugins: [
    //         babel({
    //             exclude: 'node_modules/**', // only transpile our source code
    //             runtimeHelpers: true,
    //         }), //Place babel before commonjs plugin.
    //         commonjs(), // converts date-fns to ES modules
    //         vue()
    //     ]
    // },
    // Browser build.
    // {
    //     input: 'src/index.js',
    //     output: {
    //         format: 'iife',
    //         file: 'dist/library.js',
    //         name: 'VueCore',
    //         globals: {
    //             'excellentexport': 'ExcellentExport',
    //             'lodash-es': '_',
    //             'jquery': '$',
    //         }
    //     },
    //     plugins: [
    //         resolve(),
    //         commonjs(),
    //         babel({
    //             exclude: 'node_modules/**', // only transpile our source code
    //             runtimeHelpers: true,
    //         }),
    //         vue({
    //             css: true,
    //             compileTemplate: true,
    //         }),
    //         buble(),
    //         replace({
    //             "process.env.NODE_ENV": JSON.stringify("production")
    //         }),
    //     ],
    //     external
    // },
    {
        input: 'src/pages/sxh/index.js',
        output: {
            format: 'iife',
            file: 'dist/page-sxh.js',
            name: 'VueCore',
            globals: {
                'excellentexport': 'ExcellentExport',
                'lodash-es': '_',
                'moment': 'moment',
                'jquery': '$',
                'vue': 'Vue',
                'vuex': 'Vuex',
                'leaflet': 'L',
                // 'vuex-pathify': 'pathify ',
            }
        },
        plugins: [
            babel({
                exclude: 'node_modules/**', // only transpile our source code
                runtimeHelpers: true,
            }),
            resolve(),
            commonjs(),
            json(),
            postcss({
                extract: true
            }),

            vue({
                css: false,
                compileTemplate: true,
            }),

            buble({
                objectAssign: true
            }),
            replace({
                "process.env.NODE_ENV": JSON.stringify("production")
            }),

        ],
        external
    }
]