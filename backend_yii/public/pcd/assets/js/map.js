var map;

// Cấu hình dùng cho khởi tạo WMS layer.
if(typeof BASE_URL === 'undefined' || BASE_URL=='/'){
    console.warn('Lỗi đường dẫn BASE URL');
    var GEOSERVER_ADDRESS = "http://pcd.hcmgis.vn/geoserver/wms";
} else {
    var GEOSERVER_ADDRESS = BASE_URL + "../../geoserver/wms";
}


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
 * Tọa độ trung tâm của bản đồ khi load lần đầu tiên
 */
//lat: 10.916204452514648
//lng: 106.7636775970459
var CENTER = L.latLng(10.8556284832574, 106.744985842335);

/**
 * Mức zoom khi lần đầu tiên load bản đồ
 */
var ZOOM = 13;


// call init function 
$(document).ready(function () {
   initializeMap();
});


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
        maxZoom: 25,
    });

    return layer;
}

function panTo(lat, lng, zoom) {
    zoom = typeof(zoom) == 'undefined' ? 17 : zoom;
    map.panTo(L.latLng(lat, lng), {
        animation: true
    });
    //'map.setView(L.latLng(lat, lng), zoom);
    map.setZoom(zoom);
    map.fireEvent('click', {latlng: [lat, lng]});
}

function panToNotFire(lat, lng, zoom) {
    zoom = typeof(zoom) == 'undefined' ? 17 : zoom;
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
    map.fireEvent('click', {latlng: [latlng.lat, latlng.lng]});
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
    remove_group = typeof (remove_group) === 'undefined' ? false : remove_group;
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

function initializeMap() {
    if ($('#div_map').size() > 0) {
        var mapOptions = $.extend(initContextMenu(), {
            fullscreenControl: true,
        })
        map = new L.Map('div_map', mapOptions);
        map.on('click', function (e) {
            //console.log(e);
        });
        map.setView(CENTER, ZOOM);
        // Init map layer
        initMapLayer();
        // Init map control
        initMapControl();
    }
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
    var _target =  $('#id_btn_create_rp');
    _target.attr('data-rp-x', latlng.lat);
    _target.attr('data-rp-y', latlng.lng);
    _target.click();
}

function initMapControl() {
    L.control.measure({position: 'topright'}).addTo(map);
    map.addControl(L.control.zoom({position: 'topright'}));
    initDrawControl();
}

var layerOpenStreetMap, layerDichte, layerRtPoint, layerCabenh, layerVungdich,layerQtiles, layerRanhto, layerVungbenh;
var maplayers = [];

var currentlayer = 'v_cabenh', layerMapThongke, layerRanhquan;
var dichteGroup;

function initMapLayer() {

    maplayers['layerOpenStreetMap'] = layerOpenStreetMap =  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    });
    //maplayers['layerDichte'] = layerDichte = create_New_WMS_Layer(map, 'dichte:dichte', '', 'dichte');
    maplayers['layerCabenh'] = layerCabenh = create_New_WMS_Layer(map, 'dichte:v_cabenh', '', 'v_cabenh');
    maplayers['layerRanhto'] = layerRanhto = create_New_WMS_Layer(map, 'dichte:ranh_to', '', 'ranh_to');
    maplayers['layerRanhquan'] = layerRanhquan = create_New_WMS_Layer(map, 'dichte:dm_quan', '', 'dm_quan');
    maplayers['layerRtPoint'] = layerRtPoint = create_New_WMS_Layer(map, 'dichte:rt_point', '', 'rt_point');
    maplayers['layerVungdich'] = layerVungdich = create_New_WMS_Layer(map, 'dichte:v_vungdich', '', 'v_vungdich');
    maplayers['layerVungbenh'] = layerVungbenh = create_New_WMS_Layer(map, 'dichte:v_vungbenh', '' , 'v_vungbenh');
    maplayers['layerQtiles'] = layerQtiles = L.tileLayer('http://hcmgisportal.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg', {
         maxZoom: 20,
        tms: false,
        attribution: 'Generated by QTiles'
    });

    var ranhnha = L.esri.dynamicMapLayer({
        url: 'http://hcmgisportal.vn:6080/arcgis/rest/services/BaseMap_HCM/MapServer',
        opacity: 0.7,
        useCors: false,
    });

    var baseLayers = {
        "Ảnh hàng không": layerQtiles,
        "Bản đồ giao thông": layerOpenStreetMap,
    };

    var overLayers = {
        //'Bản đồ dịch tể' : layerDichte,
        'Ca bệnh': layerCabenh,
        'Ranh tổ': layerRanhto,
        'Ranh nhà': ranhnha,
        'Điểm thửa': layerRtPoint,
        'Ranh phường': getInitRanhphuong(),
        'Ranh quận': layerRanhquan,
        'Bản đồ vùng dịch': layerVungbenh
    };

    dichteGroup = new L.featureGroup();
    layerMapThongke = new L.featureGroup();


    L.control.layers(baseLayers, overLayers).addTo(map);

    map.addLayer(layerOpenStreetMap, true);
    map.addLayer(layerMapThongke);

    dichteGroup.addTo(map);
}

