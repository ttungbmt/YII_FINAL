'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var map, BASE_URL, dichteGroup, GEOSERVER_ADDRESS, dataOdich;

var dichteGroup = new L.featureGroup();
var drawnItemsOnMap = new L.FeatureGroup();drawnItemsOnMap.setZIndex(1000);
var m = {};

// Cấu hình dùng cho khởi tạo WMS layer.
if (typeof BASE_URL === 'undefined' || BASE_URL == '/') {
    GEOSERVER_ADDRESS = "http://pcd.hcmgis.vn/geoserver2/wms";
} else {
    GEOSERVER_ADDRESS = BASE_URL + "../../geoserver2/wms";
}

var Map = function () {
    function Map() {
        _classCallCheck(this, Map);

        this.mapOptions = {
            center: [10.8556284832574, 106.744985842335],
            zoom: 13,
            fullscreenControl: true
        };
    }

    _createClass(Map, [{
        key: 'init',
        value: function init() {
            map = new L.Map('div_map', this.mapOptions);
            this.addLayers();

            // Init map layer
            this.initMapLayer();
            // Init map control
            this.initMapControl();

            this.mapReady();

            this.actEvents();
        }
    }, {
        key: 'addLayers',
        value: function addLayers() {
            dichteGroup.addTo(map);
            map.addLayer(drawnItemsOnMap);
        }
    }, {
        key: 'initMapLayer',
        value: function initMapLayer() {
            var tileWMS = new m.TileWMS(GEOSERVER_ADDRESS);

            var mapBox = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', { id: 'mapbox.streets', accessToken: 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw' });
            var ranhphuong = tileWMS.getLayer('dichte:dm_phuong');
            var cabenh = tileWMS.getLayer('dichte:v_cabenh');
            var vungbenh = tileWMS.getLayer('dichte:v_vungbenh');

            L.control.layers({
                'Mapbox': mapBox,
                'OSM': L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png'),
                'Google': L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] }),
                'Vệ tinh': L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', { subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] }),
                'Hàng không': L.tileLayer('http://hcmgisportal.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg')
            }, {
                'Ca bệnh': cabenh,
                'Bản đồ vùng dịch': vungbenh,
                'Ranh quận': tileWMS.getLayer('dichte:dm_quan'),
                'Ranh phường': ranhphuong,
                'Ranh tổ': tileWMS.getLayer('dichte:ranh_to'),
                'Điểm thửa': tileWMS.getLayer('dichte:rt_point')
            }).addTo(map);

            map.addLayer(mapBox, true);
            layerRanhphuong = ranhphuong;
            layerCabenh = cabenh;
            layerVungbenh = vungbenh;
            checkRanhphuong();
        }
    }, {
        key: 'initMapControl',
        value: function initMapControl() {
            L.control.measure({ position: 'topright' }).addTo(map);
            map.addControl(new m.DrawControl(drawnItemsOnMap));
        }
    }, {
        key: 'mapReady',
        value: function mapReady() {

            var style = {
                'default': {
                    'color': 'yellow'
                },
                'highlight': {
                    'color': 'green'
                }
            };

            $('#mOdich').on('show.bs.modal', function () {
                var layers = drawnItemsOnMap.getLayers().map(function (v, k) {
                    return _.has(v, '_mRadius') ? _.first(turf.buffer(v.toGeoJSON(), v.getRadius(), 'meters').features) : v.toGeoJSON();
                });

                var merge = turf.merge(turf.featurecollection(layers));
                var area = turf.area(merge);
                var geomData = { area: area, geojson: merge.geometry };

                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'geo/dichte-in-polygon',
                    data: { type: 'odich', 'sql': MAP_USER_FILTER, geomData: geomData },
                    success: function success(html) {
                        $('#mOdich .modal-body').html(html);
                    }
                });
            });
        }
    }, {
        key: 'actEvents',
        value: function actEvents() {
            var _this = this;

            map.on('draw:created', function (e) {
                return _this.editDraw(e);
            });
            map.on('draw:edited', function (e) {
                return _this.editDraw(e);
            });
        }
    }, {
        key: 'editDraw',
        value: function editDraw(e) {
            var layer = e.layer;
            var layerType = e.layerType;
            var type = e.type;

            layer.type = layerType;

            switch (type) {
                case 'draw:created':
                    {
                        drawnItemsOnMap.addLayer(layer);break;
                    }
            }

            layer.on('click', function (e) {
                var highlight = m.DrawControl.highlight;
                var def = m.DrawControl.style.circle;

                if (e.originalEvent.ctrlKey) {
                    if (layer.style == highlight) {
                        layer.style = def;
                        layer.setStyle(def);
                        return;
                    }

                    layer.style = highlight;
                    layer.setStyle(highlight);
                }

                var circleHl = _.filter(drawnItemsOnMap.getLayers(), { style: m.DrawControl.highlight }).map(function (cir) {
                    return cvGeom(cir).geoJSON;
                });

                if (!_.isEmpty(circleHl)) {
                    var mergeCir = turf.merge(turf.featurecollection(circleHl));
                    dataOdich = {
                        area: turf.area(mergeCir),
                        geoJSON: mergeCir.geometry
                    };
                    // callDatas({}, geomData);
                    postOdich(dataOdich).done(function (html) {
                        return callPopup(html);
                    });
                }
            });
        }
    }]);

    return Map;
}();

