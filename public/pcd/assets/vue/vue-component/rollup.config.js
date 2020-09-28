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
                'axios': 'axios',
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