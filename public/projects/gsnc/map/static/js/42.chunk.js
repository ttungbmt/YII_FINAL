(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[42],{1138:function(e,t,n){"use strict";n.r(t);var r=n(419);n.d(t,"default",(function(){return r.a}))},1231:function(e,t,n){"use strict";var r=n(648);Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e,t){var n=o.default.memo(o.default.forwardRef((function(t,n){return o.default.createElement(i.default,(0,a.default)({ref:n},t),e)})));0;return n.muiName=i.default.muiName,n};var a=r(n(141)),o=r(n(0)),i=r(n(1138))},1232:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContextProvider=t.FrameContext=void 0;var r,a=n(0),o=(r=a)&&r.__esModule?r:{default:r};var i=void 0,c=void 0;"undefined"!==typeof document&&(i=document),"undefined"!==typeof window&&(c=window);var s=t.FrameContext=o.default.createContext({document:i,window:c}),l=s.Provider,u=s.Consumer;t.FrameContextProvider=l,t.FrameContextConsumer=u},1233:function(e,t,n){"use strict";n.d(t,"a",(function(){return E}));var r=n(14),a=n(140),o=n(1211),i=n(1218),c=n(547),s=n(1224),l=n(1225),u=n(0),m=n.n(u),d=n(18),f=n(8),p=n(86),h=n(87),b=n(150),v=n(149),O=n(1121),y=n(643),j=n(1158),g=n(1210),w=n(10),k=n(420),T=n(421),A=n(1234),C=n.n(A),N=n(1),x=Object(O.a)({productionPrefix:"iframe-"}),S=function(e){Object(b.a)(n,e);var t=Object(v.a)(n);function n(){var e;Object(p.a)(this,n);for(var r=arguments.length,a=new Array(r),o=0;o<r;o++)a[o]=arguments[o];return(e=t.call.apply(t,[this].concat(a))).state={ready:!1},e.handleRef=function(t){e.contentDocument=t?t.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(k.a)(Object(f.a)(Object(f.a)({},Object(y.a)()),{},{plugins:[].concat(Object(d.a)(Object(y.a)().plugins),[Object(T.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(N.a)(m.a.Fragment,null,Object(N.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(N.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(h.a)(n,[{key:"render",value:function(){var e=this.props,t=e.children,n=e.classes,r=e.theme;return Object(N.a)(C.a,{head:this.renderHead(),ref:this.handleRef,className:n.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(N.a)(j.b,{jss:this.state.jss,generateClassName:x,sheetsManager:this.state.sheetsManager},Object(N.a)(g.a,{theme:r},m.a.cloneElement(t,{container:this.state.container}))):null)}}]),n}(m.a.Component),M=Object(w.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(S);function _(e){var t=Object(u.useState)(e.currentTabIndex),n=Object(r.a)(t,2),m=n[0],d=n[1],f=e.component,p=e.raw,h=e.iframe,b=e.className;return Object(N.a)(i.a,{className:b},Object(N.a)(o.a,{position:"static",color:"default",elevation:0},Object(N.a)(l.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:m,onChange:function(e,t){d(t)}},f&&Object(N.a)(s.a,{classes:{root:"min-w-64"},icon:Object(N.a)(c.a,null,"remove_red_eye")}),p&&Object(N.a)(s.a,{classes:{root:"min-w-64"},icon:Object(N.a)(c.a,null,"code")}))),Object(N.a)("div",{className:"flex justify-center max-w-full"},Object(N.a)("div",{className:0===m?"flex flex-1 max-w-full":"hidden"},f&&(h?Object(N.a)(M,null,Object(N.a)(f,null)):Object(N.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(N.a)(f,null)))),Object(N.a)("div",{className:1===m?"flex flex-1":"hidden"},p&&Object(N.a)("div",{className:"flex flex-1"},Object(N.a)(a.a,{component:"pre",className:"language-javascript w-full"},p.default)))))}_.defaultProps={currentTabIndex:0};var E=_},1234:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContext=void 0;var r=n(1232);Object.defineProperty(t,"FrameContext",{enumerable:!0,get:function(){return r.FrameContext}}),Object.defineProperty(t,"FrameContextConsumer",{enumerable:!0,get:function(){return r.FrameContextConsumer}});var a,o=n(1235),i=(a=o)&&a.__esModule?a:{default:a};t.default=i.default},1235:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},a=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),o=n(0),i=m(o),c=m(n(19)),s=m(n(5)),l=n(1232),u=m(n(1236));function m(e){return e&&e.__esModule?e:{default:e}}var d=function(e){function t(e,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var r=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e,n));return r.handleLoad=function(){r.forceUpdate()},r._isMounted=!1,r}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),a(t,[{key:"componentDidMount",value:function(){this._isMounted=!0;var e=this.getDoc();e&&"complete"===e.readyState?this.forceUpdate():this.node.addEventListener("load",this.handleLoad)}},{key:"componentWillUnmount",value:function(){this._isMounted=!1,this.node.removeEventListener("load",this.handleLoad)}},{key:"getDoc",value:function(){return this.node?this.node.contentDocument:null}},{key:"getMountTarget",value:function(){var e=this.getDoc();return this.props.mountTarget?e.querySelector(this.props.mountTarget):e.body.children[0]}},{key:"renderFrameContents",value:function(){if(!this._isMounted)return null;var e=this.getDoc();if(!e)return null;var t=this.props.contentDidMount,n=this.props.contentDidUpdate,r=e.defaultView||e.parentView,a=i.default.createElement(u.default,{contentDidMount:t,contentDidUpdate:n},i.default.createElement(l.FrameContextProvider,{value:{document:e,window:r}},i.default.createElement("div",{className:"frame-content"},this.props.children)));e.body.children.length<1&&(e.open("text/html","replace"),e.write(this.props.initialContent),e.close());var o=this.getMountTarget();return[c.default.createPortal(this.props.head,this.getDoc().head),c.default.createPortal(a,o)]}},{key:"render",value:function(){var e=this,t=r({},this.props,{children:void 0});return delete t.head,delete t.initialContent,delete t.mountTarget,delete t.contentDidMount,delete t.contentDidUpdate,i.default.createElement("iframe",r({},t,{ref:function(t){e.node=t}}),this.renderFrameContents())}}]),t}(o.Component);d.propTypes={style:s.default.object,head:s.default.node,initialContent:s.default.string,mountTarget:s.default.string,contentDidMount:s.default.func,contentDidUpdate:s.default.func,children:s.default.oneOfType([s.default.element,s.default.arrayOf(s.default.element)])},d.defaultProps={style:{},head:null,children:void 0,mountTarget:void 0,contentDidMount:function(){},contentDidUpdate:function(){},initialContent:'<!DOCTYPE html><html><head></head><body><div class="frame-root"></div></body></html>'},t.default=d},1236:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),a=n(0),o=(i(a),i(n(5)));function i(e){return e&&e.__esModule?e:{default:e}}function c(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function s(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}var l=function(e){function t(){return c(this,t),s(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),r(t,[{key:"componentDidMount",value:function(){this.props.contentDidMount()}},{key:"componentDidUpdate",value:function(){this.props.contentDidUpdate()}},{key:"render",value:function(){return a.Children.only(this.props.children)}}]),t}(a.Component);l.propTypes={children:o.default.element.isRequired,contentDidMount:o.default.func.isRequired,contentDidUpdate:o.default.func.isRequired},t.default=l},1307:function(e,t,n){"use strict";var r=n(648);Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=r(n(0)),o=(0,r(n(1231)).default)(a.default.createElement("path",{d:"M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"}),"Close");t.default=o},1347:function(e,t,n){"use strict";var r=n(648);Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=r(n(0)),o=(0,r(n(1231)).default)(a.default.createElement("path",{d:"M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"}),"Check");t.default=o},1391:function(e,t,n){"use strict";var r=n(0),a=n(66);t.a=Object(a.a)(r.createElement("path",{d:"M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"}),"Close")},1707:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return c}));n(0);var r=n(1166),a=n(2804),o=n(1),i=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function c(){var e=i();return Object(o.a)("div",{className:e.root},Object(o.a)(a.a,{severity:"error"},"This is an error alert \u2014 check it out!"),Object(o.a)(a.a,{severity:"warning"},"This is a warning alert \u2014 check it out!"),Object(o.a)(a.a,{severity:"info"},"This is an info alert \u2014 check it out!"),Object(o.a)(a.a,{severity:"success"},"This is a success alert \u2014 check it out!"))}},1708:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Alert from '@material-ui/lab/Alert';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function SimpleAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert severity=\"error\">This is an error alert \u2014 check it out!</Alert>\r\n      <Alert severity=\"warning\">This is a warning alert \u2014 check it out!</Alert>\r\n      <Alert severity=\"info\">This is an info alert \u2014 check it out!</Alert>\r\n      <Alert severity=\"success\">This is a success alert \u2014 check it out!</Alert>\r\n    </div>\r\n  );\r\n}\r\n"},1709:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport { Alert, AlertTitle } from '@material-ui/lab';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function DescriptionAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert severity=\"error\">\r\n        <AlertTitle>Error</AlertTitle>\r\n        This is an error alert \u2014 <strong>check it out!</strong>\r\n      </Alert>\r\n      <Alert severity=\"warning\">\r\n        <AlertTitle>Warning</AlertTitle>\r\n        This is a warning alert \u2014 <strong>check it out!</strong>\r\n      </Alert>\r\n      <Alert severity=\"info\">\r\n        <AlertTitle>Info</AlertTitle>\r\n        This is an info alert \u2014 <strong>check it out!</strong>\r\n      </Alert>\r\n      <Alert severity=\"success\">\r\n        <AlertTitle>Success</AlertTitle>\r\n        This is a success alert \u2014 <strong>check it out!</strong>\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n"},1710:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return s}));n(0);var r=n(1166),a=n(2804),o=n(1170),i=n(1),c=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function s(){var e=c();return Object(i.a)("div",{className:e.root},Object(i.a)(a.a,{onClose:function(){}},"This is a success alert \u2014 check it out!"),Object(i.a)(a.a,{action:Object(i.a)(o.a,{color:"inherit",size:"small"},"UNDO")},"This is a success alert \u2014 check it out!"))}},1711:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Alert from '@material-ui/lab/Alert';\r\nimport Button from '@material-ui/core/Button';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function ActionAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert onClose={() => {}}>This is a success alert \u2014 check it out!</Alert>\r\n      <Alert\r\n        action={\r\n          <Button color=\"inherit\" size=\"small\">\r\n            UNDO\r\n          </Button>\r\n        }\r\n      >\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n"},1712:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return h}));var r=n(14),a=n(0),o=n.n(a),i=n(1166),c=n(2804),s=n(399),l=n(1215),u=n(1170),m=n(1307),d=n.n(m),f=n(1),p=Object(i.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function h(){var e=p(),t=o.a.useState(!0),n=Object(r.a)(t,2),a=n[0],i=n[1];return Object(f.a)("div",{className:e.root},Object(f.a)(l.a,{in:a},Object(f.a)(c.a,{action:Object(f.a)(s.a,{"aria-label":"close",color:"inherit",size:"small",onClick:function(){i(!1)}},Object(f.a)(d.a,{fontSize:"inherit"}))},"Close me!")),Object(f.a)(u.a,{disabled:a,variant:"outlined",onClick:function(){i(!0)}},"Re-open"))}},1713:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Alert from '@material-ui/lab/Alert';\r\nimport IconButton from '@material-ui/core/IconButton';\r\nimport Collapse from '@material-ui/core/Collapse';\r\nimport Button from '@material-ui/core/Button';\r\nimport CloseIcon from '@material-ui/icons/Close';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function TransitionAlerts() {\r\n  const classes = useStyles();\r\n  const [open, setOpen] = React.useState(true);\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Collapse in={open}>\r\n        <Alert\r\n          action={\r\n            <IconButton\r\n              aria-label=\"close\"\r\n              color=\"inherit\"\r\n              size=\"small\"\r\n              onClick={() => {\r\n                setOpen(false);\r\n              }}\r\n            >\r\n              <CloseIcon fontSize=\"inherit\" />\r\n            </IconButton>\r\n          }\r\n        >\r\n          Close me!\r\n        </Alert>\r\n      </Collapse>\r\n      <Button\r\n        disabled={open}\r\n        variant=\"outlined\"\r\n        onClick={() => {\r\n          setOpen(true);\r\n        }}\r\n      >\r\n        Re-open\r\n      </Button>\r\n    </div>\r\n  );\r\n}\r\n"},1714:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return m}));n(0);var r=n(1166),a=n(2804),o=n(1347),i=n.n(o),c=n(1715),s=n.n(c),l=n(1),u=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function m(){var e=u();return Object(l.a)("div",{className:e.root},Object(l.a)(a.a,{icon:Object(l.a)(i.a,{fontSize:"inherit"}),severity:"success"},"This is a success alert \u2014 check it out!"),Object(l.a)(a.a,{iconMapping:{success:Object(l.a)(s.a,{fontSize:"inherit"})}},"This is a success alert \u2014 check it out!"),Object(l.a)(a.a,{icon:!1,severity:"success"},"This is a success alert \u2014 check it out!"))}},1715:function(e,t,n){"use strict";var r=n(648);Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=r(n(0)),o=(0,r(n(1231)).default)(a.default.createElement("path",{d:"M16.59 7.58L10 14.17l-3.59-3.58L5 12l5 5 8-8zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"}),"CheckCircleOutline");t.default=o},1716:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Alert from '@material-ui/lab/Alert';\r\nimport CheckIcon from '@material-ui/icons/Check';\r\nimport CheckCircleOutlineIcon from '@material-ui/icons/CheckCircleOutline';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function IconAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert icon={<CheckIcon fontSize=\"inherit\" />} severity=\"success\">\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert iconMapping={{ success: <CheckCircleOutlineIcon fontSize=\"inherit\" /> }}>\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert icon={false} severity=\"success\">\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n"},1717:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return c}));n(0);var r=n(1166),a=n(2804),o=n(1),i=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function c(){var e=i();return Object(o.a)("div",{className:e.root},Object(o.a)(a.a,{variant:"outlined",severity:"error"},"This is an error alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"outlined",severity:"warning"},"This is a warning alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"outlined",severity:"info"},"This is an info alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"outlined",severity:"success"},"This is a success alert \u2014 check it out!"))}},1718:function(e,t,n){"use strict";n.r(t),t.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport Alert from \'@material-ui/lab/Alert\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: \'100%\',\r\n    \'& > * + *\': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function SimpleAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert variant="outlined" severity="error">\r\n        This is an error alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="outlined" severity="warning">\r\n        This is a warning alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="outlined" severity="info">\r\n        This is an info alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="outlined" severity="success">\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n'},1719:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return c}));n(0);var r=n(1166),a=n(2804),o=n(1),i=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function c(){var e=i();return Object(o.a)("div",{className:e.root},Object(o.a)(a.a,{variant:"filled",severity:"error"},"This is an error alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"filled",severity:"warning"},"This is a warning alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"filled",severity:"info"},"This is an info alert \u2014 check it out!"),Object(o.a)(a.a,{variant:"filled",severity:"success"},"This is a success alert \u2014 check it out!"))}},1720:function(e,t,n){"use strict";n.r(t),t.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport Alert from \'@material-ui/lab/Alert\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: \'100%\',\r\n    \'& > * + *\': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function SimpleAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert variant="filled" severity="error">\r\n        This is an error alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="filled" severity="warning">\r\n        This is a warning alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="filled" severity="info">\r\n        This is an info alert \u2014 check it out!\r\n      </Alert>\r\n      <Alert variant="filled" severity="success">\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n'},1721:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return c}));n(0);var r=n(1166),a=n(2804),o=n(1),i=Object(r.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function c(){var e=i();return Object(o.a)("div",{className:e.root},Object(o.a)(a.a,{severity:"success",color:"info"},"This is a success alert \u2014 check it out!"))}},1722:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Alert from '@material-ui/lab/Alert';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function ColorAlerts() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Alert severity=\"success\" color=\"info\">\r\n        This is a success alert \u2014 check it out!\r\n      </Alert>\r\n    </div>\r\n  );\r\n}\r\n"},2804:function(e,t,n){"use strict";var r=n(7),a=n(2),o=n(0),i=(n(5),n(3)),c=n(26),s=n(10),l=n(221),u=n(66),m=Object(u.a)(o.createElement("path",{d:"M20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.76,4 13.5,4.11 14.2, 4.31L15.77,2.74C14.61,2.26 13.34,2 12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0, 0 22,12M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z"}),"SuccessOutlined"),d=Object(u.a)(o.createElement("path",{d:"M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z"}),"ReportProblemOutlined"),f=Object(u.a)(o.createElement("path",{d:"M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"}),"ErrorOutline"),p=Object(u.a)(o.createElement("path",{d:"M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"}),"InfoOutlined"),h=n(1391),b=n(399),v=n(12),O={success:o.createElement(m,{fontSize:"inherit"}),warning:o.createElement(d,{fontSize:"inherit"}),error:o.createElement(f,{fontSize:"inherit"}),info:o.createElement(p,{fontSize:"inherit"})},y=o.createElement(h.a,{fontSize:"small"}),j=o.forwardRef((function(e,t){var n=e.action,c=e.children,s=e.classes,u=e.className,m=e.closeText,d=void 0===m?"Close":m,f=e.color,p=e.icon,h=e.iconMapping,j=void 0===h?O:h,g=e.onClose,w=e.role,k=void 0===w?"alert":w,T=e.severity,A=void 0===T?"success":T,C=e.variant,N=void 0===C?"standard":C,x=Object(r.a)(e,["action","children","classes","className","closeText","color","icon","iconMapping","onClose","role","severity","variant"]);return o.createElement(l.a,Object(a.a)({role:k,square:!0,elevation:0,className:Object(i.default)(s.root,s["".concat(N).concat(Object(v.a)(f||A))],u),ref:t},x),!1!==p?o.createElement("div",{className:s.icon},p||j[A]||O[A]):null,o.createElement("div",{className:s.message},c),null!=n?o.createElement("div",{className:s.action},n):null,null==n&&g?o.createElement("div",{className:s.action},o.createElement(b.a,{size:"small","aria-label":d,title:d,color:"inherit",onClick:g},y)):null)}));t.a=Object(s.a)((function(e){var t="light"===e.palette.type?c.a:c.i,n="light"===e.palette.type?c.i:c.a;return{root:Object(a.a)({},e.typography.body2,{borderRadius:e.shape.borderRadius,backgroundColor:"transparent",display:"flex",padding:"6px 16px"}),standardSuccess:{color:t(e.palette.success.main,.6),backgroundColor:n(e.palette.success.main,.9),"& $icon":{color:e.palette.success.main}},standardInfo:{color:t(e.palette.info.main,.6),backgroundColor:n(e.palette.info.main,.9),"& $icon":{color:e.palette.info.main}},standardWarning:{color:t(e.palette.warning.main,.6),backgroundColor:n(e.palette.warning.main,.9),"& $icon":{color:e.palette.warning.main}},standardError:{color:t(e.palette.error.main,.6),backgroundColor:n(e.palette.error.main,.9),"& $icon":{color:e.palette.error.main}},outlinedSuccess:{color:t(e.palette.success.main,.6),border:"1px solid ".concat(e.palette.success.main),"& $icon":{color:e.palette.success.main}},outlinedInfo:{color:t(e.palette.info.main,.6),border:"1px solid ".concat(e.palette.info.main),"& $icon":{color:e.palette.info.main}},outlinedWarning:{color:t(e.palette.warning.main,.6),border:"1px solid ".concat(e.palette.warning.main),"& $icon":{color:e.palette.warning.main}},outlinedError:{color:t(e.palette.error.main,.6),border:"1px solid ".concat(e.palette.error.main),"& $icon":{color:e.palette.error.main}},filledSuccess:{color:"#fff",fontWeight:e.typography.fontWeightMedium,backgroundColor:e.palette.success.main},filledInfo:{color:"#fff",fontWeight:e.typography.fontWeightMedium,backgroundColor:e.palette.info.main},filledWarning:{color:"#fff",fontWeight:e.typography.fontWeightMedium,backgroundColor:e.palette.warning.main},filledError:{color:"#fff",fontWeight:e.typography.fontWeightMedium,backgroundColor:e.palette.error.main},icon:{marginRight:12,padding:"7px 0",display:"flex",fontSize:22,opacity:.9},message:{padding:"8px 0"},action:{display:"flex",alignItems:"center",marginLeft:"auto",paddingLeft:16,marginRight:-8}}}),{name:"MuiAlert"})(j)},2806:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return h}));var r=n(0),a=n(1166),o=n(2804),i=n(2),c=n(7),s=(n(5),n(10)),l=n(169),u=n(3),m=r.forwardRef((function(e,t){var n=e.classes,a=e.className,o=Object(c.a)(e,["classes","className"]);return r.createElement(l.a,Object(i.a)({gutterBottom:!0,component:"div",ref:t,className:Object(u.default)(n.root,a)},o))})),d=Object(s.a)((function(e){return{root:{fontWeight:e.typography.fontWeightMedium,marginTop:-2}}}),{name:"MuiAlertTitle"})(m),f=n(1),p=Object(a.a)((function(e){return{root:{width:"100%","& > * + *":{marginTop:e.spacing(2)}}}}));function h(){var e=p();return Object(f.a)("div",{className:e.root},Object(f.a)(o.a,{severity:"error"},Object(f.a)(d,null,"Error"),"This is an error alert \u2014 ",Object(f.a)("strong",null,"check it out!")),Object(f.a)(o.a,{severity:"warning"},Object(f.a)(d,null,"Warning"),"This is a warning alert \u2014 ",Object(f.a)("strong",null,"check it out!")),Object(f.a)(o.a,{severity:"info"},Object(f.a)(d,null,"Info"),"This is an info alert \u2014 ",Object(f.a)("strong",null,"check it out!")),Object(f.a)(o.a,{severity:"success"},Object(f.a)(d,null,"Success"),"This is a success alert \u2014 ",Object(f.a)("strong",null,"check it out!")))}},2850:function(e,t,n){"use strict";n.r(t);var r=n(0),a=n.n(r),o=n(1233),i=(n(140),n(1170)),c=n(547),s=n(169),l=n(1166),u=n(1),m=Object(l.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));t.default=function(e){return m(),Object(u.a)(a.a.Fragment,null,Object(u.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(u.a)(i.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/alert",target:"_blank",role:"button"},Object(u.a)(c.a,null,"link"),Object(u.a)("span",{className:"mx-4"},"Reference"))),Object(u.a)(s.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Alert"),Object(u.a)(s.a,{className:"description"},"An alert displays a short, important message in a way that attracts the user's attention without interrupting the user's task."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)("strong",null,"Note:")," This component is not documented in the ",Object(u.a)("a",{href:"https://material.io/"},"Material Design guidelines"),", but Material-UI supports it."),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Simple alerts"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"The alert offers four severity levels that set a distinctive icon and color."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1707).default,raw:n(1708)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Description"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"You can use the ",Object(u.a)("code",null,"AlertTitle")," component to display a formatted title above the content."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(2806).default,raw:n(1709)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Actions"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"An alert can have an action, such as a close or undo button. It is rendered after the message, at the end of the alert."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"If an ",Object(u.a)("code",null,"onClose")," callback is provided and no ",Object(u.a)("code",null,"action")," prop is set, a close icon is displayed. The ",Object(u.a)("code",null,"action")," prop can be used to provide an alternative action, for example using a Button or IconButton."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1710).default,raw:n(1711)})),Object(u.a)(s.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Transition"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"You can use a ",Object(u.a)("a",{href:"/components/transitions/"},"transition component")," such as ",Object(u.a)("code",null,"Collapse")," to transition the appearance of the alert."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1712).default,raw:n(1713)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Icons"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"The ",Object(u.a)("code",null,"icon")," prop allows you to add an icon to the beginning of the alert component. This will override the default icon for the specified severity."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"You can change the default severity to icon mapping with the ",Object(u.a)("code",null,"iconMapping")," prop. This can be defined globally using ",Object(u.a)("a",{href:"/customization/globals/#default-props"},"theme customization"),"."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"Setting the icon prop to false will remove the icon altogether."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1714).default,raw:n(1716)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Variants"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"Two additional variants are available \u2013 outlined, and filled:"),Object(u.a)(s.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Outlined"),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1717).default,raw:n(1718)})),Object(u.a)(s.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Filled"),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1719).default,raw:n(1720)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Toast"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"You can use the Snackbar to ",Object(u.a)("a",{href:"/components/snackbars/#customized-snackbars"},"display a toast")," with the Alert."),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Color"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"The ",Object(u.a)("code",null,"color")," prop will override the default color for the specified severity."),Object(u.a)(s.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:n(1721).default,raw:n(1722)})),Object(u.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Accessibility"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"(WAI-ARIA: ",Object(u.a)("a",{href:"https://www.w3.org/TR/wai-aria-practices/#alert"},"https://www.w3.org/TR/wai-aria-practices/#alert"),")"),Object(u.a)(s.a,{className:"mb-16",component:"div"},"When the component is dynamically displayed, the content is automatically announced by most screen readers. At this time, screen readers do not inform users of alerts that are present when the page loads."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (for example the visible text), or is included through alternative means, such as additional hidden text."),Object(u.a)(s.a,{className:"mb-16",component:"div"},"Actions must have a tab index of 0 so that they can be reached by keyboard-only users."))}}}]);