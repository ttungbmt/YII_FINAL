webpackHotUpdate(0,[
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.store = undefined;
	
	__webpack_require__(1);
	
	var _react = __webpack_require__(297);
	
	var _react2 = _interopRequireDefault(_react);
	
	var _reactDom = __webpack_require__(335);
	
	var _reactRedux = __webpack_require__(485);
	
	var _reactResolver = __webpack_require__(516);
	
	var _reactRouter = __webpack_require__(525);
	
	var _reactRouterRedux = __webpack_require__(586);
	
	var _createHashHistory = __webpack_require__(534);
	
	var _createHashHistory2 = _interopRequireDefault(_createHashHistory);
	
	var _server = __webpack_require__(519);
	
	var _axios = __webpack_require__(591);
	
	var _axios2 = _interopRequireDefault(_axios);
	
	var _moment = __webpack_require__(613);
	
	var _moment2 = _interopRequireDefault(_moment);
	
	var _configureStore = __webpack_require__(730);
	
	var _configureStore2 = _interopRequireDefault(_configureStore);
	
	var _containers = __webpack_require__(1392);
	
	var _routes = __webpack_require__(1567);
	
	var _routes2 = _interopRequireDefault(_routes);
	
	var _utils = __webpack_require__(1490);
	
	var _utils2 = _interopRequireDefault(_utils);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	var appHashHistory = (0, _reactRouter.useRouterHistory)(_createHashHistory2.default)({ queryKey: false }); // history v3 k tương thích React router
	var store = exports.store = (0, _configureStore2.default)();
	var history = (0, _reactRouterRedux.syncHistoryWithStore)(appHashHistory, store);
	
	// Khi k có Chrome Devtools thì dùng DevTools npm (phải dùng module.hot)
	var devTools = !window.devToolsExtension && module.hot ? _react2.default.createElement(_containers.DevTools, null) : null;
	
	_axios2.default.defaults.baseURL = window.BASE_URL ? window.BASE_URL : 'http://dichte.dev:82';
	_moment2.default.locale('vi');
	window.util = new _utils2.default();
	console.log(333);
	
	(0, _reactDom.render)(_react2.default.createElement(
	    _reactRedux.Provider,
	    { store: store },
	    _react2.default.createElement(
	        'div',
	        null,
	        _react2.default.createElement(_reactRouter.Router, { history: history, routes: _routes2.default }),
	        devTools
	    )
	), document.getElementById('rootApp'));

/***/ })
])
//# sourceMappingURL=0.0156f52eaa1e244837ee.hot-update.js.map