var cvGeom = function cvGeom(geom) {
    var radius = void 0;
    var type = geom.type;
    var geoJSON = geom.toGeoJSON();

    if (type == 'circle') {
        radius = geom.getRadius();
        geoJSON = circle2polygon(geom.getCentroid(), radius).toGeoJSON();
    }

    return {
        type: type, radius: radius, geoJSON: geoJSON, geom: geom
    };
};

var circle2polygon = function circle2polygon(center) {
    var radius = arguments.length <= 1 || arguments[1] === undefined ? 200 : arguments[1];
    var parts = arguments.length <= 2 || arguments[2] === undefined ? 200 : arguments[2];

    return LGeo.circle(center, radius, { parts: parts });
};

var postOdich = function postOdich() {
    var geomData = arguments.length <= 0 || arguments[0] === undefined ? dataOdich : arguments[0];
    var url = arguments.length <= 1 || arguments[1] === undefined ? BASE_URL + 'geo/dichte-in-polygon' : arguments[1];

    return $.ajax({
        type: 'POST',
        url: url,
        data: { 'sql': MAP_USER_FILTER, geomData: geomData }
    });
};

var TileWMS = function () {
    _createClass(TileWMS, [{
        key: 'WMSOptions',
        get: function get() {
            return this.defaultParams;
        },
        set: function set(append) {
            this.defaultParams = Object.assign({}, this.WMSOptions, append);
        }
    }]);

    function TileWMS(url) {
        _classCallCheck(this, TileWMS);

        this.defaultParams = {
            service: 'WMS',
            layers: '',
            format: 'image/png',
            transparent: true
        };

        this.url = url;
    }

    _createClass(TileWMS, [{
        key: 'getLayer',
        value: function getLayer(layerName) {
            this.WMSOptions = { layers: layerName };
            return new L.TileLayer.BetterWMS(this.url, this.WMSOptions);
        }
    }]);

    return TileWMS;
}();

var DrawControl = function () {
    function DrawControl(featureDraw) {
        _classCallCheck(this, DrawControl);

        return this.initDraw(featureDraw);
    }

    _createClass(DrawControl, [{
        key: 'initDraw',
        value: function initDraw(featureDraw) {
            // L.drawLocal = this.drawLocale;

            return drawControl = new L.Control.Draw({
                position: 'topright',

                edit: {
                    featureGroup: featureDraw,
                    remove: true,
                    buffer: {
                        replace_polylines: false,
                        separate_buffer: false
                    }
                },
                draw: {
                    polyline: { metric: true }, marker: false, rectangle: false, circle: { metric: true },
                    polygon: {
                        showArea: true
                    }
                }
            });
        }
    }]);

    return DrawControl;
}();

