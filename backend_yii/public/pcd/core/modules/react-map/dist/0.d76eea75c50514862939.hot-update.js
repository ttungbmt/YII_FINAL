webpackHotUpdate(0,{

/***/ 1475:
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.default = undefined;
	
	var _objectWithoutProperties2 = __webpack_require__(1058);
	
	var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);
	
	var _getPrototypeOf = __webpack_require__(1394);
	
	var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);
	
	var _classCallCheck2 = __webpack_require__(1115);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _createClass2 = __webpack_require__(1397);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	var _possibleConstructorReturn2 = __webpack_require__(1116);
	
	var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);
	
	var _get2 = __webpack_require__(1448);
	
	var _get3 = _interopRequireDefault(_get2);
	
	var _inherits2 = __webpack_require__(1139);
	
	var _inherits3 = _interopRequireDefault(_inherits2);
	
	var _class, _temp;
	
	var _react = __webpack_require__(297);
	
	var _BaseTileLayer2 = __webpack_require__(1446);
	
	var _BaseTileLayer3 = _interopRequireDefault(_BaseTileLayer2);
	
	var _ImageWMS = __webpack_require__(1570);
	
	var _ImageWMS2 = _interopRequireDefault(_ImageWMS);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	var WMSTileLayer = (_temp = _class = function (_BaseTileLayer) {
	    (0, _inherits3.default)(WMSTileLayer, _BaseTileLayer);
	
	    function WMSTileLayer() {
	        (0, _classCallCheck3.default)(this, WMSTileLayer);
	        return (0, _possibleConstructorReturn3.default)(this, (WMSTileLayer.__proto__ || (0, _getPrototypeOf2.default)(WMSTileLayer)).apply(this, arguments));
	    }
	
	    (0, _createClass3.default)(WMSTileLayer, [{
	        key: 'componentWillMount',
	        value: function componentWillMount() {
	            (0, _get3.default)(WMSTileLayer.prototype.__proto__ || (0, _getPrototypeOf2.default)(WMSTileLayer.prototype), 'componentWillMount', this).call(this);
	            var _props = this.props,
	                url = _props.url,
	                layerID = _props.layerID,
	                props = (0, _objectWithoutProperties3.default)(_props, ['url', 'layerID']);
	
	
	            L.TileLayer.BetterWMS = L.TileLayer.WMS.extend({
	
	                onAdd: function onAdd(map) {
	                    // Triggered when the layer is added to a map.
	                    //   Register a click listener, then do all the upstream WMS things
	                    L.TileLayer.WMS.prototype.onAdd.call(this, map);
	                    map.on('click', this.getFeatureInfo, this);
	                },
	
	                onRemove: function onRemove(map) {
	                    // Triggered when the layer is removed from a map.
	                    //   Unregister a click listener, then do all the upstream WMS things
	                    L.TileLayer.WMS.prototype.onRemove.call(this, map);
	                    map.off('click', this.getFeatureInfo, this);
	                },
	
	                getFeatureInfo: function getFeatureInfo(evt) {
	                    // Make an AJAX request to the server and hope for the best
	                    var url = this.getFeatureInfoUrl(evt.latlng),
	                        showResults = L.Util.bind(this.showGetFeatureInfo, this);
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
	                    // Construct a GetFeatureInfo request URL given a point
	                    var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
	                        size = this._map.getSize(),
	                        params = {
	                        request: 'GetFeatureInfo',
	                        service: 'WMS',
	                        srs: 'EPSG:4326',
	                        styles: this.wmsParams.styles,
	                        transparent: this.wmsParams.transparent,
	                        version: this.wmsParams.version,
	                        format: this.wmsParams.format,
	                        bbox: this._map.getBounds().toBBoxString(),
	                        height: size.y,
	                        width: size.x,
	                        layers: this.wmsParams.layers,
	                        query_layers: this.wmsParams.layers,
	                        cql_filter: this.wmsParams.cql_filter,
	                        env: this.wmsParams.env,
	                        viewparams: this.wmsParams.viewparams,
	                        info_format: 'application/json'
	                    };
	
	                    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
	                    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;
	
	                    return this._url + L.Util.getParamString(params, this._url, true);
	                },
	
	                showGetFeatureInfo: props.showGetFeatureInfo
	            });
	
	            L.tileLayer.betterWms = function (url, options) {
	                return new L.TileLayer.BetterWMS(url, options);
	            };
	
	            this.leafletElement = props.showGetFeatureInfo ? L.tileLayer.betterWms(url, props) : L.tileLayer.wms(url, props);
	            this.leafletElement.layerID = layerID ? layerID : null;
	        }
	    }]);
	    return WMSTileLayer;
	}(_BaseTileLayer3.default), _class.propTypes = {
	    url: _react.PropTypes.string.isRequired,
	    layers: _react.PropTypes.string.isRequired,
	    showGetFeatureInfo: _react.PropTypes.func
	}, _class.defaultProps = {
	    format: 'image/png'
	}, _temp);
	exports.default = WMSTileLayer;

/***/ })

})
//# sourceMappingURL=0.d76eea75c50514862939.hot-update.js.map