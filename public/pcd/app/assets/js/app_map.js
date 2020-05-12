var map;
var locMarker;

Vue.config.debug = true;
Vue.config.devtools = true;

Vue.transition('bounce', {
    enterClass: 'bounceInUp',
    leaveClass: 'bounceOutDown'
})

Vue.component('leaflet', {
    template: '#leaflet',
    props: {
        style: String,
        center: {
            type: Object,
            default: function () {
                return {
                    lat: 10.78676820511599,
                    lng: 106.76101684570312,
                }
            },
        },
        zoom: {
            type: Number,
            default: 10,
            validator: function (value) {
                return value > 9
            }
        },
        animate: {
            type: Boolean,
            default: false,
        },
        markers: {
            type: Object,
            default: function () {
                return {
                    geocomplete: {
                        latlng: [0,0]
                    }
                }
            },
        }
    },

    data: function(){
        return {
            address: '',
            lfMarkerGroup: new L.FeatureGroup(),
            lfMarker: new L.Marker([], {
                bounceOnAdd: true,
                draggable: true,
                icon: L.AwesomeMarkers.icon({
                    prefix: 'fa',
                    icon: 'medkit',
                    markerColor: 'blue'
                }),
                contextmenu: true,
                contextmenuInheritItems: false,
                contextmenuItems: [{
                    text: 'Xóa vị trí',
                    iconCls: 'icon-bin',
                    callback: this.removeMarker,
                }, '-', {
                    text: 'Xem vị trí',
                    iconCls: 'icon-pin-alt',
                    callback: e => {
                        this.geoInfo(e, 'onmarker')
                    },
                }, {
                    text: 'Đặt làm trung tâm',
                    iconCls: 'icon-enlarge',
                    callback: this.centerMap,
                }]
            }),
        }
    },
    events: {
        'addressDraw': function(mark){
            var self = this;
            var pin = this.lfMarker
                .setLatLng(mark.latlng);

            if(mark.hasOwnProperty('place')){

                var props = mark.place;
                var content = '<div class="markerPopup"><h6 class="pTitle">' + props.name + '</h6>';
                    content += '<div class="pContent">';
                    content += '<div><i class="icon-home2"></i> ' + props.formatted_address + '</div>';
                    content += props.international_phone_number ? '<div><i class="icon-phone2"></i> ' + props.international_phone_number + '</div>': '';
                    content += props.website ? '<div><i class="icon-file-text2"></i> <a href="'+props.website+'">' + props.website + '</a></div>' : '';
                    content += '</div></div>';

                pin.closePopup();
                pin.bindPopup(content).openPopup();
            }

            this.lfMarkerGroup.addLayer(pin).addTo(this.map);
            this.map.panTo(mark.latlng);

        }, 
        'map.addMarker': function (loc) {
            this.addMarker(loc);
        },
        'map.fitBounds': function (bounds) {
            this.map.fitBounds(bounds);
        }
    },
    computed: {

    },
    watch: {
        'zoom': function(){
            this.map.setZoom(this.zoom);
        },
        'center': function(){
            this.map.panTo(this.center, this.zoom, {animation: this.animate});
        },
    },
    attached: function(){
        var southWest = L.latLng(10.357814, 106.085991),
            northEast = L.latLng( 11.207961, 107.216702),
            bounds = L.latLngBounds(southWest, northEast);
        this.map = L.map(this.$el.querySelector('#map'), {
            center: this.center,
            zoom: this.zoom,
            minZoom: 9,
            maxZoom: 19,
            maxBounds: bounds,
            zoomControl: false,
            // visualClickEvents: 'click contextmenu',
            contextmenu: true,
            // contextmenuWidth: 140,
            contextmenuItems: [{
                text: 'Thêm vị trí',
                iconCls: 'icon-import',
                callback: this.addMarker,
            }, '-', {
                text: 'Xem vị trí',
                iconCls: 'icon-pin-alt',
                callback: e => {
                    this.geoInfo(e, 'onmap')
                },
            }, {
                text: 'Đặt làm trung tâm',
                iconCls: 'icon-enlarge',
                callback: this.centerMap,
            }]
        });
        map = this.map;
    },
    ready: function(){
        var self = this;

        this.setupMap();
        this.setupControl();
        this.setupTool();

        // -- EVENTS ----------------------------------------------------------
        this.map.on('click', function(e){
            self.$dispatch('click', e);


            // self.geoInfo(e);

        });

        this.map.on('zoomend', function(e){
            self.$dispatch('zoomend', map.getZoom());
        });

        this.map.on('dragend', function(e){
            self.$dispatch('dragend', map.getCenter());
        })

        this.map.on('locationfound', function(e){
            self.$dispatch('locationfound', e);

            self.lfMarker.setLatLng(e.latlng);
            self.lfMarker.addTo(self.map);
        });

        this.lfMarker.on('dragend', function(e) {
            self.$dispatch('markerDragend', e)
        });


    },
    //mixins: [mixin],
    methods: {
        setupMap: function(){
            var self = this;

            // https://www.mapbox.com/mapbox.js/api/v2.3.0/l-tilelayer/
            var tileOptions = {
                maxZoom: 19,
            }

            var OSM = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', $.extend(tileOptions, {position: 'back'}));
            var mapBox = L.tileLayer('http://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', $.extend(tileOptions, {
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw'
            }));
            // SATELLITE, ROADMAP, HYBRID, TERRAIN
            var styles = [
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        { "visibility": "on" },
                        { "color": "#ff5400" }
                    ]
                },{
                    "elementType": "labels.text.fill",
                    "stylers": [
                        { "color": "#023f75" }
                    ]
                },{
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        { "color": "#FFEE00" },
                        { "weight": 7.9 }
                    ]
                }
            ];

            var googleStreet = new L.Google('ROADMAP', {maxZoom: 19,
                opacity: 1,
                mapOptions: {
                    styles: styles
                }
            });

            var googleRoad = new L.Google('ROADMAP', {maxZoom: 19,});
            var googleSatellite = new L.Google('HYBRID', {maxZoom: 19});
            var hcm_basemap = L.esri.dynamicMapLayer({url: 'http://hcmgisportal.vn:6080/arcgis/rest/services/BaseMap_HCM/MapServer', position: 'back'});
            var trueOrtho = L.esri.imageMapLayer({ url: 'http://hcmgisportal.vn:6080/arcgis/rest/services/TRUEORTHOR_LIDAR/ImageServer',});
            var trueOrtho_qtiles = L.tileLayer('http://hcmgisportal.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg', $.extend(tileOptions));

            // TITLE -------------------------------------------------------------------------------
            var tamthua = create_New_WMS_Layer(map, 'dichte:rt_point', '', 'rt_point');
            var gt_hcm = L.esri.dynamicMapLayer({
                url: 'http://hcmgisportal.vn:6080/arcgis/rest/services/BaseMap_HCM_gt/MapServer',
                opacity: 0.7,
            });
            var ranhto  = create_New_WMS_Layer(map, 'dichte:ranh_to', '', 'ranh_to');
            var ranhphuong  = create_New_WMS_Layer(map, 'dichte:dm_phuong', '', 'dm_phuong');;
            var ranhquan  = create_New_WMS_Layer(map, 'dichte:dm_quan', '', 'dm_quan');

            var layers = L.control.FilterableLayers({
                'Bản đồ OSM': OSM,
                'Bản đồ Mapbox': mapBox.addTo(map),
                'Bản đồ Google': googleRoad,
                'Ảnh vệ tinh': googleSatellite,
                'Ảnh hàng không': trueOrtho_qtiles,
            }, {
                'Tâm thửa': tamthua,
                'Ranh nhà': hcm_basemap,
                'Ranh tổ': ranhto,
                'Ranh phường': ranhphuong,
                'Ranh quận': ranhquan,
            }).addTo(map);

            this.map.addLayer(ranhto, true);

//                var miniMap = new L.Control.MiniMap(googleRoad, {toggleDisplay: true}).addTo(map);


            self.map.on('baselayerchange', function(e) {
                if(e.name == 'Ảnh hàng không'){
                    self.map.addLayer(googleStreet);
                    $('#sliderbar-wrapper').show();
                    trueOrtho_qtiles.setOpacity(0.6);

                } else {
                    self.map.removeLayer(googleStreet);
                    $('#sliderbar-wrapper').hide();
                    trueOrtho_qtiles.setOpacity(1);
                }

            });

            map.on('overlayadd', function(e) {

            });

            map.on('overlayremove', function(e) {
//                    console.log(e);
            });

            map.on('layeradd', function(e) {
//                    console.log(e);
            });

            map.on('layerremove', function(e) {
//                    console.log(e);
            });

            $(this.$el.querySelector('#sliderbar')).ionRangeSlider({
                min: 0,
                max: 100,
                onStart: function (data) {
                    data.from = 0.6*100;
                },
                onChange: function (data) {
                    trueOrtho_qtiles.setOpacity(data.from/100)
                },
                onFinish: function (data) {

                },
            });

        },
        setupControl: function(){
            var zoomControl = L.control.zoom({ position: 'bottomright', zoomInText: '+', zoomOutText: '-', zoomInTitle: 'Phóng to', zoomOutTitle: 'Thu nhỏ',});
            var locateControl = L.control.locate({ position: 'bottomright',
                strings: {
                    title: "Vị trí của tôi",
                    metersUnit: "meters",
                    feetUnit: "feet",
                    popup: "Bạn đang ở trong phạm vi {distance} {unit}",
                    outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
                },
            });
            var loadingControl = L.Control.loading({});


//                var resizeControl = L.resizer({position: 'topright'});

            this.map.addControl(zoomControl);
            this.map.addControl(loadingControl);
            this.map.addControl(locateControl);
        },
        setupTool: function(){
            var self = this;

            var input = document.getElementById('geocomplete');
            var options = {componentRestrictions: {country: 'vn'}};
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            // $('#geocomplete').geocomplete().bind("geocode:result", function(event, result){
            //     var geom = result.geometry.location;
            //     var latlng = {lat: geom.lat(), lng: geom.lng()};
            //
            //     self.$dispatch('addressDraw', {
            //         latlng: latlng
            //     });
            // });


            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                var loc = place.geometry.location;
                
                self.$dispatch('addressDraw', {
                    latlng: {lat: loc.lat(), lng: loc.lng()},
                    place: place,
                });

                console.log(place);





            });
        },
        removeMarker: function (e) {
            this.map.removeLayer(this.lfMarkerGroup);

            this.$dispatch('removeMarker', {
                latlng: e.latlng
            });
        },
        addMarker: function (e) {
            var pin = this.lfMarker
                .setLatLng(e.latlng);

            locMarker = [e.latlng.lat, e.latlng.lng];

            this.lfMarkerGroup.addLayer(pin).addTo(this.map);
            this.$dispatch('addMarker', {
                latlng: e.latlng
            });
        },
        geoSearch: function(){
            $(this.$el.querySelector('#geocomplete')).trigger("geocode")
        },
        geoInfo: function(e, target){
            var self = this;
            var latlng = target == 'onmap' ? [e.latlng.lat, e.latlng.lng] : locMarker;

            $('<input>')
                .geocomplete('find', latlng.join(','))
                .bind("geocode:result", function(event, result){
                    var addr_com = {};
                    _.map(result.address_components, function(item, key){
                        switch(item.types[0]) {
                            case 'street_number':
                                addr_com.sonha = item.long_name
                                break;
                            case 'route':
                                addr_com.tenduong = item.long_name
                                break;
                            case 'sublocality_level_1':
                                addr_com.phuong = item.long_name
                                break;
                            case 'locality':
                                addr_com.quan = item.long_name
                                break;
                            case 'administrative_area_level_1':
                                addr_com.tinh = item.long_name
                                break;
                            case 'country':
                                addr_com.quocgia = item.long_name
                                break;
                        }
                    });

                    self.$dispatch('geoInfo', {
                        event: event,
                        result: result,
                        address: result.formatted_address,
                        addr_com: addr_com
                    })
                })
                .bind("geocode:error", function(event, status){

                })
                .bind("geocode:multiple", function(event, results){
                });


        },
        zoomIn: function (e) {
            this.map.zoomIn();
        },
        zoomOut: function (e) {
            this.map.zoomOut();
        },
        centerMap: function (e) {
            this.map.panTo(e.latlng);
        },
    },

})