DrawControl.style = {
    circle: {
        color: '#f06eaa'
    },
    polyline: {},
    polygon: {},
    marker: {},
    rectangle: {}
};
DrawControl.highlight = {
    color: 'yellow'
};
DrawControl.drawLocale = {
    draw: {
        toolbar: {
            actions: {
                title: 'Hủy bỏ', // Cancel drawing
                text: 'Hủy bỏ' // Cancel
            },
            undo: {
                title: 'Xóa điểm đã vẽ cuối cùng', //Delete last point drawn
                text: 'Xóa điểm cuối cùng' },
            buttons: {
                polyline: 'Vẽ đường', // Draw a polyline
                polygon: 'Vẽ đa giác', // Draw a polygon
                rectangle: 'Vẽ hình chữ nhật', // Draw a rectangle
                circle: 'Vẽ đường tròn', // Draw a circle
                marker: 'Thêm điểm' },
            finish: {
                title: 'Kết thúc',
                text: 'Kết thúc'
            }
        },
        handlers: {
            circle: {
                tooltip: {
                    start: 'Click và kéo chuột để vẽ đường tròn.' //Click and drag to draw circle.
                },
                radius: 'Bán kính' // Radius
            },
            marker: {
                tooltip: {
                    start: 'Click lên bản đồ để đặt marker' //Click map to place marker.
                }
            },
            polygon: {
                tooltip: {
                    start: 'Click để bắt đầu vẽ hình', // Click to start drawing shape.
                    cont: 'Click để tiếp tục vẽ hình', //Click to continue drawing shape.
                    end: 'Click điểm đầu để khép hình' }
            },
            polyline: {
                error: '<strong>Lỗi:</strong> Các cạnh không được bắt chéo!', // '<strong>Error:</strong> shape edges cannot cross!',
                tooltip: {
                    start: 'Click để bắt đầu vẽ đường', // Click to start drawing line.
                    cont: 'Click để tiếp tục vẽ đường', // Click to continue drawing line.
                    end: 'Click điểm cuỗi để kết thúc đường' // Click last point to finish line.
                }
            },
            rectangle: {
                tooltip: {
                    start: 'Click và kéo chuột để vẽ hình chữ nhật' }
            },
            simpleshape: {
                tooltip: {
                    end: 'Thả chuột để kết thúc' // Release mouse to finish drawing.
                }
            }
        }
    },
    edit: {
        toolbar: {
            actions: {
                save: {
                    title: 'Lưu những thay đổi', // Save changes.
                    text: 'Lưu' // Save
                },
                cancel: {
                    title: 'Hủy bỏ chỉnh sửa, bỏ tất cả những thay đổi', // Cancel editing, discards all changes.
                    text: 'Hủy bỏ' // Cancel
                }
            },
            buttons: {
                buffer: 'Mở rộng lớp', // Expand layers.
                bufferDisabled: 'Không có lớp để mở rộng', // No layers to expand.
                edit: 'Xóa lớp', // Edit layers.
                editDisabled: 'Không có lớp để chỉnh sửa', //No layers to edit.
                remove: 'Xóa lớp', //Delete layers.
                removeDisabled: 'Không có lớp để xóa' }
        },
        handlers: {
            buffer: {
                tooltip: {
                    text: 'Click và kéo chuột để mở rộng hoặc thu hẹp hình' // Click and drag to expand or contract a shape.
                }
            },
            edit: {
                tooltip: {
                    text: 'Kéo chuột hoặc đánh dấu để chỉnh sửa đối tượng', // Drag handles, or marker to edit feature.
                    subtext: 'Click hủy bỏ để quay lại' }
            },
            remove: {
                tooltip: {
                    text: 'Click lên đối tượng để xóa' // Click on a feature to remove
                }
            }
        }
    }
};


