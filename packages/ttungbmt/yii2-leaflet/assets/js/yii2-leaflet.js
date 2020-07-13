$(function () {
    class MapApp {

        constructor(options = {}) {
            this.options = this.transformOpts(options)
        }

        transformOpts(options){
            let opts = {}

            opts.config = _.pick(options, ['zoom', 'center'])
            opts.selectors = options.selectors

            return opts
        }


        init(){
            this.mounted()
        }

        mounted(){

        }

        getDefaultIcon(){
            return L.ExtraMarkers.icon({
                icon: 'fa fa-circle-o',
                markerColor: 'cyan'
            })
        }

        setMarker({lat, lng}) {
            let {inpLat, inpLng} = this.options.selectors
            $(inpLat).val(lat);
            $(inpLng).val(lng);
        }

        removeMarker() {
            let {inpLat, inpLng} = this.options.selectors
            $(inpLat).val('');
            $(inpLng).val('');
        }
    }

    MapApp.option = {}
    MapApp.$els = {}

    window.yii2Leaflet = {
        apps: {},

        initMap(name, fnMounted, options) {
            let app = new MapApp(options)
            app.mounted = fnMounted
            app.init()

            this.apps[name] = app
        },

    }

})