var preLayer = null;
var drawControl = null;
var drawnItems; //= new L.FeatureGroup();
var drawnItemsOnMap;// = new L.FeatureGroup();
function initDrawControl() {
    // Initialise the FeatureGroup to store editable layers
    drawnItems = new L.FeatureGroup();
    drawnItemsOnMap = new L.FeatureGroup();
    drawnItemsOnMap.setZIndex(1000);
    map.addLayer(drawnItemsOnMap);
    // Initialise the draw control and pass it the FeatureGroup of editable layers


    var drawLocale = {
        draw: {
            toolbar: {
                actions: {
                    title: 'Hủy bỏ', // Cancel drawing
                    text: 'Hủy bỏ' // Cancel
                },
                undo: {
                    title: 'Xóa điểm đã vẽ cuối cùng', //Delete last point drawn
                    text: 'Xóa điểm cuối cùng', //Delete last point'
                },
                buttons: {
                    polyline: 'Vẽ đường', // Draw a polyline
                    polygon: 'Vẽ đa giác', // Draw a polygon
                    rectangle: 'Vẽ hình chữ nhật', // Draw a rectangle
                    circle: 'Vẽ đường tròn', // Draw a circle
                    marker: 'Thêm điểm', // Draw a marker
                },
                finish: {
                    title: 'Kết thúc',
                    text: 'Kết thúc',
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
                        end: 'Click điểm đầu để khép hình', // 'Click first point to close this shape.'
                    }
                },
                polyline: {
                    error: '<strong>Lỗi:</strong> Các cạnh không được bắt chéo!' , // '<strong>Error:</strong> shape edges cannot cross!',
                    tooltip: {
                        start: 'Click để bắt đầu vẽ đường', // Click to start drawing line.
                        cont: 'Click để tiếp tục vẽ đường', // Click to continue drawing line.
                        end: 'Click điểm cuỗi để kết thúc đường'// Click last point to finish line.
                    }
                },
                rectangle: {
                    tooltip: {
                        start: 'Click và kéo chuột để vẽ hình chữ nhật', // Click and drag to draw rectangle
                    }
                },
                simpleshape: {
                    tooltip: {
                        end: 'Thả chuột để kết thúc'// Release mouse to finish drawing.
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
                        title: 'Hủy bỏ chỉnh sửa, bỏ tất cả những thay đổi',// Cancel editing, discards all changes.
                        text: 'Hủy bỏ' // Cancel
                    }
                },
                buttons: {
                    buffer: 'Mở rộng lớp', // Expand layers.
                    bufferDisabled: 'Không có lớp để mở rộng', // No layers to expand.
                    edit: 'Xóa lớp', // Edit layers.
                    editDisabled: 'Không có lớp để chỉnh sửa', //No layers to edit.
                    remove: 'Xóa lớp', //Delete layers.
                    removeDisabled: 'Không có lớp để xóa', // No layers to delete.
                }
            },
            handlers: {
                buffer: {
                    tooltip: {
                        text: 'Click và kéo chuột để mở rộng hoặc thu hẹp hình'// Click and drag to expand or contract a shape.
                    }
                },
                edit: {
                    tooltip: {
                        text: 'Kéo chuột hoặc đánh dấu để chỉnh sửa đối tượng', // Drag handles, or marker to edit feature.
                        subtext: 'Click hủy bỏ để quay lại', // Click cancel to undo changes.
                    }
                },
                remove: {
                    tooltip: {
                        text: 'Click lên đối tượng để xóa' // Click on a feature to remove
                    }
                }
            }
        }
    };
    L.drawLocal = drawLocale;


    drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItemsOnMap,
            remove: true,
            buffer: {
                replace_polylines: false,
                separate_buffer: false
            }
        },
        position: 'topright',
        draw: {polyline: {metric: true}, marker: false, rectangle: false, circle: {metric: true},
            polygon: {
                showArea: true
            }}
    });
    map.addControl(drawControl);
    map.on('draw:created', function (e) {
        editDraw(e, true);
    });
    map.on('draw:edited', function (e) {
        editDraw(e, false);
    });
}