function editDraw(e, create) {
    var type = e.layerType,
        layer = e.layer;

    // Do whatever else you need to. (save to db, add to 2map etc)
    //        drawnItemsOnMap.clearLayer();
    //if (preLayer !== null)
    //drawnItemsOnMap.removeLayer(preLayer);
    if (create) drawnItemsOnMap.addLayer(layer);
    //preLayer = layer;
    var layers = drawnItemsOnMap.getLayers();
    var postData = [];
    for (var i = 0; i < layers.length; i++) {
        layer = layers[i];

        if (typeof layer._mRadius === 'undefined') {
            var latlngs = layer.getLatLngs();
            postData[i] = { 'bound': getStringFromLatLngs(latlngs) };
        } else {
            var latlng = layer.getLatLng();
            var radius = layer.getRadius();

            postData[i] = { 'data': { 'geom_x': latlng.lng, 'geom_y': latlng.lat, 'radius': radius } };
        }
    }

    var bin = [];
    for (var i = 0; i < layers.length; i++) {
        bin[i] = _.has(layers[i], '_mRadius') ? _.first(turf.buffer(layers[i].toGeoJSON(), layers[i].getRadius(), 'meters').features) : layers[i].toGeoJSON();
    }

    var merge = turf.merge(turf.featurecollection(bin));
    var area = turf.area(merge);
    var geomData = { area: area, geojson: merge.geometry };
    callDatas(postData, geomData);
}

m.DrawControl = DrawControl;
m.TileWMS = TileWMS;

var appMap = new Map();
$(document).ready(function () {
    if ($('#div_map').length) {
        appMap.init();
    };

    // setTimeout(() => {
    //
    // }, 3000)
});

var FORMAT = "image/png8";
var TRANSPARENT = true;
var TILED = true;
var interval_created = false;
var features_time_counter = 0;
var VERSION = "1.1.0";

// proj4.defs("urn:ogc:def:crs:EPSG::32648", "+proj=utm +zone=48 +ellps=WGS84
// +datum=WGS84 +units=m +no_defs");

var CRS = L.CRS.EPSG4326;

/**
 * Hàm dùng để add 1 WMS layer mới, lu
 *
 * @map biến lưu giữ bản đồ
 * @param layername
 *            Tên lớp, bao gồm workspace:layername
 */
function getCurrentBoundStr() {
    var boundStr = '';
    var mapBound = map.getBounds();
    var leftbottom = mapBound._southWest;
    var righttop = mapBound._northEast;
    boundStr += righttop.lng + ' ' + righttop.lat + ',';
    boundStr += leftbottom.lng + ' ' + righttop.lat + ',';
    boundStr += leftbottom.lng + ' ' + leftbottom.lat + ',';
    boundStr += righttop.lng + ' ' + leftbottom.lat + ',';
    boundStr += righttop.lng + ' ' + righttop.lat;
    return boundStr;
}

function create_New_WMS_Layer(map, layername, attribution, featurename) {
    var layer = new L.TileLayer.BetterWMS(GEOSERVER_ADDRESS, {
        layers: layername,
        featureName: featurename,
        format: FORMAT,
        transparent: TRANSPARENT,
        attribution: attribution,
        tiled: true,
        version: VERSION,
        maxZoom: 25
    });

    return layer;
}

function create_WMS_Layer(map, layername, attribution, featurename) {
    var layer = new L.TileLayer.WMS(GEOSERVER_ADDRESS, {
        layers: layername,
        format: FORMAT,
        featureName: featurename,
        transparent: TRANSPARENT,
        attribution: attribution,
        tiled: true,
        version: VERSION,
        maxZoom: 25
    });

    return layer;
}

function panTo(lat, lng, zoom) {
    zoom = typeof zoom == 'undefined' ? 17 : zoom;
    map.panTo(L.latLng(lat, lng), {
        animation: true
    });
    //'map.setView(L.latLng(lat, lng), zoom);
    map.setZoom(zoom);
    map.fireEvent('click', { latlng: [lat, lng] });
}

function panToNotFire(lat, lng, zoom) {
    zoom = typeof zoom == 'undefined' ? 17 : zoom;
    map.panTo(L.latLng(lat, lng), {
        animation: true
    });
    map.setZoom(zoom);
}

