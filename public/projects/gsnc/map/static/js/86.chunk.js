(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[86],{1232:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContextProvider=t.FrameContext=void 0;var a,o=n(0),r=(a=o)&&a.__esModule?a:{default:a};var i=void 0,c=void 0;"undefined"!==typeof document&&(i=document),"undefined"!==typeof window&&(c=window);var u=t.FrameContext=r.default.createContext({document:i,window:c}),s=u.Provider,l=u.Consumer;t.FrameContextProvider=s,t.FrameContextConsumer=l},1233:function(e,t,n){"use strict";n.d(t,"a",(function(){return P}));var a=n(14),o=n(140),r=n(1211),i=n(1218),c=n(547),u=n(1224),s=n(1225),l=n(0),d=n.n(l),f=n(18),m=n(8),p=n(86),b=n(87),h=n(150),y=n(149),g=n(1121),j=n(643),v=n(1158),O=n(1210),x=n(10),C=n(420),w=n(421),k=n(1234),_=n.n(k),M=n(1),D=Object(g.a)({productionPrefix:"iframe-"}),N=function(e){Object(h.a)(n,e);var t=Object(y.a)(n);function n(){var e;Object(p.a)(this,n);for(var a=arguments.length,o=new Array(a),r=0;r<a;r++)o[r]=arguments[r];return(e=t.call.apply(t,[this].concat(o))).state={ready:!1},e.handleRef=function(t){e.contentDocument=t?t.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(C.a)(Object(m.a)(Object(m.a)({},Object(j.a)()),{},{plugins:[].concat(Object(f.a)(Object(j.a)().plugins),[Object(w.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(M.a)(d.a.Fragment,null,Object(M.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(M.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(b.a)(n,[{key:"render",value:function(){var e=this.props,t=e.children,n=e.classes,a=e.theme;return Object(M.a)(_.a,{head:this.renderHead(),ref:this.handleRef,className:n.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(M.a)(v.b,{jss:this.state.jss,generateClassName:D,sheetsManager:this.state.sheetsManager},Object(M.a)(O.a,{theme:a},d.a.cloneElement(t,{container:this.state.container}))):null)}}]),n}(d.a.Component),F=Object(x.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(N);function T(e){var t=Object(l.useState)(e.currentTabIndex),n=Object(a.a)(t,2),d=n[0],f=n[1],m=e.component,p=e.raw,b=e.iframe,h=e.className;return Object(M.a)(i.a,{className:h},Object(M.a)(r.a,{position:"static",color:"default",elevation:0},Object(M.a)(s.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:d,onChange:function(e,t){f(t)}},m&&Object(M.a)(u.a,{classes:{root:"min-w-64"},icon:Object(M.a)(c.a,null,"remove_red_eye")}),p&&Object(M.a)(u.a,{classes:{root:"min-w-64"},icon:Object(M.a)(c.a,null,"code")}))),Object(M.a)("div",{className:"flex justify-center max-w-full"},Object(M.a)("div",{className:0===d?"flex flex-1 max-w-full":"hidden"},m&&(b?Object(M.a)(F,null,Object(M.a)(m,null)):Object(M.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(M.a)(m,null)))),Object(M.a)("div",{className:1===d?"flex flex-1":"hidden"},p&&Object(M.a)("div",{className:"flex flex-1"},Object(M.a)(o.a,{component:"pre",className:"language-javascript w-full"},p.default)))))}T.defaultProps={currentTabIndex:0};var P=T},1234:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContext=void 0;var a=n(1232);Object.defineProperty(t,"FrameContext",{enumerable:!0,get:function(){return a.FrameContext}}),Object.defineProperty(t,"FrameContextConsumer",{enumerable:!0,get:function(){return a.FrameContextConsumer}});var o,r=n(1235),i=(o=r)&&o.__esModule?o:{default:o};t.default=i.default},1235:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a])}return e},o=function(){function e(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(t,n,a){return n&&e(t.prototype,n),a&&e(t,a),t}}(),r=n(0),i=d(r),c=d(n(19)),u=d(n(5)),s=n(1232),l=d(n(1236));function d(e){return e&&e.__esModule?e:{default:e}}var f=function(e){function t(e,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var a=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e,n));return a.handleLoad=function(){a.forceUpdate()},a._isMounted=!1,a}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),o(t,[{key:"componentDidMount",value:function(){this._isMounted=!0;var e=this.getDoc();e&&"complete"===e.readyState?this.forceUpdate():this.node.addEventListener("load",this.handleLoad)}},{key:"componentWillUnmount",value:function(){this._isMounted=!1,this.node.removeEventListener("load",this.handleLoad)}},{key:"getDoc",value:function(){return this.node?this.node.contentDocument:null}},{key:"getMountTarget",value:function(){var e=this.getDoc();return this.props.mountTarget?e.querySelector(this.props.mountTarget):e.body.children[0]}},{key:"renderFrameContents",value:function(){if(!this._isMounted)return null;var e=this.getDoc();if(!e)return null;var t=this.props.contentDidMount,n=this.props.contentDidUpdate,a=e.defaultView||e.parentView,o=i.default.createElement(l.default,{contentDidMount:t,contentDidUpdate:n},i.default.createElement(s.FrameContextProvider,{value:{document:e,window:a}},i.default.createElement("div",{className:"frame-content"},this.props.children)));e.body.children.length<1&&(e.open("text/html","replace"),e.write(this.props.initialContent),e.close());var r=this.getMountTarget();return[c.default.createPortal(this.props.head,this.getDoc().head),c.default.createPortal(o,r)]}},{key:"render",value:function(){var e=this,t=a({},this.props,{children:void 0});return delete t.head,delete t.initialContent,delete t.mountTarget,delete t.contentDidMount,delete t.contentDidUpdate,i.default.createElement("iframe",a({},t,{ref:function(t){e.node=t}}),this.renderFrameContents())}}]),t}(r.Component);f.propTypes={style:u.default.object,head:u.default.node,initialContent:u.default.string,mountTarget:u.default.string,contentDidMount:u.default.func,contentDidUpdate:u.default.func,children:u.default.oneOfType([u.default.element,u.default.arrayOf(u.default.element)])},f.defaultProps={style:{},head:null,children:void 0,mountTarget:void 0,contentDidMount:function(){},contentDidUpdate:function(){},initialContent:'<!DOCTYPE html><html><head></head><body><div class="frame-root"></div></body></html>'},t.default=f},1236:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=function(){function e(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(t,n,a){return n&&e(t.prototype,n),a&&e(t,a),t}}(),o=n(0),r=(i(o),i(n(5)));function i(e){return e&&e.__esModule?e:{default:e}}function c(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function u(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}var s=function(e){function t(){return c(this,t),u(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),a(t,[{key:"componentDidMount",value:function(){this.props.contentDidMount()}},{key:"componentDidUpdate",value:function(){this.props.contentDidUpdate()}},{key:"render",value:function(){return o.Children.only(this.props.children)}}]),t}(o.Component);s.propTypes={children:r.default.element.isRequired,contentDidMount:r.default.func.isRequired,contentDidUpdate:r.default.func.isRequired},t.default=s},1425:function(e,t,n){"use strict";var a=n(2),o=n(0),r=(n(5),n(10)),i={WebkitFontSmoothing:"antialiased",MozOsxFontSmoothing:"grayscale",boxSizing:"border-box"},c=function(e){return Object(a.a)({color:e.palette.text.primary},e.typography.body2,{backgroundColor:e.palette.background.default,"@media print":{backgroundColor:e.palette.common.white}})};t.a=Object(r.a)((function(e){return{"@global":{html:i,"*, *::before, *::after":{boxSizing:"inherit"},"strong, b":{fontWeight:e.typography.fontWeightBold},body:Object(a.a)({margin:0},c(e),{"&::backdrop":{backgroundColor:e.palette.background.default}})}}}),{name:"MuiCssBaseline"})((function(e){var t=e.children,n=void 0===t?null:t;return e.classes,o.createElement(o.Fragment,null,n)}))},1561:function(e,t,n){"use strict";var a=n(2),o=n(7),r=n(23),i=n(0),c=(n(5),n(3)),u=n(10),s=n(12),l=i.forwardRef((function(e,t){var n=e.classes,r=e.className,u=e.component,l=void 0===u?"div":u,d=e.disableGutters,f=void 0!==d&&d,m=e.fixed,p=void 0!==m&&m,b=e.maxWidth,h=void 0===b?"lg":b,y=Object(o.a)(e,["classes","className","component","disableGutters","fixed","maxWidth"]);return i.createElement(l,Object(a.a)({className:Object(c.default)(n.root,r,p&&n.fixed,f&&n.disableGutters,!1!==h&&n["maxWidth".concat(Object(s.a)(String(h)))]),ref:t},y))}));t.a=Object(u.a)((function(e){return{root:Object(r.a)({width:"100%",marginLeft:"auto",boxSizing:"border-box",marginRight:"auto",paddingLeft:e.spacing(2),paddingRight:e.spacing(2),display:"block"},e.breakpoints.up("sm"),{paddingLeft:e.spacing(3),paddingRight:e.spacing(3)}),disableGutters:{paddingLeft:0,paddingRight:0},fixed:Object.keys(e.breakpoints.values).reduce((function(t,n){var a=e.breakpoints.values[n];return 0!==a&&(t[e.breakpoints.up(n)]={maxWidth:a}),t}),{}),maxWidthXs:Object(r.a)({},e.breakpoints.up("xs"),{maxWidth:Math.max(e.breakpoints.values.xs,444)}),maxWidthSm:Object(r.a)({},e.breakpoints.up("sm"),{maxWidth:e.breakpoints.values.sm}),maxWidthMd:Object(r.a)({},e.breakpoints.up("md"),{maxWidth:e.breakpoints.values.md}),maxWidthLg:Object(r.a)({},e.breakpoints.up("lg"),{maxWidth:e.breakpoints.values.lg}),maxWidthXl:Object(r.a)({},e.breakpoints.up("xl"),{maxWidth:e.breakpoints.values.xl})}}),{name:"MuiContainer"})(l)},1939:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return s}));var a=n(0),o=n.n(a),r=n(1425),i=n(169),c=n(1561),u=n(1);function s(){return Object(u.a)(o.a.Fragment,null,Object(u.a)(r.a,null),Object(u.a)(c.a,{maxWidth:"sm"},Object(u.a)(i.a,{component:"div",style:{backgroundColor:"#cfe8fc",height:"100vh"}})))}},1940:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport CssBaseline from '@material-ui/core/CssBaseline';\r\nimport Typography from '@material-ui/core/Typography';\r\nimport Container from '@material-ui/core/Container';\r\n\r\nexport default function SimpleContainer() {\r\n  return (\r\n    <React.Fragment>\r\n      <CssBaseline />\r\n      <Container maxWidth=\"sm\">\r\n        <Typography component=\"div\" style={{ backgroundColor: '#cfe8fc', height: '100vh' }} />\r\n      </Container>\r\n    </React.Fragment>\r\n  );\r\n}\r\n"},1941:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return s}));var a=n(0),o=n.n(a),r=n(1425),i=n(169),c=n(1561),u=n(1);function s(){return Object(u.a)(o.a.Fragment,null,Object(u.a)(r.a,null),Object(u.a)(c.a,{fixed:!0},Object(u.a)(i.a,{component:"div",style:{backgroundColor:"#cfe8fc",height:"100vh"}})))}},1942:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport CssBaseline from '@material-ui/core/CssBaseline';\r\nimport Typography from '@material-ui/core/Typography';\r\nimport Container from '@material-ui/core/Container';\r\n\r\nexport default function FixedContainer() {\r\n  return (\r\n    <React.Fragment>\r\n      <CssBaseline />\r\n      <Container fixed>\r\n        <Typography component=\"div\" style={{ backgroundColor: '#cfe8fc', height: '100vh' }} />\r\n      </Container>\r\n    </React.Fragment>\r\n  );\r\n}\r\n"},2866:function(e,t,n){"use strict";n.r(t);var a=n(0),o=n.n(a),r=n(1233),i=n(140),c=n(1170),u=n(547),s=n(169),l=n(1166),d=n(1),f=Object(l.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));t.default=function(e){return f(),Object(d.a)(o.a.Fragment,null,Object(d.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(d.a)(c.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/container",target:"_blank",role:"button"},Object(d.a)(u.a,null,"link"),Object(d.a)("span",{className:"mx-4"},"Reference"))),Object(d.a)(s.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Container"),Object(d.a)(s.a,{className:"description"},"The container centers your content horizontally. It's the most basic layout element."),Object(d.a)(s.a,{className:"mb-16",component:"div"},"While containers can be nested, most layouts do not require a nested container."),Object(d.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Fluid"),Object(d.a)(s.a,{className:"mb-16",component:"div"},"A fluid container width is bounded by the ",Object(d.a)("code",null,"maxWidth")," property value."),Object(d.a)(s.a,{className:"mb-16",component:"div"},Object(d.a)(r.a,{className:"my-24",iframe:!0,component:n(1939).default,raw:n(1940)})),Object(d.a)(i.a,{component:"pre",className:"language-jsx"},' \n<Container maxWidth="sm">\n'),Object(d.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Fixed"),Object(d.a)(s.a,{className:"mb-16",component:"div"},"If you prefer to design for a fixed set of sizes instead of trying to accommodate a fully fluid viewport, you can set the ",Object(d.a)("code",null,"fixed")," property. The max-width matches the min-width of the current breakpoint."),Object(d.a)(s.a,{className:"mb-16",component:"div"},Object(d.a)(r.a,{className:"my-24",iframe:!0,component:n(1941).default,raw:n(1942)})),Object(d.a)(i.a,{component:"pre",className:"language-jsx"}," \n<Container fixed>\n"))}}}]);