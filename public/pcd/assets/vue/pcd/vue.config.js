module.exports = {
    filenameHashing: false,
    configureWebpack: {
        externals: {
            'vue': 'Vue',
            'leaflet': 'L',
            'lodash-es': '_',
        }
    },
    pages: {
        'dichbenh': 'src/pages/dichbenh/index.js',
        'xn-huyetthanh': 'src/pages/xn-huyetthanh/index.js',
    }
}