function panToLatlng(latlng) {
    map.panTo(latlng, {
        animation: true
    });
    //map.setView(latlng, 17);
    map.setZoom(17);
    map.fireEvent('click', { latlng: [latlng.lat, latlng.lng] });
}

/**
 * @description split POINT(x y) to get x y
 * @param {type} input
 * @returns {undefined}
 */
var marker_group_onpan = null;
function panToByGeometry(input, remove_group) {
    //    try {
    // split ( to get "x y)"
    var splitedString = input.split("(");
    // split ) to get x y
    splitedString = splitedString[1].split(")");
    // split to get x y
    splitedString = splitedString[0].split(" ");

    var lat = splitedString[1];
    var lng = splitedString[0];
    var latlng = convertUTMToLatLng(lat, lng);

    panToLatlng(latlng);

    if (marker_group_onpan === null) {
        marker_group_onpan = L.featureGroup().addTo(map);
    }
    remove_group = typeof remove_group === 'undefined' ? false : remove_group;
    if (remove_group) {
        marker_group_onpan.clearLayers();
    }
    marker_group_onpan.addLayer(L.marker(L.latLng(latlng)));
}

function getLatLng(input) {
    try {
        // split ( to get "x y)"
        var splitedString = input.split("(");
        // split ) to get x y
        splitedString = splitedString[1].split(")");
        // split to get x y
        splitedString = splitedString[0].split(" ");
        var lat = splitedString[1];
        var lng = splitedString[0];

        return [lat, lng];
    } catch (ex) {
        return [];
    }
}

function getStringFromLatLngs(latlngs) {
    var resStr = '';
    for (var i = 0; i < latlngs.length; i++) {
        resStr += ' ' + latlngs[i].lng + ' ' + latlngs[i].lat;
        //if (i < latlngs.length - 1) {
        resStr += ',';
        //}
    }

    resStr += latlngs[0].lng + ' ' + latlngs[0].lat;

    return resStr;
}

function initContextMenu() {
    return {
        contextmenu: true,
        contextmenuWidth: 200,
        contextmenuItems: [{
            text: 'Thêm mới điểm thông tin',
            callback: createNewCabenh,
            icon: BASE_URL + 'resources/app/images/create_new.png'
        }]
    };
}

function createNewCabenh(e) {
    var latlng = e.latlng;
    var _target = $('#id_btn_create_rp');
    _target.attr('data-rp-x', latlng.lat);
    _target.attr('data-rp-y', latlng.lng);
    _target.click();
}

function initMapControl() {
    L.control.measure({ position: 'topright' }).addTo(map);
    map.addControl(L.control.zoom({ position: 'topright' }));
}

var layerOpenStreetMap, layerDichte, layerRtPoint, layerCabenh, layerVungdich, layerQtiles, layerRanhto, layerVungbenh;
var maplayers = [];

var currentlayer = 'v_cabenh',
    layerMapThongke,
    layerRanhquan;

var preLayer = null;
var drawControl = null;

function callDatas(postData, geomData) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'geo/dichte-in-polygon',
        data: { 'data': postData, 'sql': MAP_USER_FILTER, geomData: geomData },
        success: function success(html) {
            callPopup(html);
        }
    });
}
var check_khuvucdieutra = false;
function callData(latlngs, data) {
    if (!check_khuvucdieutra) {
        $.ajax({
            url: BASE_URL + 'geo/dichte-in-polygon',
            data: latlngs !== null ? { 'bound': getStringFromLatLngs(latlngs), 'sql': MAP_USER_FILTER } : { 'data': data, 'sql': MAP_USER_FILTER },
            success: function success(html) {
                callPopup(html);
            }
        });
    } else {
        $.ajax({
            url: BASE_URL + 'geo/rt-in-polygon',
            data: latlngs !== null ? { 'bound': getStringFromLatLngs(latlngs), 'sql': MAP_USER_FILTER } : { 'data': data, 'sql': MAP_USER_FILTER },
            success: function success(html) {
                callPopup(html);
            }
        });
    }
}

