webpackHotUpdate(0,{

/***/ 1434:
/***/ (function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(module) {'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	
	var _extends2 = __webpack_require__(884);
	
	var _extends3 = _interopRequireDefault(_extends2);
	
	var _getPrototypeOf = __webpack_require__(1394);
	
	var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);
	
	var _classCallCheck2 = __webpack_require__(1115);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _createClass2 = __webpack_require__(1397);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	var _possibleConstructorReturn2 = __webpack_require__(1116);
	
	var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);
	
	var _inherits2 = __webpack_require__(1139);
	
	var _inherits3 = _interopRequireDefault(_inherits2);
	
	var _react2 = __webpack_require__(297);
	
	var _react3 = _interopRequireDefault(_react2);
	
	var _reactTransformHmr3 = __webpack_require__(1401);
	
	var _reactTransformHmr4 = _interopRequireDefault(_reactTransformHmr3);
	
	var _class, _temp;
	
	var _reactDom = __webpack_require__(335);
	
	var _reactRedux = __webpack_require__(485);
	
	var _reactResolver = __webpack_require__(516);
	
	var _lodash = __webpack_require__(1056);
	
	var _map = __webpack_require__(1435);
	
	var _PopCabenh = __webpack_require__(1488);
	
	var _PopCabenh2 = _interopRequireDefault(_PopCabenh);
	
	var _sxhActions = __webpack_require__(1489);
	
	var _utils = __webpack_require__(1490);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	var _components = {
	    MapLayout: {
	        displayName: 'MapLayout'
	    }
	};
	
	var _reactTransformHmr2 = (0, _reactTransformHmr4.default)({
	    filename: 'D:/LARAGON/www/PROJECT/dichte/web/core/modules/react-map/app/components/MapLayout.js',
	    components: _components,
	    locals: [module],
	    imports: [_react3.default]
	});
	
	function _wrapComponent(id) {
	    return function (Component) {
	        return _reactTransformHmr2(Component, id);
	    };
	}
	
	var BaseLayer = _map.LayersControl.BaseLayer,
	    Overlay = _map.LayersControl.Overlay;
	
	
	var formatDate = function formatDate(date) {
	    var fromD = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'DD-MM-YYYY';
	    var toD = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'YYYY/MM/DD';
	
	    return moment(date, fromD).format(toD);
	};
	
	var MapLayout = _wrapComponent('MapLayout')((_temp = _class = function (_Component) {
	    (0, _inherits3.default)(MapLayout, _Component);
	
	    function MapLayout(props, context) {
	        (0, _classCallCheck3.default)(this, MapLayout);
	
	        var _this = (0, _possibleConstructorReturn3.default)(this, (MapLayout.__proto__ || (0, _getPrototypeOf2.default)(MapLayout)).call(this, props, context));
	
	        _this.showGetFeatureInfo = function (err, latlng, content) {
	            if (!content.features.length) {
	                return;
	            };
	            var model = (0, _lodash.head)(content.features).properties;
	
	            _this.props.updateSxhModel((0, _extends3.default)({}, model, { from: 'map' }));
	        };
	
	        _this.showPopup = function (model) {
	            var pin = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
	
	            _this.setState({
	                popCabenh: _react3.default.createElement(_PopCabenh2.default, { pin: pin, data: model })
	            });
	        };
	
	        _this.settings = context.srvData.settings;
	        _this.hanhchinh = context.srvData.hanhchinh;
	        _this.layerUrl = context.srvData.layerUrl;
	
	        _this.state = {
	            popCabenh: null
	        };
	
	        return _this;
	    }
	
	    (0, _createClass3.default)(MapLayout, [{
	        key: 'componentWillMount',
	        value: function componentWillMount() {
	            this.envCabenh = this.getEnvCabenh();
	            this.cqlPhuong = this.getCqlPhuong();
	            console.log(cqlPhuong);
	            this.legendCabenh = this.getLegend();
	        }
	    }, {
	        key: 'componentDidMount',
	        value: function componentDidMount() {
	            this.map = window.map = this.refs.map.getWrappedInstance().leafletElement;
	            setTimeout(this.initRefs.bind(this));
	        }
	    }, {
	        key: 'initRefs',
	        value: function initRefs() {
	            var deleteKvSxh = this.props.deleteKvSxh;
	            var kvGroup = this.refs.kvGroup;
	
	            this.kvGroup = kvGroup.leafletElement;
	
	            this.map.on('draw:deleted', function (e) {
	                var layers = e.layers,
	                    IDs = [];
	                layers.eachLayer(function (layer) {
	                    return IDs.push(layer.featureID);
	                });
	                deleteKvSxh(IDs);
	            });
	        }
	    }, {
	        key: 'componentWillReceiveProps',
	        value: function componentWillReceiveProps(nextProps) {
	            var googleAddr = nextProps.googleAddr,
	                flyTo = nextProps.flyTo,
	                sxh_model = nextProps.sxh_model,
	                sxh_showPopup = nextProps.sxh_showPopup,
	                sxh_filter = nextProps.sxh_filter,
	                odsxh_flyto = nextProps.odsxh_flyto;
	
	
	            if (googleAddr && googleAddr !== this.props.googleAddr) {
	                this.zoomGoogleAddr(googleAddr);
	            }
	
	            if (flyTo && flyTo !== this.props.flyTo) {
	                this.flyToLoc(flyTo);
	            }
	            if (odsxh_flyto && odsxh_flyto !== this.props.odsxh_flyto) {
	                this.map.flyToBounds(odsxh_flyto);
	            }
	        }
	    }, {
	        key: 'componentDidUpdate',
	        value: function componentDidUpdate(prevProps, prevState) {
	            var sxh_filter = this.props.sxh_filter;
	
	            if (sxh_filter && sxh_filter !== prevProps.sxh_filter) {
	                var cabenhWMS = this.refs.cabenhLayer.leafletElement;
	                var kvWMS = this.refs.kvLayer.leafletElement;
	
	                cabenhWMS.setParams({ cql_filter: this.getCqlCabenh() });
	                kvWMS.setParams({ cql_filter: this.getCqlCabenh() });
	            }
	        }
	    }, {
	        key: 'zoomGoogleAddr',
	        value: function zoomGoogleAddr(googleAddr) {
	            var _this2 = this;
	
	            var location = googleAddr.location,
	                label = googleAddr.label;
	
	            this.flyToLoc(location);
	            var marker = L.marker(location, { icon: L.icon.wave({ heartbeat: 2 }) }).bindPopup('<b>' + label, { closeButton: false }).addTo(this.map);
	            setTimeout(function () {
	                _this2.map.removeLayer(marker);
	            }, 15000);
	        }
	    }, {
	        key: 'flyToLoc',
	        value: function flyToLoc(location) {
	            // Kiểm tra nếu tọa độ k nằm TPHCM cảnh báo, k zoom;
	
	            this.map.getZoom() < 12 ? this.map.flyTo(location, 15) : this.map.flyTo(location);
	        }
	    }, {
	        key: 'getLegend',
	        value: function getLegend() {
	            var color = this.settings.map_sxh;
	
	            var legend = '\n            <div class="legend-title">Ch\xFA gi\u1EA3i</div>\n            <div class="legend-scale">\n                <ul class=\'legend-labels\'>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_7 + ';\'></span> <= 7 </li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_814 + ';\'></span> 8 - 14</li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_1521 + ';\'></span> 15 - 21</li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_2228 + ';\'></span> 22 - 28</li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_28 + ';\'></span> >= 28</li>\n                    <hr>\n                    <li> <span class="legCircle" style=\'background:#aa2672;\'></span> Zika</li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_sxv + ';\'></span> S\u1ED1t</li>\n                    <li> <span class="legCircle" style=\'background:' + color.cb_color_khac + ';\'></span> Kh\xE1c</li>\n                </ul>\n            </div>\n        ';
	            return legend;
	        }
	    }, {
	        key: 'getCqlPhuong',
	        value: function getCqlPhuong() {
	            var field = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'ma_phuong';
	            var _hanhchinh = this.hanhchinh,
	                ma_phuong = _hanhchinh.ma_phuong,
	                ma_quan = _hanhchinh.ma_quan,
	                giapranh = _hanhchinh.giapranh;
	
	            var res = [];
	            if (ma_phuong && giapranh) res.push(['(' + giapranh + ')']);
	
	            return (0, _utils.arrToCQL)(res);
	        }
	    }, {
	        key: 'getCqlCabenh',
	        value: function getCqlCabenh() {
	            var res = [],
	                resOr = [];
	            var _props$sxh_filter = this.props.sxh_filter,
	                datefrom = _props$sxh_filter.datefrom,
	                dateto = _props$sxh_filter.dateto,
	                benhnhan = _props$sxh_filter.benhnhan,
	                loaibenh = _props$sxh_filter.loaibenh;
	            var _hanhchinh2 = this.hanhchinh,
	                ma_phuong = _hanhchinh2.ma_phuong,
	                ma_quan = _hanhchinh2.ma_quan,
	                giapranh = _hanhchinh2.giapranh;
	            // Xét thời gian hiển thị ca bệnh
	
	            var timeShowCB = this.settings.map_sxh.cb_during;
	            var last3Month = moment().add(-1 * timeShowCB, 'months').format('DD/MM/YYYY');
	
	            if (ma_phuong) {
	                res.push(['ma_phuong', 'IN', '(' + giapranh + ')']);
	            }
	            if (ma_quan) {
	                res.push(['ma_quan', 'IN', '(' + giapranh + ')']);
	            }
	
	            if (datefrom) {
	                dateto = dateto ? dateto : moment().format('DD/MM/YYYY');
	
	                res.push(['ngaymacbenh_nv', '>=', '\'' + formatDate(datefrom) + '\'']);
	                res.push(['ngaymacbenh_nv', '<=', '\'' + formatDate(dateto) + '\'']);
	            } else {
	                res.push(['ngaymacbenh_nv', '>=', '\'' + formatDate(last3Month) + '\'']);
	            }
	
	            if (loaibenh && (0, _lodash.includes)(loaibenh, 'sxh')) resOr.push(['cdc_cbn_sxh', '>', 0]);
	            if (loaibenh && (0, _lodash.includes)(loaibenh, 'sot')) resOr.push(['cdc_cbn_sot', '>', 0]);
	            if (loaibenh && (0, _lodash.includes)(loaibenh, 'khac')) resOr.push(['cdc_cbn_benhkhac', '>', 0]);
	            // if(has(benhnhan, 'on')) res.push(['cdc_cbn_benhkhac', '>', 0]);
	            // if(has(benhnhan, 'off')) res.push(['cdc_cbn_benhkhac', '>', 0]);
	
	            return (0, _utils.cqlJoin)([(0, _utils.arrToCQL)(res), (0, _utils.arrToCQL)(resOr, 'or')], ' and ', '1=1');
	        }
	    }, {
	        key: 'getViewParams',
	        value: function getViewParams() {
	            var _hanhchinh3 = this.hanhchinh,
	                ma_phuong = _hanhchinh3.ma_phuong,
	                ma_quan = _hanhchinh3.ma_quan,
	                giapranh = _hanhchinh3.giapranh;
	
	            var params = [['ngaymacbenh', '' + (0, _utils.last3Month)(6)]];
	
	            if (ma_phuong) {
	                params.push(['ma_phuong', 'and ma_phuong in (' + giapranh.split(',').map(function (val) {
	                    return val.trim();
	                }).join('\\,') + ')']);
	            }
	
	            if (ma_quan) {
	                params.push(['ma_quan', 'and ma_quan in (' + giapranh.split(',').map(function (val) {
	                    return val.trim();
	                }).join('\\,') + ')']);
	            }
	
	            return (0, _utils.paramJoin)(params);
	        }
	    }, {
	        key: 'getEnvCabenh',
	        value: function getEnvCabenh() {
	            var color = this.settings.map_sxh;
	            var env = [['cnull', '8C8C8C'], ['c7', color.cb_color_7.replace('#', '')], ['c7-14', color.cb_color_814.replace('#', '')], ['c14-21', color.cb_color_1521.replace('#', '')], ['c21-28', color.cb_color_2228.replace('#', '')], ['c28', color.cb_color_28.replace('#', '')], ['csxv', color.cb_color_sxv.replace('#', '')], ['ckhac', color.cb_color_khac.replace('#', '')]];
	            return env.map(function (v) {
	                return v.join(':');
	            }).join(';');
	        }
	    }, {
	        key: 'render',
	        value: function render() {
	            var _props = this.props,
	                sxh_showPopup = _props.sxh_showPopup,
	                sxh_model = _props.sxh_model,
	                sxh_khoanhvung = _props.sxh_khoanhvung,
	                odsxh_sxh = _props.odsxh_sxh,
	                odsxh_model = _props.odsxh_model;
	            var _layerUrl = this.layerUrl,
	                gisnen = _layerUrl.gisnen,
	                ranhphuong = _layerUrl.ranhphuong,
	                ranhquan = _layerUrl.ranhquan,
	                ranhto = _layerUrl.ranhto,
	                cabenh = _layerUrl.cabenh,
	                kvsxh = _layerUrl.kvsxh,
	                test_kvsxh = _layerUrl.test_kvsxh,
	                geo_odsxh = _layerUrl.geo_odsxh;
	
	
	            return _react3.default.createElement(
	                _map.Map,
	                {
	                    zoomControl: false,
	                    ref: 'map'
	                },
	                _react3.default.createElement(_map.ZoomControl, null),
	                _react3.default.createElement(_map.LocateControl, null),
	                _react3.default.createElement(
	                    _map.LayersControl,
	                    { position: 'topright', filterLayers: true },
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: 'GIS n\u1EC1n', checked: true },
	                        _react3.default.createElement(_map.WMSTileLayer, { url: gisnen, layers: 'hcm_map:hcm_map' })
	                    ),
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: 'Google' },
	                        _react3.default.createElement(_map.TileLayer, { url: 'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
	                            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] })
	                    ),
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: 'Mapbox' },
	                        _react3.default.createElement(_map.TileLayer, {
	                            url: 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',
	                            id: 'mapbox.streets',
	                            accessToken: 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw',
	                            attribution: 'Map data \xA9 <a href="http://mapbox.com">Mapbox</a>' })
	                    ),
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: 'OSM' },
	                        _react3.default.createElement(_map.TileLayer, { url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
	                            attribution: '&copy <a href="http://osm.org/copyright">OpenStreetMap</a> contributors' })
	                    ),
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: '\u1EA2nh v\u1EC7 tinh' },
	                        _react3.default.createElement(_map.TileLayer, { url: 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
	                            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] })
	                    ),
	                    _react3.default.createElement(
	                        BaseLayer,
	                        { name: '\u1EA2nh h\xE0ng kh\xF4ng' },
	                        _react3.default.createElement(_map.TileLayer, { url: 'http://hcmgisportal.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg' })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Ranh th\u1EEDa \u0111\u1EA5t' },
	                        _react3.default.createElement(_map.WMSTileLayer, { url: 'http://pcd.hcmgis.vn/geoserver/hcm_map/ows?', layers: 'hcm_map:pg_ranhthua', transparent: 'true' })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Ranh t\u1ED5' },
	                        _react3.default.createElement(_map.WMSTileLayer, { url: ranhto, layers: 'dichte:ranh_to', transparent: 'true' })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Ranh ph\u01B0\u1EDDng' },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            url: ranhphuong,
	                            layers: 'dichte:dm_phuong_new',
	                            ma_phuong: this.cqlPhuong,
	                            tiled: false,
	                            transparent: 'true' })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Ranh qu\u1EADn' },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            url: ranhquan,
	                            layers: 'dichte:dm_quan',
	                            transparent: 'true' })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Ca b\u1EC7nh', checked: true },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            layerID: 'cabenh',
	                            ref: 'cabenhLayer',
	                            url: cabenh,
	                            layers: 'dichte:v_cbsxh',
	                            transparent: 'true',
	                            cql_filter: this.getCqlCabenh(),
	                            env: this.envCabenh,
	                            showGetFeatureInfo: this.showGetFeatureInfo,
	                            time: '2013-03-10T00:00:00.000Z'
	                        })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Khoanh v\xF9ng' },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            ref: 'kvLayer',
	                            url: kvsxh,
	                            layers: 'dichte:v_kvsxh',
	                            transparent: 'true',
	                            cql_filter: this.getCqlCabenh()
	                        })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: 'Khoanh v\xF9ng (\u0110i\u1EC1u ki\u1EC7n)' },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            url: test_kvsxh,
	                            layers: 'dichte:test_kvsxh',
	                            transparent: 'true',
	                            viewparams: this.getViewParams()
	                        })
	                    ),
	                    _react3.default.createElement(
	                        Overlay,
	                        { name: '\u1ED4 d\u1ECBch SXH' },
	                        _react3.default.createElement(_map.WMSTileLayer, {
	                            url: geo_odsxh,
	                            layers: 'dichte:geo_odsxh',
	                            transparent: 'true'
	                        })
	                    )
	                ),
	                _react3.default.createElement(_map.MeasureControl, { position: 'topleft' }),
	                _react3.default.createElement(_map.FullscreenControl, { position: 'bottomright' }),
	                _react3.default.createElement(_map.LegendControl, { html: this.legendCabenh }),
	                _react3.default.createElement(
	                    _map.FeatureGroup,
	                    { ref: 'kvGroup' },
	                    _react3.default.createElement(_map.DrawControl, {
	                        draw: { marker: false, polyline: false, rectangle: false, polygon: false }
	                    }),
	                    sxh_khoanhvung.map(function (val) {
	                        return _react3.default.createElement(_map.Circle, { id: val.id, key: val.id, center: val.center, radius: val.radius, color: val.color ? val.color : '#67c3e5' });
	                    })
	                ),
	                odsxh_sxh.map(function (val) {
	                    return _react3.default.createElement(
	                        _map.Circle,
	                        { id: val.macabenh, key: val.macabenh, center: [val.lat, val.lng], radius: 200, color: '#f69a33' },
	                        _react3.default.createElement(
	                            _map.Popup,
	                            { minWidth: 200 },
	                            _react3.default.createElement(
	                                'div',
	                                { className: 'pop-wrapper' },
	                                _react3.default.createElement(
	                                    'div',
	                                    { className: 'pop-title text-uppercase' },
	                                    '\u1ED4 d\u1ECBch #',
	                                    odsxh_model.id
	                                ),
	                                _react3.default.createElement(
	                                    'div',
	                                    { className: 'pop-body' },
	                                    _react3.default.createElement(
	                                        'ul',
	                                        { className: 'list-data mb-10' },
	                                        _react3.default.createElement(
	                                            'li',
	                                            null,
	                                            _react3.default.createElement(
	                                                'b',
	                                                null,
	                                                'T\u1ED5ng s\u1ED1 ca: '
	                                            ),
	                                            ' ',
	                                            odsxh_sxh.length
	                                        ),
	                                        _react3.default.createElement(
	                                            'li',
	                                            null,
	                                            _react3.default.createElement(
	                                                'b',
	                                                null,
	                                                'T\u1ED5 \u1EA3nh h\u01B0\u1EDFng: '
	                                            ),
	                                            ' '
	                                        ),
	                                        _react3.default.createElement(
	                                            'li',
	                                            null,
	                                            _react3.default.createElement(
	                                                'b',
	                                                null,
	                                                'Di\u1EC7n t\xEDch: '
	                                            ),
	                                            ' ',
	                                            (0, _utils.formatNumber)(odsxh_model.dientichdk),
	                                            ' m\xB2'
	                                        ),
	                                        _react3.default.createElement(
	                                            'li',
	                                            null,
	                                            _react3.default.createElement(
	                                                'b',
	                                                null,
	                                                'Ca \u0111\u1EA7u ti\xEAn: '
	                                            ),
	                                            ' '
	                                        ),
	                                        _react3.default.createElement(
	                                            'li',
	                                            null,
	                                            _react3.default.createElement(
	                                                'b',
	                                                null,
	                                                'Ca g\u1EA7n nh\u1EA5t: '
	                                            ),
	                                            ' '
	                                        )
	                                    )
	                                )
	                            )
	                        )
	                    );
	                }),
	                sxh_showPopup ? _react3.default.createElement(_PopCabenh2.default, { pin: sxh_showPopup, data: sxh_model }) : null
	            );
	        }
	    }]);
	    return MapLayout;
	}(_react2.Component), _class.contextTypes = {
	    srvData: _react2.PropTypes.object
	}, _temp));
	
	var mapStateToProps = function mapStateToProps(state) {
	    var _state$map = state.map,
	        googleAddr = _state$map.googleAddr,
	        flyTo = _state$map.flyTo;
	    var _state$sxh = state.sxh,
	        model = _state$sxh.model,
	        showPopup = _state$sxh.showPopup,
	        filter = _state$sxh.filter,
	        khoanhvung = _state$sxh.khoanhvung;
	    var _state$sxhOdich = state.sxhOdich,
	        sxhs = _state$sxhOdich.sxhs,
	        flytoBounds = _state$sxhOdich.flytoBounds;
	
	
	    return {
	        googleAddr: googleAddr, flyTo: flyTo,
	        sxh_model: model,
	        sxh_showPopup: showPopup,
	        sxh_filter: filter,
	        sxh_khoanhvung: khoanhvung,
	
	        odsxh_model: state.sxhOdich.model,
	        odsxh_sxh: sxhs,
	        odsxh_flyto: flytoBounds
	    };
	};
	
	exports.default = (0, _reactRedux.connect)(mapStateToProps, { updateSxhModel: _sxhActions.updateSxhModel, deleteKvSxh: _sxhActions.deleteKvSxh })(MapLayout);
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(507)(module)))

/***/ })

})
//# sourceMappingURL=0.6aa6e564c241cad5afa8.hot-update.js.map