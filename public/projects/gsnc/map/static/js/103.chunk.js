(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[103],{1232:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContextProvider=t.FrameContext=void 0;var r,a=n(0),o=(r=a)&&r.__esModule?r:{default:r};var i=void 0,c=void 0;"undefined"!==typeof document&&(i=document),"undefined"!==typeof window&&(c=window);var s=t.FrameContext=o.default.createContext({document:i,window:c}),l=s.Provider,u=s.Consumer;t.FrameContextProvider=l,t.FrameContextConsumer=u},1233:function(e,t,n){"use strict";n.d(t,"a",(function(){return T}));var r=n(14),a=n(140),o=n(1211),i=n(1218),c=n(547),s=n(1224),l=n(1225),u=n(0),d=n.n(u),f=n(18),p=n(8),m=n(86),h=n(87),b=n(150),v=n(149),y=n(1121),O=n(643),j=n(1158),g=n(1210),x=n(10),k=n(420),w=n(421),C=n(1234),D=n.n(C),_=n(1),M=Object(y.a)({productionPrefix:"iframe-"}),P=function(e){Object(b.a)(n,e);var t=Object(v.a)(n);function n(){var e;Object(m.a)(this,n);for(var r=arguments.length,a=new Array(r),o=0;o<r;o++)a[o]=arguments[o];return(e=t.call.apply(t,[this].concat(a))).state={ready:!1},e.handleRef=function(t){e.contentDocument=t?t.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(k.a)(Object(p.a)(Object(p.a)({},Object(O.a)()),{},{plugins:[].concat(Object(f.a)(Object(O.a)().plugins),[Object(w.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(_.a)(d.a.Fragment,null,Object(_.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(_.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(h.a)(n,[{key:"render",value:function(){var e=this.props,t=e.children,n=e.classes,r=e.theme;return Object(_.a)(D.a,{head:this.renderHead(),ref:this.handleRef,className:n.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(_.a)(j.b,{jss:this.state.jss,generateClassName:M,sheetsManager:this.state.sheetsManager},Object(_.a)(g.a,{theme:r},d.a.cloneElement(t,{container:this.state.container}))):null)}}]),n}(d.a.Component),N=Object(x.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(P);function S(e){var t=Object(u.useState)(e.currentTabIndex),n=Object(r.a)(t,2),d=n[0],f=n[1],p=e.component,m=e.raw,h=e.iframe,b=e.className;return Object(_.a)(i.a,{className:b},Object(_.a)(o.a,{position:"static",color:"default",elevation:0},Object(_.a)(l.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:d,onChange:function(e,t){f(t)}},p&&Object(_.a)(s.a,{classes:{root:"min-w-64"},icon:Object(_.a)(c.a,null,"remove_red_eye")}),m&&Object(_.a)(s.a,{classes:{root:"min-w-64"},icon:Object(_.a)(c.a,null,"code")}))),Object(_.a)("div",{className:"flex justify-center max-w-full"},Object(_.a)("div",{className:0===d?"flex flex-1 max-w-full":"hidden"},p&&(h?Object(_.a)(N,null,Object(_.a)(p,null)):Object(_.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(_.a)(p,null)))),Object(_.a)("div",{className:1===d?"flex flex-1":"hidden"},m&&Object(_.a)("div",{className:"flex flex-1"},Object(_.a)(a.a,{component:"pre",className:"language-javascript w-full"},m.default)))))}S.defaultProps={currentTabIndex:0};var T=S},1234:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContext=void 0;var r=n(1232);Object.defineProperty(t,"FrameContext",{enumerable:!0,get:function(){return r.FrameContext}}),Object.defineProperty(t,"FrameContextConsumer",{enumerable:!0,get:function(){return r.FrameContextConsumer}});var a,o=n(1235),i=(a=o)&&a.__esModule?a:{default:a};t.default=i.default},1235:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},a=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),o=n(0),i=d(o),c=d(n(19)),s=d(n(5)),l=n(1232),u=d(n(1236));function d(e){return e&&e.__esModule?e:{default:e}}var f=function(e){function t(e,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var r=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e,n));return r.handleLoad=function(){r.forceUpdate()},r._isMounted=!1,r}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),a(t,[{key:"componentDidMount",value:function(){this._isMounted=!0;var e=this.getDoc();e&&"complete"===e.readyState?this.forceUpdate():this.node.addEventListener("load",this.handleLoad)}},{key:"componentWillUnmount",value:function(){this._isMounted=!1,this.node.removeEventListener("load",this.handleLoad)}},{key:"getDoc",value:function(){return this.node?this.node.contentDocument:null}},{key:"getMountTarget",value:function(){var e=this.getDoc();return this.props.mountTarget?e.querySelector(this.props.mountTarget):e.body.children[0]}},{key:"renderFrameContents",value:function(){if(!this._isMounted)return null;var e=this.getDoc();if(!e)return null;var t=this.props.contentDidMount,n=this.props.contentDidUpdate,r=e.defaultView||e.parentView,a=i.default.createElement(u.default,{contentDidMount:t,contentDidUpdate:n},i.default.createElement(l.FrameContextProvider,{value:{document:e,window:r}},i.default.createElement("div",{className:"frame-content"},this.props.children)));e.body.children.length<1&&(e.open("text/html","replace"),e.write(this.props.initialContent),e.close());var o=this.getMountTarget();return[c.default.createPortal(this.props.head,this.getDoc().head),c.default.createPortal(a,o)]}},{key:"render",value:function(){var e=this,t=r({},this.props,{children:void 0});return delete t.head,delete t.initialContent,delete t.mountTarget,delete t.contentDidMount,delete t.contentDidUpdate,i.default.createElement("iframe",r({},t,{ref:function(t){e.node=t}}),this.renderFrameContents())}}]),t}(o.Component);f.propTypes={style:s.default.object,head:s.default.node,initialContent:s.default.string,mountTarget:s.default.string,contentDidMount:s.default.func,contentDidUpdate:s.default.func,children:s.default.oneOfType([s.default.element,s.default.arrayOf(s.default.element)])},f.defaultProps={style:{},head:null,children:void 0,mountTarget:void 0,contentDidMount:function(){},contentDidUpdate:function(){},initialContent:'<!DOCTYPE html><html><head></head><body><div class="frame-root"></div></body></html>'},t.default=f},1236:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),a=n(0),o=(i(a),i(n(5)));function i(e){return e&&e.__esModule?e:{default:e}}function c(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function s(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}var l=function(e){function t(){return c(this,t),s(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),r(t,[{key:"componentDidMount",value:function(){this.props.contentDidMount()}},{key:"componentDidUpdate",value:function(){this.props.contentDidUpdate()}},{key:"render",value:function(){return a.Children.only(this.props.children)}}]),t}(a.Component);l.propTypes={children:o.default.element.isRequired,contentDidMount:o.default.func.isRequired,contentDidUpdate:o.default.func.isRequired},t.default=l},1364:function(e,t,n){"use strict";var r=n(2),a=n(7),o=n(0),i=(n(5),n(3)),c=n(10),s=n(12);function l(e){var t,n,r;return t=e,n=0,r=1,e=(Math.min(Math.max(n,t),r)-n)/(r-n),e=(e-=1)*e*e+1}var u=o.forwardRef((function(e,t){var n,c=e.classes,u=e.className,d=e.color,f=void 0===d?"primary":d,p=e.disableShrink,m=void 0!==p&&p,h=e.size,b=void 0===h?40:h,v=e.style,y=e.thickness,O=void 0===y?3.6:y,j=e.value,g=void 0===j?0:j,x=e.variant,k=void 0===x?"indeterminate":x,w=Object(a.a)(e,["classes","className","color","disableShrink","size","style","thickness","value","variant"]),C={},D={},_={};if("determinate"===k||"static"===k){var M=2*Math.PI*((44-O)/2);C.strokeDasharray=M.toFixed(3),_["aria-valuenow"]=Math.round(g),"static"===k?(C.strokeDashoffset="".concat(((100-g)/100*M).toFixed(3),"px"),D.transform="rotate(-90deg)"):(C.strokeDashoffset="".concat((n=(100-g)/100,n*n*M).toFixed(3),"px"),D.transform="rotate(".concat((270*l(g/70)).toFixed(3),"deg)"))}return o.createElement("div",Object(r.a)({className:Object(i.default)(c.root,u,"inherit"!==f&&c["color".concat(Object(s.a)(f))],{indeterminate:c.indeterminate,static:c.static}[k]),style:Object(r.a)({width:b,height:b},D,v),ref:t,role:"progressbar"},_,w),o.createElement("svg",{className:c.svg,viewBox:"".concat(22," ").concat(22," ").concat(44," ").concat(44)},o.createElement("circle",{className:Object(i.default)(c.circle,m&&c.circleDisableShrink,{indeterminate:c.circleIndeterminate,static:c.circleStatic}[k]),style:C,cx:44,cy:44,r:(44-O)/2,fill:"none",strokeWidth:O})))}));t.a=Object(c.a)((function(e){return{root:{display:"inline-block"},static:{transition:e.transitions.create("transform")},indeterminate:{animation:"$circular-rotate 1.4s linear infinite"},colorPrimary:{color:e.palette.primary.main},colorSecondary:{color:e.palette.secondary.main},svg:{display:"block"},circle:{stroke:"currentColor"},circleStatic:{transition:e.transitions.create("stroke-dashoffset")},circleIndeterminate:{animation:"$circular-dash 1.4s ease-in-out infinite",strokeDasharray:"80px, 200px",strokeDashoffset:"0px"},"@keyframes circular-rotate":{"0%":{transformOrigin:"50% 50%"},"100%":{transform:"rotate(360deg)"}},"@keyframes circular-dash":{"0%":{strokeDasharray:"1px, 200px",strokeDashoffset:"0px"},"50%":{strokeDasharray:"100px, 200px",strokeDashoffset:"-15px"},"100%":{strokeDasharray:"100px, 200px",strokeDashoffset:"-125px"}},circleDisableShrink:{animation:"none"}}}),{name:"MuiCircularProgress",flip:!1})(u)},1811:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return f}));var r=n(14),a=n(0),o=n.n(a),i=n(645),c=n(1364),s=n(1170),l=n(1166),u=n(1),d=Object(l.a)((function(e){return{backdrop:{zIndex:e.zIndex.drawer+1,color:"#fff"}}}));function f(){var e=d(),t=o.a.useState(!1),n=Object(r.a)(t,2),a=n[0],l=n[1];return Object(u.a)("div",null,Object(u.a)(s.a,{variant:"outlined",color:"primary",onClick:function(){l(!a)}},"Show backdrop"),Object(u.a)(i.a,{className:e.backdrop,open:a,onClick:function(){l(!1)}},Object(u.a)(c.a,{color:"inherit"})))}},1812:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport Backdrop from '@material-ui/core/Backdrop';\r\nimport CircularProgress from '@material-ui/core/CircularProgress';\r\nimport Button from '@material-ui/core/Button';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  backdrop: {\r\n    zIndex: theme.zIndex.drawer + 1,\r\n    color: '#fff',\r\n  },\r\n}));\r\n\r\nexport default function SimpleBackdrop() {\r\n  const classes = useStyles();\r\n  const [open, setOpen] = React.useState(false);\r\n  const handleClose = () => {\r\n    setOpen(false);\r\n  };\r\n  const handleToggle = () => {\r\n    setOpen(!open);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button variant=\"outlined\" color=\"primary\" onClick={handleToggle}>\r\n        Show backdrop\r\n      </Button>\r\n      <Backdrop className={classes.backdrop} open={open} onClick={handleClose}>\r\n        <CircularProgress color=\"inherit\" />\r\n      </Backdrop>\r\n    </div>\r\n  );\r\n}\r\n"},2855:function(e,t,n){"use strict";n.r(t);var r=n(0),a=n.n(r),o=n(1233),i=(n(140),n(1170)),c=n(547),s=n(169),l=n(1166),u=n(1),d=Object(l.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));t.default=function(e){return d(),Object(u.a)(a.a.Fragment,null,Object(u.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(u.a)(i.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/backdrop",target:"_blank",role:"button"},Object(u.a)(c.a,null,"link"),Object(u.a)("span",{className:"mx-4"},"Reference"))),Object(u.a)(s.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Backdrop"),Object(u.a)(s.a,{className:"description"},"The backdrop component is used to provide emphasis on a particular element or parts of it."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"The backdrop signals to the user of a state change within the application and can be used for creating loaders, dialogs and more. In its simplest form, the backdrop component will add a dimmed layer over your application."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1811).default,raw:n(1812)})))}}}]);