function openPanel() {}

function callPopup(content) {
    if (features_time_counter > 0) {
        return;
    }
    if (content != '') {
        //features_time_counter = 1;
        //L.popup().setLatLng(latlng).setContent(content).openOn(map);
        //uiUpdate('.leaflet-popup-content-wrapper');
        document.getElementById("info").innerHTML = content;
        uiUpdate('.leaflet-popup-content-wrapper');
        $("#feature_infos").stop();
        $("#feature_infos").fadeIn("fast");
        uiUpdate('#feature_infos');
    }
}
////////
/**
 * Thank Ryan Clark for the codes of getFeatureInfo using leaflet.js
 * https://gist.github.com/rclark
 */
var feature_info_popup = null;
var addedLayers = L.layerGroup();
L.TileLayer.BetterWMS = L.TileLayer.WMS.extend({
    onAdd: function onAdd(map) {

        // Triggered when the layer is added to a map.
        // Register a click listener, then do all the upstream WMS things
        L.TileLayer.WMS.prototype.onAdd.call(this, map);
        addedLayers.addLayer(this);
        map.on('click', this.getFeatureInfo, this);
    },
    onRemove: function onRemove(map) {
        // Triggered when the layer is removed from a map.
        // Unregister a click listener, then do all the upstream WMS things
        L.TileLayer.WMS.prototype.onRemove.call(this, map);
        addedLayers.removeLayer(this);
        map.off('click', this.getFeatureInfo, this);
    },
    getFeatureInfo: function getFeatureInfo(evt) {
        // Log
        // Make an AJAX request to the server and hope for the best
        var url = this.getFeatureInfoUrl(evt.latlng),
            showResults = L.Util.bind(this.showGetFeatureInfo, this);

        console.log(url);

        $.ajax({
            url: url,
            success: function success(data, status, xhr) {
                var err = typeof data === 'string' ? null : data;
                showResults(err, evt.latlng, data);
            },
            error: function error(xhr, status, _error) {
                showResults(_error);
            }
        });
    },
    getFeatureInfoUrl: function getFeatureInfoUrl(latlng) {
        /**
         * Đoạn code sửa cho phù hợp với geoserver 2.4.4 (còn 1 đoạn nữa bên wmsgetfeatureinfo_control_data_processing.js);
         */
        var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom());
        var size = this._map.getSize();
        var params = {
            CQL_FILTER: typeof this.wmsParams.CQL_FILTER != 'undefined' ? this.wmsParams.CQL_FILTER : '1=1',
            request: 'GetFeatureInfo',
            service: 'WMS',
            srs: L.CRS.EPSG4326.code,
            styles: this.wmsParams.styles,
            transparent: this.wmsParams.transparent,
            version: this.wmsParams.version,
            format: this.wmsParams.format,
            bbox: this._map.getBounds().toBBoxString(),
            height: size.y,
            width: size.x,
            layers: this.wmsParams.layers,
            query_layers: this.wmsParams.layers,
            info_format: 'text/html',
            feature_count: 100
        };
        params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
        params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;

        return this._url + L.Util.getParamString(params, this._url, true);
    },
    showGetFeatureInfo: function showGetFeatureInfo(err, latlng, content) {
        // Add content to empty div
        var _div_tmp = $('#div_tmp');
        _div_tmp.empty().append(content);

        // Get feature name and pass to call matching function
        var _feature_name = $('#div_tmp caption.featureInfo').text();
        //if  (_feature_name == currentlayer)
        content = getFeatureInforContentFactory(content);

        console.log(content);

        callPopup(content);
        //        // convert response geoserver content to popup content
        //        feature_info_popup = L.popup({maxWidth: 800})
        //                .setLatLng(latlng);
        //        content = wmsgetfeatureinfo_control_data_process(feature_info_popup, content);
        //        if (content === '') {
        //            return;
        //        }
        //        if (err) {
        //            console.log(err);
        //            return;
        //        } // do nothing if there's an error
        //        // Otherwise show the content in a popup, or something.
        //
        //        // Log
        //        feature_info_popup
        //                .setContent(content)
        //                .openOn(this._map);
    }
});

