var path = require('path');
var webpack = require('webpack');
var ExtractTextPlugin = require('extract-text-webpack-plugin');


module.exports = {
    // debug: true,
    devtool: 'source-map',
    entry: {
        app: path.join(__dirname, 'app/index'),
    },
    // Automatically transform files with these extensions
    resolve: {
        root: path.resolve(__dirname, '../../../node_modules'),
        alias: {
            src: 'src',
            vendor: 'vendor',
        },
        extensions: ['', '.js', '.jsx', '.css']
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel',
                query: {
                    plugins: [
                        ['react-transform', {
                            transforms: [{
                                transform: 'react-transform-hmr',
                                imports: ['react'],
                                locals: ['module'],
                            }],
                        }],
                    ],
                },
            },
        ],
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'bundle.js',
        publicPath: 'http://localhost:8000/dist',
    },
    plugins: [
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': '"development"',
            },
        }),
        new webpack.NoErrorsPlugin(),
        new webpack.HotModuleReplacementPlugin(),
    ],
    devServer: {
        host: 'localhost',
        noInfo: false,
        quiet: false,
        colors: true,
        contentBase: __dirname,
        historyApiFallback: true,
        hot: true,
        inline: true,
        port: 8000,
        progress: true,
        stats: {
            cached: false,
        },
    },
}