function editDraw(e, create) {
    var type = e.layerType,
            layer = e.layer;



    // Do whatever else you need to. (save to db, add to 2map etc)
//        drawnItemsOnMap.clearLayer();
    //if (preLayer !== null)
        //drawnItemsOnMap.removeLayer(preLayer);
    if (create)
        drawnItemsOnMap.addLayer(layer);
    //preLayer = layer;
    var layers = drawnItemsOnMap.getLayers();
    var postData = [];
    for(var i = 0; i< layers.length; i++) {
        layer = layers[i];

        if (typeof(layer._mRadius) === 'undefined') {
            var latlngs = layer.getLatLngs();
            postData[i] = {'bound': getStringFromLatLngs(latlngs)};
        } else {
            var latlng = layer.getLatLng();
            var radius = layer.getRadius();

            postData[i] =  {'data' : {'geom_x': latlng.lng, 'geom_y':latlng.lat , 'radius' : radius}};
        }
    }

    var bin = [];
    for(var i = 0; i< layers.length; i++) {
        bin[i] = _.has(layers[i], '_mRadius') ? _.first(turf.buffer(layers[i].toGeoJSON(), layers[i].getRadius(), 'meters').features) : layers[i].toGeoJSON();
    }

    var merge = turf.merge(turf.featurecollection(bin));
    var area = turf.area(merge);
    var geomData = {area: area, geojson: merge.geometry};
    callDatas(postData, geomData);

}
function callDatas(postData, geomData) {
      $.ajax({
            type: 'POST',
            url: BASE_URL + 'geo/dichte-in-polygon',
            data: {'data': postData, 'sql': MAP_USER_FILTER, geomData: geomData},
            success: function (html) {
                callPopup(html);
            }
        });
}
var check_khuvucdieutra = false;
function callData(latlngs, data) {
    if (!check_khuvucdieutra) {
        $.ajax({
            url: BASE_URL + 'geo/dichte-in-polygon',
            data: latlngs !== null ?  {'bound': getStringFromLatLngs(latlngs), 'sql': MAP_USER_FILTER} : {'data' : data, 'sql': MAP_USER_FILTER},
            success: function (html) {
                callPopup(html);
            }
        })
    } else {
        $.ajax({
            url: BASE_URL + 'geo/rt-in-polygon',
            data: latlngs !== null ?  {'bound': getStringFromLatLngs(latlngs), 'sql': MAP_USER_FILTER} : {'data' : data, 'sql': MAP_USER_FILTER},
            success: function (html) {
                callPopup(html);
            }
        })
    }
}