function getFeatureInforContentFactory(content) {
    var result = window['getFeatureInforv_cabenh']();
    result += window['getFeatureInforv_vungbenh']();
    return result;
}
function getFeatureInforFromListProp(props, id, name) {
    if ($(props[0].selector).length > 1) return getFeatureInforFromListPropOver2(props, id, name);else return getFeatureInforFromListPropOne(props, id, name);
}

function getFeatureInforFromListPropOne(props, id, name) {
    var result = '<div id="map_popup" style="width: 100%; overflow: auto"><table class="table table-condensed table-triped table-hover">';
    var empty = true;
    for (var i = 0; i < props.length; i++) {
        if ($(props[i].selector).text() !== '') {
            empty = false;
        }
        result += '<tr>';
        result += '<td><b>' + props[i].name + '</b></td><td>&nbsp;</td><td>';
        //result += props[i].formatter === 'number' ? Number($(props[i].selector).text()).format(2, 3, '.', ',') : $(props[i].selector).text();
        result += formatter(props[i].formatter, $($(props[i].selector)[0]).text());
        result += '</td>';
        result += '</tr>';
    }

    var idvalue = $($(id)).text();
    var namevalue = $($(name)).text();

    if (currentlayer == 'v_cabenh') {
        result += '<tr><td>';
        result += '<a class="custom-reload-ajax-div custom-expand-sidebar" data-url="' + BASE_URL + 'dichte/cabenh1/index?partial=true&onmap=true&sort=loai_dich&Cabenh1Search[macabenh]=' + idvalue + '" data-target="#id_div_cabenh">Cập nhật thông tin</a>';
        result += '</tr></td';
    }

    result += '</table></div>';

    return empty ? '' : result;
}

function getFeatureInforFromListPropOver2(props, id, name) {
    var result = '<div id="map_popup" style="width: 100%; overflow: auto"><table class="table table-condensed table-triped table-hover">';
    var trs = '';
    var ths = '';
    var columns = props.length;
    if (columns > 0) {
        ths += '<tr>';
        for (var i = 0; i < columns; i++) {
            ths += '<td><b>' + props[i].name + '</b></td>';
        }
        ths += '</tr>';
        var rows = $(props[0].selector).length;
        for (var i = 0; i < rows; i++) {
            trs += '<tr>';
            for (var j = 0; j < columns; j++) {
                var text = $($(props[j].selector)[i]).text();
                trs += '<td>' + formatter(props[j].formatter, text) + '</td>';
            }
            var idvalue = $($(id)[i]).text();
            var namevalue = $($(name)[i]).text();
            trs += '</tr>';
        }
    }

    result += ths + trs + '</table></div>';

    return trs == '' ? '' : result;
}

function formatter(type, value) {
    if (typeof type == 'undefined') {
        return value;
    }
    if (type === 'number') {
        return Number(value).format(2, 3, '.', ',');
    } else if (type === 'integer') {
        return Number(value).format(0, 3, '.', ',');
    } else if (type.indexOf('date') > -1) {
        var arrFormat = type.split('::');
        var format = arrFormat[1];
        return Date.parseExact(value, format);
    }
}

function getFeatureInforv_cabenh() {
    var result = getFeatureInforFromListProp([{ name: 'Họ tên', selector: '.v_cabenh_hoten' }, { name: 'Ngày mắc bệnh', selector: '.v_cabenh_ngaymacbenh' }, { name: 'Ngày nhập viện', selector: '.v_cabenh_ngaynhapvien' }, { name: 'Chuẩn đoán', selector: '.v_cabenh_chuandoan_xv' }], '.v_cabenh_macabenh', '.v_cabenh_hoten');
    return result;
}

