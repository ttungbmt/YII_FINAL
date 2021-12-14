var webpack = require('webpack');
var path = require('path');
var ExtractTextPlugin = require('extract-text-webpack-plugin');


module.exports = {
    entry: [
        // 'webpack-dev-server/client?http://0.0.0.0:8082', // WebpackDevServer host and port
        // 'webpack/hot/only-dev-server',
        path.resolve(__dirname, './style.js') // Your appʼs entry point
    ],
    devtool: '#eval-source-map',
    output: {
        path: path.resolve(__dirname, './dist'),
        // publicPath: '/../',
        filename: 'leaflet.tmp.js'
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    },
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                exclude: /(node_modules|bower_components)/,
                loaders: ['babel'],
            },

            {
                test: /\.css$/,
                // loader: 'style-loader!css-loader',
                loader: ExtractTextPlugin.extract('style-loader', 'css-loader')
            },
            {
                test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
                loader: "file"
            },
            {
                test: /\.(woff|woff2)$/,
                loader: "url?prefix=font/&limit=5000"
            },
            {
                test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                loader: "url?limit=10000&mimetype=application/octet-stream"
            },
            {
                test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
                loader: "url?limit=10000&mimetype=image/svg+xml"
            },
            {
                // Chỉnh output.publicPath => gắn thêm prefix css image
                test: /\.(png|jpg|gif)$/,
                loader: "file-loader?limit=10000&name=images/[hash].[ext]"
            }
        ]
    },
    devServer: {
        contentBase: path.resolve(__dirname, './'),
        noInfo: true, //  --no-info option
        hot: true,
        inline: true,
        port: 8082,
        historyApiFallback: true
    },
    plugins: [
        new webpack.NoErrorsPlugin(),
        new ExtractTextPlugin('./leaflet-plugins.css', {
            allChunks: true,
        })
    ]
};

if (process.env.NODE_ENV === 'production') {
    // module.exports.devtool = '#source-map'
    // // http://vuejs.github.io/vue-loader/workflow/production.html
    // module.exports.plugins = (module.exports.plugins || []).concat([
    //     new webpack.DefinePlugin({
    //         'process.env': {
    //             NODE_ENV: '"production"'
    //         }
    //     }),
    //     new webpack.optimize.UglifyJsPlugin({
    //         compress: {
    //             warnings: false
    //         }
    //     }),
    //     new webpack.optimize.OccurenceOrderPlugin()
    // ])
}



