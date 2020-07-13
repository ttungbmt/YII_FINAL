/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/yii2-leaflet.js":
/*!***********************************!*\
  !*** ./assets/js/yii2-leaflet.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

$(function () {
  var MapApp = /*#__PURE__*/function () {
    function MapApp() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      _classCallCheck(this, MapApp);

      this.options = this.transformOpts(options);
    }

    _createClass(MapApp, [{
      key: "transformOpts",
      value: function transformOpts(options) {
        var opts = {};
        opts.config = _.pick(options, ['zoom', 'center']);
        opts.selectors = options.selectors;
        return opts;
      }
    }, {
      key: "init",
      value: function init() {
        this.mounted();
      }
    }, {
      key: "mounted",
      value: function mounted() {}
    }, {
      key: "getDefaultIcon",
      value: function getDefaultIcon() {
        return L.ExtraMarkers.icon({
          icon: 'fa fa-circle-o',
          markerColor: 'cyan'
        });
      }
    }, {
      key: "setMarker",
      value: function setMarker(_ref) {
        var lat = _ref.lat,
            lng = _ref.lng;
        var _this$options$selecto = this.options.selectors,
            inpLat = _this$options$selecto.inpLat,
            inpLng = _this$options$selecto.inpLng;
        $(inpLat).val(lat);
        $(inpLng).val(lng);
      }
    }, {
      key: "removeMarker",
      value: function removeMarker() {
        var _this$options$selecto2 = this.options.selectors,
            inpLat = _this$options$selecto2.inpLat,
            inpLng = _this$options$selecto2.inpLng;
        $(inpLat).val('');
        $(inpLng).val('');
      }
    }]);

    return MapApp;
  }();

  MapApp.option = {};
  MapApp.$els = {};
  window.yii2Leaflet = {
    apps: {},
    initMap: function initMap(name, fnMounted, options) {
      var app = new MapApp(options);
      app.mounted = fnMounted;
      app.init();
      this.apps[name] = app;
    }
  };
});

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./assets/js/yii2-leaflet.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\PROGRAM\laragon\www\YII-PROJECT\YII_FINAL\packages\ttungbmt\yii2-leaflet\assets\js\yii2-leaflet.js */"./assets/js/yii2-leaflet.js");


/***/ })

/******/ });