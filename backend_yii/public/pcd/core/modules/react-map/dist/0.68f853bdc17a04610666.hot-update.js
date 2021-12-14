webpackHotUpdate(0,{

/***/ 1393:
/***/ (function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(module) {'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	
	var _getPrototypeOf = __webpack_require__(1394);
	
	var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);
	
	var _classCallCheck2 = __webpack_require__(1115);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _possibleConstructorReturn2 = __webpack_require__(1116);
	
	var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);
	
	var _createClass2 = __webpack_require__(1397);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	var _inherits2 = __webpack_require__(1139);
	
	var _inherits3 = _interopRequireDefault(_inherits2);
	
	var _extends2 = __webpack_require__(884);
	
	var _extends3 = _interopRequireDefault(_extends2);
	
	var _react2 = __webpack_require__(297);
	
	var _react3 = _interopRequireDefault(_react2);
	
	var _reactTransformHmr3 = __webpack_require__(1401);
	
	var _reactTransformHmr4 = _interopRequireDefault(_reactTransformHmr3);
	
	var _dec, _class, _class2, _temp;
	
	var _redux = __webpack_require__(493);
	
	var _reactRedux = __webpack_require__(485);
	
	var _reactResolver = __webpack_require__(516);
	
	var _axios = __webpack_require__(591);
	
	var _axios2 = _interopRequireDefault(_axios);
	
	var _lodash = __webpack_require__(1056);
	
	var _components2 = __webpack_require__(1417);
	
	var _flashActions = __webpack_require__(1430);
	
	var _layout = __webpack_require__(1566);
	
	var Layout = _interopRequireWildcard(_layout);
	
	function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	var _components = {
	    App: {
	        displayName: 'App'
	    }
	};
	
	var _reactTransformHmr2 = (0, _reactTransformHmr4.default)({
	    filename: 'D:/PROGRAM/laragon/www/PRODUCTION/dichte/web/core/modules/react-map/app/containers/App.js',
	    components: _components,
	    locals: [module],
	    imports: [_react3.default]
	});
	
	function _wrapComponent(id) {
	    return function (Component) {
	        return _reactTransformHmr2(Component, id);
	    };
	}
	
	console.log(11);
	
	var initialData;
	
	var App = _wrapComponent('App')((_dec = (0, _reactResolver.resolve)('srvData', function (props) {
	    if (initialData) return initialData; // Fix load router
	
	    return _axios2.default.all([_axios2.default.get('maps/config')]).then(_axios2.default.spread(function (res01, res02, res03) {
	        props.dispatch({ type: 'UPDATE_SERVER_DATA', payload: res01.data });
	
	        initialData = (0, _extends3.default)({}, res01.data);
	        return initialData;
	    }));
	}), _dec(_class = (_temp = _class2 = function (_Component) {
	    (0, _inherits3.default)(App, _Component);
	    (0, _createClass3.default)(App, [{
	        key: 'getChildContext',
	        value: function getChildContext() {
	            return {
	                srvData: this.props.srvData
	            };
	        }
	    }]);
	
	    function App(props) {
	        (0, _classCallCheck3.default)(this, App);
	
	        var _this = (0, _possibleConstructorReturn3.default)(this, (App.__proto__ || (0, _getPrototypeOf2.default)(App)).call(this, props));
	
	        _this.state = {
	            progLayout: null
	        };
	        return _this;
	    }
	
	    (0, _createClass3.default)(App, [{
	        key: 'componentDidMount',
	        value: function componentDidMount() {
	            var _props = this.props,
	                flashWarning = _props.flashWarning,
	                srvData = _props.srvData;
	
	
	            Layout.init();
	            this.setState({ progLayout: 'loaded' });
	
	            // Thông báo ca bệnh
	            flashWarning(this.getInitStatSXH(srvData.thongke), 'Cảnh báo', { autoDismiss: 0 });
	        }
	    }, {
	        key: 'getInitStatSXH',
	        value: function getInitStatSXH(thongke) {
	            return (0, _lodash.compact)((0, _lodash.map)(thongke, function (val, k) {
	                var num = parseInt(val);
	                if (num && k == 'chuadt') return val + ' ca ch\u01B0a \u0111i\u1EC1u tra';
	                if (num && k == 'dangdt') return val + ' ca \u0111ang \u0111i\u1EC1u \u0111i\u1EC1u tra';
	            })).join(', ');
	        }
	    }, {
	        key: 'render',
	        value: function render() {
	            var _props2 = this.props,
	                children = _props2.children,
	                chatStatus = _props2.chatStatus,
	                dispatch = _props2.dispatch;
	
	
	            return _react3.default.createElement(
	                'div',
	                { id: 'wrapper' },
	                _react3.default.createElement(_components2.Header, { id: 'header' }),
	                _react3.default.createElement(
	                    'section',
	                    { id: 'main' },
	                    ' ',
	                    _react3.default.createElement(
	                        _components2.LeftPanel,
	                        { id: 'leftPanel' },
	                        children
	                    ),
	                    _react3.default.createElement(
	                        'div',
	                        { id: 'content' },
	                        _react3.default.createElement(_components2.Navbar, { id: 'navbar' }),
	                        _react3.default.createElement(
	                            'div',
	                            { id: 'map-wrapper' },
	                            _react3.default.createElement(
	                                'div',
	                                { id: 'leftMap' },
	                                'LEFT MAP'
	                            ),
	                            _react3.default.createElement(
	                                'div',
	                                { id: 'mainMap' },
	                                this.state.progLayout == 'loaded' ? _react3.default.createElement(_components2.MapLayout, null) : 'Đang tải...'
	                            ),
	                            _react3.default.createElement(
	                                'div',
	                                { id: 'rightMap' },
	                                'RIGHT MAP'
	                            )
	                        ),
	                        _react3.default.createElement(
	                            'div',
	                            { id: 'preview' },
	                            'PREVIEW'
	                        )
	                    ),
	                    _react3.default.createElement(
	                        'div',
	                        { id: 'rightPanel' },
	                        'RIGHTPANEL'
	                    )
	                ),
	                _react3.default.createElement(_components2.Footer, null),
	                chatStatus ? _react3.default.createElement(_components2.ChatBox, { dispatch: dispatch }) : null,
	                _react3.default.createElement(_components2.FlashNoty, null)
	            );
	        }
	    }]);
	    return App;
	}(_react2.Component), _class2.childContextTypes = {
	    srvData: _react2.PropTypes.object
	}, _temp)) || _class));
	
	var mapStateToProps = function mapStateToProps(state, ownProps) {
	    return {
	        chatStatus: state.status.chat
	    };
	};
	
	var mapDispatchToProps = function mapDispatchToProps(dispatch) {
	    return (0, _extends3.default)({}, (0, _redux.bindActionCreators)({ flashWarning: _flashActions.flashWarning }, dispatch), { dispatch: dispatch });
	};
	
	exports.default = (0, _reactRedux.connect)(mapStateToProps, mapDispatchToProps, null)(App);
	
	// import Header from '../components/Header';
	// import LeftPanel from '../components/LeftPanel';
	// import Navbar from '../components/Navbar';
	// import Footer from '../components/Footer';
	// import MapLayout from '../components/MapLayout';
	// import ChatBox from '../vendor/chat/ChatBox';
	//
	// @resolve('resData', props => {
	//     return axios.all([axios.get(`/maps/config`)])
	//         .then(axios.spread((res01) => {
	//             return {...res01.data};
	//         }));
	// })
	// class App extends Component {
	//     state = {
	//         layout: 'Loading...',
	//     }
	//
	//     constructor() {
	//         super();
	//         this.state = {
	//             openChat : false
	//         }
	//     }
	//
	//     static childContextTypes = {
	//         resData: PropTypes.object,
	//         map: PropTypes.object,
	//     }
	//
	//     getChildContext() {
	//         return {
	//             resData: this.props.resData,
	//             map: this.props.map,
	//         }
	//     }
	//
	//     componentDidMount() {
	//         const {thongke} = this.props.resData;
	//
	//         let updateMap = () => {
	//             setTimeout(() => { this.props.map.map.invalidateSize(); })
	//         }
	//
	//         let defaults = {
	//             resizeWhileDragging: true,
	//             spacing_open: 5,
	//             spacing_closed: 5,
	//             resizerDragOpacity: 0.3, // Độ mờ resize(Tắt resizeWhileDragging),
	//             // onshow_end: updateMap,
	//             // onhide_end: updateMap,
	//             onresize_end: updateMap,
	//             // onclose_end: updateMap,
	//             // onopen_end: updateMap,
	//         };
	//
	//
	//         var myLayout = $('body').layout({
	//             defaults,
	//             north: {
	//                 paneSelector: '#header',
	//                 size: 46,
	//                 spacing_open: 0,			// cosmetic spacing
	// //                togglerLength_open: 0,			// HIDE the toggler button
	// //                resizable: false,
	// //                slidable: true,
	//                 spacing_closed: 0,
	// //                     showOverflowOnHover: true,
	//             },
	//             center: {
	//                 paneSelector: '#main',
	//                 childOptions: {
	//                     defaults: defaults,
	//                     west: {
	//                         paneSelector: '#leftPanel',
	//                         size: 550,
	//                         // showOverflowOnHover: true,
	//                     },
	//                     center: {
	//                         defaults: defaults,
	//                         paneSelector: '#content',
	//
	//                         childOptions: {
	//                             defaults: defaults,
	//                             north: {
	//                                 paneSelector: '#navbar',
	//                                 size: 42,
	//                                 spacing_open: 0,			// cosmetic spacing
	//                                 spacing_closed: 0,
	//                                 // showOverflowOnHover: true,
	//                             },
	//                             center: {
	//                                 paneSelector: '#map-wrapper',
	//                                 childOptions: {
	//                                     defaults: defaults,
	//                                     west: {
	//                                         paneSelector: '#leftMap',
	//                                         spacing_closed: 0,
	//                                         initClosed: true,
	//                                     },
	//                                     center: {
	//                                         paneSelector: '#mainMap',
	//                                     },
	//                                     east: {
	//                                         paneSelector: '#rightMap',
	//                                         initClosed: true,
	//                                         spacing_closed: 0,
	//                                     },
	//                                 }
	//                             },
	//
	//                             south: {
	//                                 paneSelector: '#preview',
	//                                 size: 140,
	//                                 initClosed: true,
	//                                 spacing_closed: 0,
	//                             }
	//                         }
	//                     },
	//                     east: {
	//                         paneSelector: '#rightPanel',
	//                         initClosed: true,
	//                         spacing_closed: 0,
	//                     },
	//                 }
	//             },
	//             south: {
	//                 paneSelector: '#footer',
	//                 initClosed: true,
	//                 spacing_closed: 0,
	//             }
	//         });
	//
	//
	//         let appLayout = myLayout,
	//             mainLayout = myLayout.center.children.layout1,
	//             contentLayout = mainLayout.center.children.layout1,
	//             mapLayout = contentLayout.center.children.layout1;
	//
	//         window.appLayout = {root: myLayout, main: mainLayout, content: contentLayout, map: mapLayout};
	//
	//         this.setState({layout: 'loaded'});
	//
	//         $('#leftPanel').perfectScrollbar();
	//         $('.table-responsive').perfectScrollbar();
	//
	//
	//         var sbToggled = document.getElementById('navHeader');
	//         var gesture = new Hammer(sbToggled);
	//         gesture.on('swipeleft swiperight', function(e) {
	//             const {type} = e;
	//             if(type == 'swipeleft') window.appLayout.main.close('west');
	//             if(type == 'swiperight') window.appLayout.main.open('west');
	//         });
	//
	//
	//
	//
	//
	//
	//         // $(".load-ajax-content").each(function () {
	//         //     let self = $(this);
	//         //     let url = $(this).attr('data-url');
	//         //     let progress = `<div class="progress m-5"> <div class="progress-bar progress-bar-striped active" style="width: 100%"><span class="sr-only">100% Đang tải</span> </div> </div>`;
	//         //
	//         //     self
	//         //         .html(progress)
	//         //         .load(url, (res, status, xhr) => {
	//         //             xhr
	//         //                 .done(() => {
	//         //                     self.html(res);
	//         //                 })
	//         //                 .fail(() => {
	//         //                     self.html('Tải dữ liệu thất bại')
	//         //                 })
	//         //         })
	//         // });
	//
	//
	//
	//         // Thống kê ca bệnh
	//         if(parseInt(thongke.chuadt) || parseInt(thongke.dangdt)){
	//             this.refs.noty.addNotification({
	//                 title: 'Cảnh báo',
	//                 level: 'warning',
	//                 message: this.getMessage(thongke),
	//                 autoDismiss: 0,
	//                 action: {
	//                     label: 'Cập nhật ngay',
	//                     callback: function() {
	//                         window.open(url_home('/dichte/cabenh/index'));
	//                     }
	//                 }
	//             });
	//         }
	//     }
	//
	//     getMessage(thongke){
	//         let arr = [];
	//         if(parseInt(thongke.chuadt)) arr.push(`${thongke.chuadt} ca chưa điều tra`);
	//         if(parseInt(thongke.dangdt)) arr.push(`${thongke.dangdt} ca đang điều tra`);
	//         return arr.join(', ');
	//     }
	//
	//
	//
	//     componentDidUpdate(prevProps, prevState) {
	//         const {noty} = this.props
	//
	//         if(noty && noty != prevProps.noty){
	//             this.refs.noty.addNotification(noty);
	//         }
	//
	//     }
	//
	//
	//     openChat(){
	//         this.setState({openChat: true})
	//     }
	//
	//     closeChat(){
	//         this.setState({openChat: false})
	//     }
	//
	//     render() {
	//
	//
	//         return (
	//             <div id="wrapper">
	//                 <Header openChat={::this.openChat}></Header>
	//                 <section id="main"> {/* onmouseover="myLayout.allowOverflow('north')" */}
	//                     <LeftPanel></LeftPanel>
	//                     <div id="content">
	//                         <Navbar></Navbar>
	//                         <div id="map-wrapper">
	//                             <div id="leftMap">LEFT MAP</div>
	//                             <div id="mainMap">
	//                                 {this.state.layout == 'loaded' ? <MapLayout /> : 'Đang tải...'}
	//                             </div>
	//                             <div id="rightMap">RIGHT MAP</div>
	//                         </div>
	//                         <div id="preview">PREVIEW</div>
	//                     </div>
	//                     <div id="rightPanel">RIGHTPANEL</div>
	//                 </section>
	//                 <Footer></Footer>
	//
	//                 {this.state.openChat ? <ChatBox closeChat={::this.closeChat} /> : null}
	//                 <Noty ref="noty" allowHTML/>
	//             </div>
	//         )
	//     }
	// }
	//
	// const mapStateToProps = (state) => {
	//     return {
	//         server: state.server,
	//         noty: state.dichte.noty,
	//         map: state.map,
	//     }
	// }
	//
	//
	// export default connect(mapStateToProps, null, null)(App);
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(507)(module)))

/***/ })

})
//# sourceMappingURL=0.68f853bdc17a04610666.hot-update.js.map