if(typeof myMixin == 'undefined'){
    myMixin = {
    };
}

var vm;
if($('#cabenh-wrapper').length){
    vm = new Vue({
        el: '#cabenh-wrapper',
        data: {
            lat: 0,
            lng: 0,
        },
        mixins: [myMixin],
        events: {
            'markerDragend': function(e){
                var latlng = e.target.getLatLng();
                this.updateGeo({latlng: latlng});
            },
            'addMarker': function(loc){
                this.updateGeo(loc);
            },
            'removeMarker': function (loc) {
                locMarker = [];
                this.updateGeo({latlng: {lat: null, lng: null}});
            },
            'geoInfo': function(addrObject){
                $.noty.closeAll();
                noty({
                    text: addrObject.address,
                    layout: 'bottomRight',
                    type: 'information',
                    animation: {
                        open: 'animated bounceInRight',
                        close: 'animated bounceOutRight',
                        easing: 'swing', // easing
                        speed: 500 // opening & closing animation speed
                    }
                });
            },
            'addressDraw': function(loc){
                this.updateGeo(loc);
            },
            'click': function(e){
                var self = this;

            },
            'dragend': function (latlng) {

            },
            'zoomend': function(zoomlevel){
                this.zoom = zoomlevel;
            },
            'locationfound': function(loc){
                this.updateGeo(loc);
            },
        },
        ready: function(){
            this.initGeo();



        },
        methods: {
            initGeo: function () {
                if(this.psxh.geo_x && this.psxh.geo_y){
                    this.$broadcast('map.addMarker', {
                        latlng: {lat: this.psxh.geo_y, lng: this.psxh.geo_x}
                    })
                }

                this.$broadcast('map.fitBounds', this.bound);
            },
            updateGeo: function (loc) {
                this.psxh.geo_y = loc.latlng.lat;
                this.psxh.geo_x = loc.latlng.lng;
            }
        }
    });
}