function getFeatureInforv_vungbenh() {
    var result = getFeatureInforFromListProp([{ name: 'Họ tên', selector: '.v_vungbenhhoten' }, { name: 'Mã ICD', selector: '.v_vungbenh_ma_icd' }, { name: 'Tổ ảnh hưởng 200m', selector: '.v_vungbenh_totiepgiap' }, { name: 'Tổng diện tích tổ', selector: '.v_vungbenh_dientichto', formatter: 'number' }, { name: 'Ngày mắc bệnh', selector: '.v_vungbenh_ngaymacbenh' }, { name: 'Ngày nhập viện', selector: '.v_vungbenh_ngangnhapvien' }, { name: 'Chuẩn đoán', selector: '.v_vungbenh_chuandoan' }, { name: 'Tên phường', selector: '.v_vungbenh_ten_phuong' }, { name: 'Tên quận', selector: '.v_vungbenhh_ten_quan' }, { name: 'Loại dịch', selector: '.v_vungbenh_loai_dich' }], '.v_vungbenh_macabenh', '.v_vungbenh_hoten');
    return result;
}

function getFeatureInforrt_point() {
    var result = getFeatureInforFromListProp([{ name: 'Họ tên', selector: '.v_cabenh_hoten' }, { name: 'Mã ICD', selector: '.v_cabenh_ma_icd' }, { name: 'Ngày mắc bệnh', selector: '.v_cabenh_ngaymacbenh' }, { name: 'Ngày nhập viện', selector: '.v_cabenh_ngangnhapvien' }, { name: 'Chuẩn đoán', selector: '.v_cabenh_chuandoan' }, { name: 'Tên phường', selector: '.v_cabenh_ten_phuong' }, { name: 'Tên quận', selector: '.v_cabenh_ten_quan' }], '.v_cabenh_macabenh', '.v_cabenh_hoten');
    return result;
}

function createMatcatLink(url, ten_vn) {
    var result = '';
    if (ten_vn !== '') {
        result += "<a class='pointer-cursor custom-button-ajax-call custom-button-trigger-other custom-change-label' " + "data-change-target='#span_tenkenh' data-change-content='" + ten_vn + "' " + "data-trigger-target='#btn_toggle_matcat' " + "data-url='" + url + "' data-target-div='#div_matcat'>Xem mặt cắt</a>";
    }
    return result;
}

function getFeatureInfordichte() {
    return [];
}

function getFeatureInforrt_point() {
    return [];
}

function convertUTMToLatLng(lat, lng) {
    var UTM48 = "+proj=utm +zone=48 +ellps=WGS84 +datum=WGS84 +units=m +no_defs";
    var LATLNG = "+proj=longlat +ellps=WGS84 +datum=WGS84 +no_defs ";
    var result = proj4(LATLNG, LATLNG, [lng, lat]);
    var latlng = L.latLng(result[1], result[0]);
    console.log(latlng);
    return latlng;
}

///// APP JS
var layerRanhphuong;
function getInitRanhphuong() {
    maplayers['layerRanhphuong'] = layerRanhphuong = create_New_WMS_Layer(map, 'dichte:dm_phuong', '', 'dm_phuong');
    checkRanhphuong();

    return layerRanhphuong;
}

var filterPhuongquan = '';
function checkRanhphuong() {

    $.ajax({
        url: BASE_URL + 'geo/ranhphuong',
        success: function success(data) {
            data = JSON.parse(data);

            if (data.filter != '') {
                MAP_USER_FILTER.ranh_phuong = '(' + data.filter + ')';
                data.filter = filterMapBySelect();
                layerRanhphuong.setParams({ CQL_FILTER: data.filter });
                layerCabenh.setParams({ CQL_FILTER: filterMapBySelect() });
            }

            if (data.geo.lat != '') {
                panTo(data.geo.lat, data.geo.lng, 17);
                // map.setMaxBounds(map.getBounds());

                map.addLayer(layerRanhphuong);
                map.addLayer(layerCabenh);
            }
        }
    });
}

function filterMapBySelect() {
    var filter = '1 = 1';
    for (var key in MAP_USER_FILTER) {
        filter += ' and ' + MAP_USER_FILTER[key];
    }
    return filter;
}

//# sourceMappingURL=core-map-compiled.js.map