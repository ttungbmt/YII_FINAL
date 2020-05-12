var elixir = require('laravel-elixir');
var ExtractTextPlugin = require('extract-text-webpack-plugin');


elixir(function (mix) {

    elixir.config.js.webpack = {
        loaders: [
            { test: /\.js$/, loader: 'buble' },
            {
                test: /\.css$/,
                // loader: 'style-loader!css-loader',
                loader: ExtractTextPlugin.extract('style-loader', 'css-loader')
            },
        ],
        plugins: [
            new ExtractTextPlugin('public/style.css', {
                allChunks: true
            }),
        ],
        babel: {}
    }


    mix.scripts([
        // 'custom/leaflet@0.7.7/leaflet.js',
        // 'custom/leaflet@0.7.7/esri-leaflet.js',

        'vendor/Leaflet-1.0.0-rc.3/dist/leaflet-src.js',
        'core/esri-leaflet/dist/esri-leaflet-debug.js',

        
        
        // 'custom/leaflet.draw/leaflet.draw.js',
        'core/leaflet-draw/dist/leaflet.draw-src.js',
        'core/Leaflet.buffer/src/leaflet.buffer-src.js',

        'core/leaflet-geometry/dist/leaflet.geometryutil.js',
        'core/leaflet-draw-snap/leaflet.snap.js',

        'core/leaflet.markercluster/dist/leaflet.markercluster-src.js',
        'core/leaflet.contextmenu/dist/leaflet.contextmenu.js',
        'core/Leaflet.EasyButton/src/easy-button.js',
        'core/leaflet.fullscreen/Control.FullScreen.js',
        'core/Leaflet.geojsonCSS/leaflet.geojsoncss.js',
        'core/Leaflet.label/dist/leaflet.label-src.js', // confict 1.0.2 rc2
        'core/leaflet.locatecontrol/src/L.Control.Locate.js',
        'core/Leaflet.SmoothMarkerBouncing/leaflet.smoothmarkerbouncing.js',
        'core/Leaflet.VisualClick/dist/L.VisualClick.js',
        'core/leaflet-bouncemarker/bouncemarker.js',
        'core/leaflet-filterable-layer-control/src/leaflet.filterablelayercontrol.js',
        'core/leaflet-groupedlayercontrol/src/leaflet.groupedlayercontrol.js',
        'core/leaflet-omnivore/leaflet-omnivore.js',
        'core/leaflet-pip/leaflet-pip.js',
        'core/leaflet-slider/SliderControl.js',
        'core/turfjs/turf.min.js',
        'core/leaflet.loading/src/Control.Loading.js',
        'core/leaflet-choropleth/dist/choropleth.js',
        'custom/leaflet.measure/leaflet.measure/leaflet.measure.js',
        'core/leaflet-geodesy/leaflet-geodesy.js',
        'vendor/Leaflet.FileLayer/leaflet.filelayer.js',


        'core/Leaflet.extra-markers/src/assets/js/leaflet.extra-markers.js',
        'core/Leaflet.MakiMarkers/Leaflet.MakiMarkers.js',
        'core/leaflet-ajax/dist/leaflet.ajax.js',


        'core/shp/dist/shp.js',
        'vendor/leaflet.shapefile/leaflet.shpfile.js',
        'core/Wicket/wicket.js',

    ], 'dist/leaflet-plugins.js', './');

    mix.copy('core/leaflet/dist/images', 'dist/images');
});