function openPanel() {
    
}

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
    onAdd: function (map) {
        
        // Triggered when the layer is added to a map.
        // Register a click listener, then do all the upstream WMS things
        L.TileLayer.WMS.prototype.onAdd.call(this, map);
        addedLayers.addLayer(this);
        map.on('click', this.getFeatureInfo, this);
    },
    onRemove: function (map) {
        // Triggered when the layer is removed from a map.
        // Unregister a click listener, then do all the upstream WMS things
        L.TileLayer.WMS.prototype.onRemove.call(this, map);
        addedLayers.removeLayer(this);
        map.off('click', this.getFeatureInfo, this);
    },
    getFeatureInfo: function (evt) {
        // Log
        // Make an AJAX request to the server and hope for the best
        var url = this.getFeatureInfoUrl(evt.latlng),
                showResults = L.Util.bind(this.showGetFeatureInfo, this);

        
        $.ajax({
            url: url,
            success: function (data, status, xhr) {
                var err = typeof data === 'string' ? null : data;
                showResults(err, evt.latlng, data);
            },
            error: function (xhr, status, error) {
                showResults(error);
            }
        });

    },
    getFeatureInfoUrl: function (latlng) {
        /**
         * Đoạn code sửa cho phù hợp với geoserver 2.4.4 (còn 1 đoạn nữa bên wmsgetfeatureinfo_control_data_processing.js);
         */
        var point = this._map.latLngToContainerPoint(latlng, this._map
                .getZoom());
        var size = this._map.getSize();
        var params = {
            CQL_FILTER: typeof(this.wmsParams.CQL_FILTER) != 'undefined' ? this.wmsParams.CQL_FILTER : '1=1',
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
    showGetFeatureInfo: function (err, latlng, content) {
        // Add content to empty div
        var _div_tmp = $('#div_tmp');
        _div_tmp.empty().append(content);

        // Get feature name and pass to call matching function
        var _feature_name = $('#div_tmp caption.featureInfo').text();
        //if  (_feature_name == currentlayer)
        content = getFeatureInforContentFactory(content);

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
    if ($(props[0].selector).length > 1)
        return getFeatureInforFromListPropOver2(props, id, name);
    else
        return getFeatureInforFromListPropOne(props, id, name);
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

    return empty ?  '' : result;
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
    if (typeof(type) == 'undefined') {
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
    var result = getFeatureInforFromListProp([
        {name: 'Họ tên', selector: '.v_cabenh_hoten'},
        {name: 'Ngày mắc bệnh', selector: '.v_cabenh_ngaymacbenh'},
        {name: 'Ngày nhập viện', selector: '.v_cabenh_ngaynhapvien'},
        {name: 'Chuẩn đoán', selector: '.v_cabenh_chuandoan_xv'},
    ], '.v_cabenh_macabenh', '.v_cabenh_hoten');
    return result;
}

function getFeatureInforv_vungbenh() {
    var result = getFeatureInforFromListProp([
        {name: 'Họ tên', selector: '.v_vungbenhhoten'},
        {name: 'Mã ICD', selector: '.v_vungbenh_ma_icd'},
        {name: 'Tổ ảnh hưởng 200m',  selector: '.v_vungbenh_totiepgiap'},
        {name: 'Tổng diện tích tổ',  selector: '.v_vungbenh_dientichto', formatter: 'number'},
        {name: 'Ngày mắc bệnh', selector: '.v_vungbenh_ngaymacbenh'},
        {name: 'Ngày nhập viện', selector: '.v_vungbenh_ngangnhapvien'},
        {name: 'Chuẩn đoán', selector: '.v_vungbenh_chuandoan'},
        {name: 'Tên phường', selector: '.v_vungbenh_ten_phuong'},
        {name: 'Tên quận', selector: '.v_vungbenhh_ten_quan'},
        {name: 'Loại dịch', selector: '.v_vungbenh_loai_dich'}
    ], '.v_vungbenh_macabenh', '.v_vungbenh_hoten');
    return result;
}

function getFeatureInforrt_point() {
    var result = getFeatureInforFromListProp([
        {name: 'Họ tên', selector: '.v_cabenh_hoten'},
        {name: 'Mã ICD', selector: '.v_cabenh_ma_icd'},
        {name: 'Ngày mắc bệnh', selector: '.v_cabenh_ngaymacbenh'},
        {name: 'Ngày nhập viện', selector: '.v_cabenh_ngangnhapvien'},
        {name: 'Chuẩn đoán', selector: '.v_cabenh_chuandoan'},
        {name: 'Tên phường', selector: '.v_cabenh_ten_phuong'},
        {name: 'Tên quận', selector: '.v_cabenh_ten_quan'},
    ], '.v_cabenh_macabenh', '.v_cabenh_hoten');
    return result;
}


function createMatcatLink(url, ten_vn) {
    var result = '';
    if (ten_vn !== '') {
        result += "<a class='pointer-cursor custom-button-ajax-call custom-button-trigger-other custom-change-label' "
                + "data-change-target='#span_tenkenh' data-change-content='" + ten_vn + "' "
                + "data-trigger-target='#btn_toggle_matcat' "
                + "data-url='" + url + "' data-target-div='#div_matcat'>Xem mặt cắt</a>";
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
        url : BASE_URL + 'geo/ranhphuong',
        success: function (data) {
            data = JSON.parse(data);
            if (data.filter != '') {
                MAP_USER_FILTER.ranh_phuong = '(' + data.filter + ')';
                data.filter = filterMapBySelect();
                layerRanhphuong.setParams({CQL_FILTER: data.filter});
                layerCabenh.setParams({CQL_FILTER: filterMapBySelect()});
                
            }

            if (data.geo.lat != '') {
                panTo(data.geo.lat, data.geo.lng, 17);
                // map.setMaxBounds(map.getBounds());

                map.addLayer(layerRanhphuong);
                map.addLayer(layerCabenh);
            }
        }
    })
}

    function filterMapBySelect() {
        var filter = '1 = 1';
        for(var key in MAP_USER_FILTER) {
            filter += ' and ' + MAP_USER_FILTER[key];
        }
        return filter;
    }

