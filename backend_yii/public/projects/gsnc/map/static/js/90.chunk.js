(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[90],{1232:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContextProvider=t.FrameContext=void 0;var r,a=n(0),i=(r=a)&&r.__esModule?r:{default:r};var o=void 0,c=void 0;"undefined"!==typeof document&&(o=document),"undefined"!==typeof window&&(c=window);var l=t.FrameContext=i.default.createContext({document:o,window:c}),s=l.Provider,u=l.Consumer;t.FrameContextProvider=s,t.FrameContextConsumer=u},1233:function(e,t,n){"use strict";n.d(t,"a",(function(){return _}));var r=n(14),a=n(140),i=n(1211),o=n(1218),c=n(547),l=n(1224),s=n(1225),u=n(0),d=n.n(u),m=n(18),f=n(8),h=n(86),p=n(87),b=n(150),g=n(149),v=n(1121),O=n(643),x=n(1158),j=n(1210),y=n(10),C=n(420),k=n(421),w=n(1234),L=n.n(w),I=n(1),N=Object(v.a)({productionPrefix:"iframe-"}),S=function(e){Object(b.a)(n,e);var t=Object(g.a)(n);function n(){var e;Object(h.a)(this,n);for(var r=arguments.length,a=new Array(r),i=0;i<r;i++)a[i]=arguments[i];return(e=t.call.apply(t,[this].concat(a))).state={ready:!1},e.handleRef=function(t){e.contentDocument=t?t.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(C.a)(Object(f.a)(Object(f.a)({},Object(O.a)()),{},{plugins:[].concat(Object(m.a)(Object(O.a)().plugins),[Object(k.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(I.a)(d.a.Fragment,null,Object(I.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(I.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(p.a)(n,[{key:"render",value:function(){var e=this.props,t=e.children,n=e.classes,r=e.theme;return Object(I.a)(L.a,{head:this.renderHead(),ref:this.handleRef,className:n.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(I.a)(x.b,{jss:this.state.jss,generateClassName:N,sheetsManager:this.state.sheetsManager},Object(I.a)(j.a,{theme:r},d.a.cloneElement(t,{container:this.state.container}))):null)}}]),n}(d.a.Component),T=Object(y.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(S);function D(e){var t=Object(u.useState)(e.currentTabIndex),n=Object(r.a)(t,2),d=n[0],m=n[1],f=e.component,h=e.raw,p=e.iframe,b=e.className;return Object(I.a)(o.a,{className:b},Object(I.a)(i.a,{position:"static",color:"default",elevation:0},Object(I.a)(s.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:d,onChange:function(e,t){m(t)}},f&&Object(I.a)(l.a,{classes:{root:"min-w-64"},icon:Object(I.a)(c.a,null,"remove_red_eye")}),h&&Object(I.a)(l.a,{classes:{root:"min-w-64"},icon:Object(I.a)(c.a,null,"code")}))),Object(I.a)("div",{className:"flex justify-center max-w-full"},Object(I.a)("div",{className:0===d?"flex flex-1 max-w-full":"hidden"},f&&(p?Object(I.a)(T,null,Object(I.a)(f,null)):Object(I.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(I.a)(f,null)))),Object(I.a)("div",{className:1===d?"flex flex-1":"hidden"},h&&Object(I.a)("div",{className:"flex flex-1"},Object(I.a)(a.a,{component:"pre",className:"language-javascript w-full"},h.default)))))}D.defaultProps={currentTabIndex:0};var _=D},1234:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FrameContextConsumer=t.FrameContext=void 0;var r=n(1232);Object.defineProperty(t,"FrameContext",{enumerable:!0,get:function(){return r.FrameContext}}),Object.defineProperty(t,"FrameContextConsumer",{enumerable:!0,get:function(){return r.FrameContextConsumer}});var a,i=n(1235),o=(a=i)&&a.__esModule?a:{default:a};t.default=o.default},1235:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},a=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),i=n(0),o=d(i),c=d(n(19)),l=d(n(5)),s=n(1232),u=d(n(1236));function d(e){return e&&e.__esModule?e:{default:e}}var m=function(e){function t(e,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var r=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e,n));return r.handleLoad=function(){r.forceUpdate()},r._isMounted=!1,r}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),a(t,[{key:"componentDidMount",value:function(){this._isMounted=!0;var e=this.getDoc();e&&"complete"===e.readyState?this.forceUpdate():this.node.addEventListener("load",this.handleLoad)}},{key:"componentWillUnmount",value:function(){this._isMounted=!1,this.node.removeEventListener("load",this.handleLoad)}},{key:"getDoc",value:function(){return this.node?this.node.contentDocument:null}},{key:"getMountTarget",value:function(){var e=this.getDoc();return this.props.mountTarget?e.querySelector(this.props.mountTarget):e.body.children[0]}},{key:"renderFrameContents",value:function(){if(!this._isMounted)return null;var e=this.getDoc();if(!e)return null;var t=this.props.contentDidMount,n=this.props.contentDidUpdate,r=e.defaultView||e.parentView,a=o.default.createElement(u.default,{contentDidMount:t,contentDidUpdate:n},o.default.createElement(s.FrameContextProvider,{value:{document:e,window:r}},o.default.createElement("div",{className:"frame-content"},this.props.children)));e.body.children.length<1&&(e.open("text/html","replace"),e.write(this.props.initialContent),e.close());var i=this.getMountTarget();return[c.default.createPortal(this.props.head,this.getDoc().head),c.default.createPortal(a,i)]}},{key:"render",value:function(){var e=this,t=r({},this.props,{children:void 0});return delete t.head,delete t.initialContent,delete t.mountTarget,delete t.contentDidMount,delete t.contentDidUpdate,o.default.createElement("iframe",r({},t,{ref:function(t){e.node=t}}),this.renderFrameContents())}}]),t}(i.Component);m.propTypes={style:l.default.object,head:l.default.node,initialContent:l.default.string,mountTarget:l.default.string,contentDidMount:l.default.func,contentDidUpdate:l.default.func,children:l.default.oneOfType([l.default.element,l.default.arrayOf(l.default.element)])},m.defaultProps={style:{},head:null,children:void 0,mountTarget:void 0,contentDidMount:function(){},contentDidUpdate:function(){},initialContent:'<!DOCTYPE html><html><head></head><body><div class="frame-root"></div></body></html>'},t.default=m},1236:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),a=n(0),i=(o(a),o(n(5)));function o(e){return e&&e.__esModule?e:{default:e}}function c(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function l(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}var s=function(e){function t(){return c(this,t),l(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),r(t,[{key:"componentDidMount",value:function(){this.props.contentDidMount()}},{key:"componentDidUpdate",value:function(){this.props.contentDidUpdate()}},{key:"render",value:function(){return a.Children.only(this.props.children)}}]),t}(a.Component);s.propTypes={children:i.default.element.isRequired,contentDidMount:i.default.func.isRequired,contentDidUpdate:i.default.func.isRequired},t.default=s},1280:function(e,t,n){"use strict";var r=n(7),a=n(2),i=n(0),o=(n(5),n(3)),c=n(10),l=[0,1,2,3,4,5,6,7,8,9,10],s=["auto",!0,1,2,3,4,5,6,7,8,9,10,11,12];function u(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1,n=parseFloat(e);return"".concat(n/t).concat(String(e).replace(String(n),"")||"px")}var d=i.forwardRef((function(e,t){var n=e.alignContent,c=void 0===n?"stretch":n,l=e.alignItems,s=void 0===l?"stretch":l,u=e.classes,d=e.className,m=e.component,f=void 0===m?"div":m,h=e.container,p=void 0!==h&&h,b=e.direction,g=void 0===b?"row":b,v=e.item,O=void 0!==v&&v,x=e.justify,j=void 0===x?"flex-start":x,y=e.lg,C=void 0!==y&&y,k=e.md,w=void 0!==k&&k,L=e.sm,I=void 0!==L&&L,N=e.spacing,S=void 0===N?0:N,T=e.wrap,D=void 0===T?"wrap":T,_=e.xl,P=void 0!==_&&_,R=e.xs,M=void 0!==R&&R,G=e.zeroMinWidth,E=void 0!==G&&G,B=Object(r.a)(e,["alignContent","alignItems","classes","className","component","container","direction","item","justify","lg","md","sm","spacing","wrap","xl","xs","zeroMinWidth"]),z=Object(o.default)(u.root,d,p&&[u.container,0!==S&&u["spacing-xs-".concat(String(S))]],O&&u.item,E&&u.zeroMinWidth,"row"!==g&&u["direction-xs-".concat(String(g))],"wrap"!==D&&u["wrap-xs-".concat(String(D))],"stretch"!==s&&u["align-items-xs-".concat(String(s))],"stretch"!==c&&u["align-content-xs-".concat(String(c))],"flex-start"!==j&&u["justify-xs-".concat(String(j))],!1!==M&&u["grid-xs-".concat(String(M))],!1!==I&&u["grid-sm-".concat(String(I))],!1!==w&&u["grid-md-".concat(String(w))],!1!==C&&u["grid-lg-".concat(String(C))],!1!==P&&u["grid-xl-".concat(String(P))]);return i.createElement(f,Object(a.a)({className:z,ref:t},B))})),m=Object(c.a)((function(e){return Object(a.a)({root:{},container:{boxSizing:"border-box",display:"flex",flexWrap:"wrap",width:"100%"},item:{boxSizing:"border-box",margin:"0"},zeroMinWidth:{minWidth:0},"direction-xs-column":{flexDirection:"column"},"direction-xs-column-reverse":{flexDirection:"column-reverse"},"direction-xs-row-reverse":{flexDirection:"row-reverse"},"wrap-xs-nowrap":{flexWrap:"nowrap"},"wrap-xs-wrap-reverse":{flexWrap:"wrap-reverse"},"align-items-xs-center":{alignItems:"center"},"align-items-xs-flex-start":{alignItems:"flex-start"},"align-items-xs-flex-end":{alignItems:"flex-end"},"align-items-xs-baseline":{alignItems:"baseline"},"align-content-xs-center":{alignContent:"center"},"align-content-xs-flex-start":{alignContent:"flex-start"},"align-content-xs-flex-end":{alignContent:"flex-end"},"align-content-xs-space-between":{alignContent:"space-between"},"align-content-xs-space-around":{alignContent:"space-around"},"justify-xs-center":{justifyContent:"center"},"justify-xs-flex-end":{justifyContent:"flex-end"},"justify-xs-space-between":{justifyContent:"space-between"},"justify-xs-space-around":{justifyContent:"space-around"},"justify-xs-space-evenly":{justifyContent:"space-evenly"}},function(e,t){var n={};return l.forEach((function(r){var a=e.spacing(r);0!==a&&(n["spacing-".concat(t,"-").concat(r)]={margin:"-".concat(u(a,2)),width:"calc(100% + ".concat(u(a),")"),"& > $item":{padding:u(a,2)}})})),n}(e,"xs"),e.breakpoints.keys.reduce((function(t,n){return function(e,t,n){var r={};s.forEach((function(e){var t="grid-".concat(n,"-").concat(e);if(!0!==e)if("auto"!==e){var a="".concat(Math.round(e/12*1e8)/1e6,"%");r[t]={flexBasis:a,flexGrow:0,maxWidth:a}}else r[t]={flexBasis:"auto",flexGrow:0,maxWidth:"none"};else r[t]={flexBasis:0,flexGrow:1,maxWidth:"100%"}})),"xs"===n?Object(a.a)(e,r):e[t.breakpoints.up(n)]=r}(t,e,n),t}),{}))}),{name:"MuiGrid"})(d);t.a=m},1483:function(e,t,n){"use strict";var r=n(2),a=n(7),i=n(0),o=(n(5),n(3)),c=n(10),l=n(169),s=i.forwardRef((function(e,t){var n=e.action,c=e.avatar,s=e.classes,u=e.className,d=e.component,m=void 0===d?"div":d,f=e.disableTypography,h=void 0!==f&&f,p=e.subheader,b=e.subheaderTypographyProps,g=e.title,v=e.titleTypographyProps,O=Object(a.a)(e,["action","avatar","classes","className","component","disableTypography","subheader","subheaderTypographyProps","title","titleTypographyProps"]),x=g;null==x||x.type===l.a||h||(x=i.createElement(l.a,Object(r.a)({variant:c?"body2":"h5",className:s.title,component:"span",display:"block"},v),x));var j=p;return null==j||j.type===l.a||h||(j=i.createElement(l.a,Object(r.a)({variant:c?"body2":"body1",className:s.subheader,color:"textSecondary",component:"span",display:"block"},b),j)),i.createElement(m,Object(r.a)({className:Object(o.default)(s.root,u),ref:t},O),c&&i.createElement("div",{className:s.avatar},c),i.createElement("div",{className:s.content},x,j),n&&i.createElement("div",{className:s.action},n))}));t.a=Object(c.a)({root:{display:"flex",alignItems:"center",padding:16},avatar:{flex:"0 0 auto",marginRight:16},action:{flex:"0 0 auto",alignSelf:"flex-start",marginTop:-8,marginRight:-8},content:{flex:"1 1 auto"},title:{},subheader:{}},{name:"MuiCardHeader"})(s)},2492:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return x}));var r=n(18),a=n(14),i=n(0),o=n.n(i),c=n(1166),l=n(1280),s=n(1129),u=n(1130),d=n(1220),m=n(1173),f=n(1176),h=n(1170),p=n(221),b=n(1),g=Object(c.a)((function(e){return{root:{margin:"auto"},paper:{width:200,height:230,overflow:"auto"},button:{margin:e.spacing(.5,0)}}}));function v(e,t){return e.filter((function(e){return-1===t.indexOf(e)}))}function O(e,t){return e.filter((function(e){return-1!==t.indexOf(e)}))}function x(){var e=g(),t=o.a.useState([]),n=Object(a.a)(t,2),i=n[0],c=n[1],x=o.a.useState([0,1,2,3]),j=Object(a.a)(x,2),y=j[0],C=j[1],k=o.a.useState([4,5,6,7]),w=Object(a.a)(k,2),L=w[0],I=w[1],N=O(i,y),S=O(i,L),T=function(e){return function(){var t=i.indexOf(e),n=Object(r.a)(i);-1===t?n.push(e):n.splice(t,1),c(n)}},D=function(t){return Object(b.a)(p.a,{className:e.paper},Object(b.a)(s.a,{dense:!0,component:"div",role:"list"},t.map((function(e){var t="transfer-list-item-".concat(e,"-label");return Object(b.a)(u.a,{key:e,role:"listitem",button:!0,onClick:T(e)},Object(b.a)(d.a,null,Object(b.a)(f.a,{checked:-1!==i.indexOf(e),tabIndex:-1,disableRipple:!0,inputProps:{"aria-labelledby":t}})),Object(b.a)(m.a,{id:t,primary:"List item ".concat(e+1)}))})),Object(b.a)(u.a,null)))};return Object(b.a)(l.a,{container:!0,spacing:2,justify:"center",alignItems:"center",className:e.root},Object(b.a)(l.a,{item:!0},D(y)),Object(b.a)(l.a,{item:!0},Object(b.a)(l.a,{container:!0,direction:"column",alignItems:"center"},Object(b.a)(h.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){I(L.concat(y)),C([])},disabled:0===y.length,"aria-label":"move all right"},"\u226b"),Object(b.a)(h.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){I(L.concat(N)),C(v(y,N)),c(v(i,N))},disabled:0===N.length,"aria-label":"move selected right"},">"),Object(b.a)(h.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){C(y.concat(S)),I(v(L,S)),c(v(i,S))},disabled:0===S.length,"aria-label":"move selected left"},"<"),Object(b.a)(h.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){C(y.concat(L)),I([])},disabled:0===L.length,"aria-label":"move all left"},"\u226a"))),Object(b.a)(l.a,{item:!0},D(L)))}},2493:function(e,t,n){"use strict";n.r(t),t.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport Grid from \'@material-ui/core/Grid\';\r\nimport List from \'@material-ui/core/List\';\r\nimport ListItem from \'@material-ui/core/ListItem\';\r\nimport ListItemIcon from \'@material-ui/core/ListItemIcon\';\r\nimport ListItemText from \'@material-ui/core/ListItemText\';\r\nimport Checkbox from \'@material-ui/core/Checkbox\';\r\nimport Button from \'@material-ui/core/Button\';\r\nimport Paper from \'@material-ui/core/Paper\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    margin: \'auto\',\r\n  },\r\n  paper: {\r\n    width: 200,\r\n    height: 230,\r\n    overflow: \'auto\',\r\n  },\r\n  button: {\r\n    margin: theme.spacing(0.5, 0),\r\n  },\r\n}));\r\n\r\nfunction not(a, b) {\r\n  return a.filter((value) => b.indexOf(value) === -1);\r\n}\r\n\r\nfunction intersection(a, b) {\r\n  return a.filter((value) => b.indexOf(value) !== -1);\r\n}\r\n\r\nexport default function TransferList() {\r\n  const classes = useStyles();\r\n  const [checked, setChecked] = React.useState([]);\r\n  const [left, setLeft] = React.useState([0, 1, 2, 3]);\r\n  const [right, setRight] = React.useState([4, 5, 6, 7]);\r\n\r\n  const leftChecked = intersection(checked, left);\r\n  const rightChecked = intersection(checked, right);\r\n\r\n  const handleToggle = (value) => () => {\r\n    const currentIndex = checked.indexOf(value);\r\n    const newChecked = [...checked];\r\n\r\n    if (currentIndex === -1) {\r\n      newChecked.push(value);\r\n    } else {\r\n      newChecked.splice(currentIndex, 1);\r\n    }\r\n\r\n    setChecked(newChecked);\r\n  };\r\n\r\n  const handleAllRight = () => {\r\n    setRight(right.concat(left));\r\n    setLeft([]);\r\n  };\r\n\r\n  const handleCheckedRight = () => {\r\n    setRight(right.concat(leftChecked));\r\n    setLeft(not(left, leftChecked));\r\n    setChecked(not(checked, leftChecked));\r\n  };\r\n\r\n  const handleCheckedLeft = () => {\r\n    setLeft(left.concat(rightChecked));\r\n    setRight(not(right, rightChecked));\r\n    setChecked(not(checked, rightChecked));\r\n  };\r\n\r\n  const handleAllLeft = () => {\r\n    setLeft(left.concat(right));\r\n    setRight([]);\r\n  };\r\n\r\n  const customList = (items) => (\r\n    <Paper className={classes.paper}>\r\n      <List dense component="div" role="list">\r\n        {items.map((value) => {\r\n          const labelId = `transfer-list-item-${value}-label`;\r\n\r\n          return (\r\n            <ListItem key={value} role="listitem" button onClick={handleToggle(value)}>\r\n              <ListItemIcon>\r\n                <Checkbox\r\n                  checked={checked.indexOf(value) !== -1}\r\n                  tabIndex={-1}\r\n                  disableRipple\r\n                  inputProps={{ \'aria-labelledby\': labelId }}\r\n                />\r\n              </ListItemIcon>\r\n              <ListItemText id={labelId} primary={`List item ${value + 1}`} />\r\n            </ListItem>\r\n          );\r\n        })}\r\n        <ListItem />\r\n      </List>\r\n    </Paper>\r\n  );\r\n\r\n  return (\r\n    <Grid container spacing={2} justify="center" alignItems="center" className={classes.root}>\r\n      <Grid item>{customList(left)}</Grid>\r\n      <Grid item>\r\n        <Grid container direction="column" alignItems="center">\r\n          <Button\r\n            variant="outlined"\r\n            size="small"\r\n            className={classes.button}\r\n            onClick={handleAllRight}\r\n            disabled={left.length === 0}\r\n            aria-label="move all right"\r\n          >\r\n            \u226b\r\n          </Button>\r\n          <Button\r\n            variant="outlined"\r\n            size="small"\r\n            className={classes.button}\r\n            onClick={handleCheckedRight}\r\n            disabled={leftChecked.length === 0}\r\n            aria-label="move selected right"\r\n          >\r\n            &gt;\r\n          </Button>\r\n          <Button\r\n            variant="outlined"\r\n            size="small"\r\n            className={classes.button}\r\n            onClick={handleCheckedLeft}\r\n            disabled={rightChecked.length === 0}\r\n            aria-label="move selected left"\r\n          >\r\n            &lt;\r\n          </Button>\r\n          <Button\r\n            variant="outlined"\r\n            size="small"\r\n            className={classes.button}\r\n            onClick={handleAllLeft}\r\n            disabled={right.length === 0}\r\n            aria-label="move all left"\r\n          >\r\n            \u226a\r\n          </Button>\r\n        </Grid>\r\n      </Grid>\r\n      <Grid item>{customList(right)}</Grid>\r\n    </Grid>\r\n  );\r\n}\r\n'},2494:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return y}));var r=n(14),a=n(18),i=n(0),o=n.n(i),c=n(1166),l=n(1280),s=n(1129),u=n(1218),d=n(1483),m=n(1130),f=n(1173),h=n(1220),p=n(1176),b=n(1170),g=n(1217),v=n(1),O=Object(c.a)((function(e){return{root:{margin:"auto"},cardHeader:{padding:e.spacing(1,2)},list:{width:200,height:230,backgroundColor:e.palette.background.paper,overflow:"auto"},button:{margin:e.spacing(.5,0)}}}));function x(e,t){return e.filter((function(e){return-1===t.indexOf(e)}))}function j(e,t){return e.filter((function(e){return-1!==t.indexOf(e)}))}function y(){var e=O(),t=o.a.useState([]),n=Object(r.a)(t,2),i=n[0],c=n[1],y=o.a.useState([0,1,2,3]),C=Object(r.a)(y,2),k=C[0],w=C[1],L=o.a.useState([4,5,6,7]),I=Object(r.a)(L,2),N=I[0],S=I[1],T=j(i,k),D=j(i,N),_=function(e){return function(){var t=i.indexOf(e),n=Object(a.a)(i);-1===t?n.push(e):n.splice(t,1),c(n)}},P=function(e){return j(i,e).length},R=function(e){return function(){var t,n;P(e)===e.length?c(x(i,e)):c((t=i,n=e,[].concat(Object(a.a)(t),Object(a.a)(x(n,t)))))}},M=function(t,n){return Object(v.a)(u.a,null,Object(v.a)(d.a,{className:e.cardHeader,avatar:Object(v.a)(p.a,{onClick:R(n),checked:P(n)===n.length&&0!==n.length,indeterminate:P(n)!==n.length&&0!==P(n),disabled:0===n.length,inputProps:{"aria-label":"all items selected"}}),title:t,subheader:"".concat(P(n),"/").concat(n.length," selected")}),Object(v.a)(g.a,null),Object(v.a)(s.a,{className:e.list,dense:!0,component:"div",role:"list"},n.map((function(e){var t="transfer-list-all-item-".concat(e,"-label");return Object(v.a)(m.a,{key:e,role:"listitem",button:!0,onClick:_(e)},Object(v.a)(h.a,null,Object(v.a)(p.a,{checked:-1!==i.indexOf(e),tabIndex:-1,disableRipple:!0,inputProps:{"aria-labelledby":t}})),Object(v.a)(f.a,{id:t,primary:"List item ".concat(e+1)}))})),Object(v.a)(m.a,null)))};return Object(v.a)(l.a,{container:!0,spacing:2,justify:"center",alignItems:"center",className:e.root},Object(v.a)(l.a,{item:!0},M("Choices",k)),Object(v.a)(l.a,{item:!0},Object(v.a)(l.a,{container:!0,direction:"column",alignItems:"center"},Object(v.a)(b.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){S(N.concat(T)),w(x(k,T)),c(x(i,T))},disabled:0===T.length,"aria-label":"move selected right"},">"),Object(v.a)(b.a,{variant:"outlined",size:"small",className:e.button,onClick:function(){w(k.concat(D)),S(x(N,D)),c(x(i,D))},disabled:0===D.length,"aria-label":"move selected left"},"<"))),Object(v.a)(l.a,{item:!0},M("Chosen",N)))}},2495:function(e,t,n){"use strict";n.r(t),t.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Grid from '@material-ui/core/Grid';\r\nimport List from '@material-ui/core/List';\r\nimport Card from '@material-ui/core/Card';\r\nimport CardHeader from '@material-ui/core/CardHeader';\r\nimport ListItem from '@material-ui/core/ListItem';\r\nimport ListItemText from '@material-ui/core/ListItemText';\r\nimport ListItemIcon from '@material-ui/core/ListItemIcon';\r\nimport Checkbox from '@material-ui/core/Checkbox';\r\nimport Button from '@material-ui/core/Button';\r\nimport Divider from '@material-ui/core/Divider';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    margin: 'auto',\r\n  },\r\n  cardHeader: {\r\n    padding: theme.spacing(1, 2),\r\n  },\r\n  list: {\r\n    width: 200,\r\n    height: 230,\r\n    backgroundColor: theme.palette.background.paper,\r\n    overflow: 'auto',\r\n  },\r\n  button: {\r\n    margin: theme.spacing(0.5, 0),\r\n  },\r\n}));\r\n\r\nfunction not(a, b) {\r\n  return a.filter((value) => b.indexOf(value) === -1);\r\n}\r\n\r\nfunction intersection(a, b) {\r\n  return a.filter((value) => b.indexOf(value) !== -1);\r\n}\r\n\r\nfunction union(a, b) {\r\n  return [...a, ...not(b, a)];\r\n}\r\n\r\nexport default function TransferList() {\r\n  const classes = useStyles();\r\n  const [checked, setChecked] = React.useState([]);\r\n  const [left, setLeft] = React.useState([0, 1, 2, 3]);\r\n  const [right, setRight] = React.useState([4, 5, 6, 7]);\r\n\r\n  const leftChecked = intersection(checked, left);\r\n  const rightChecked = intersection(checked, right);\r\n\r\n  const handleToggle = (value) => () => {\r\n    const currentIndex = checked.indexOf(value);\r\n    const newChecked = [...checked];\r\n\r\n    if (currentIndex === -1) {\r\n      newChecked.push(value);\r\n    } else {\r\n      newChecked.splice(currentIndex, 1);\r\n    }\r\n\r\n    setChecked(newChecked);\r\n  };\r\n\r\n  const numberOfChecked = (items) => intersection(checked, items).length;\r\n\r\n  const handleToggleAll = (items) => () => {\r\n    if (numberOfChecked(items) === items.length) {\r\n      setChecked(not(checked, items));\r\n    } else {\r\n      setChecked(union(checked, items));\r\n    }\r\n  };\r\n\r\n  const handleCheckedRight = () => {\r\n    setRight(right.concat(leftChecked));\r\n    setLeft(not(left, leftChecked));\r\n    setChecked(not(checked, leftChecked));\r\n  };\r\n\r\n  const handleCheckedLeft = () => {\r\n    setLeft(left.concat(rightChecked));\r\n    setRight(not(right, rightChecked));\r\n    setChecked(not(checked, rightChecked));\r\n  };\r\n\r\n  const customList = (title, items) => (\r\n    <Card>\r\n      <CardHeader\r\n        className={classes.cardHeader}\r\n        avatar={\r\n          <Checkbox\r\n            onClick={handleToggleAll(items)}\r\n            checked={numberOfChecked(items) === items.length && items.length !== 0}\r\n            indeterminate={numberOfChecked(items) !== items.length && numberOfChecked(items) !== 0}\r\n            disabled={items.length === 0}\r\n            inputProps={{ 'aria-label': 'all items selected' }}\r\n          />\r\n        }\r\n        title={title}\r\n        subheader={`${numberOfChecked(items)}/${items.length} selected`}\r\n      />\r\n      <Divider />\r\n      <List className={classes.list} dense component=\"div\" role=\"list\">\r\n        {items.map((value) => {\r\n          const labelId = `transfer-list-all-item-${value}-label`;\r\n\r\n          return (\r\n            <ListItem key={value} role=\"listitem\" button onClick={handleToggle(value)}>\r\n              <ListItemIcon>\r\n                <Checkbox\r\n                  checked={checked.indexOf(value) !== -1}\r\n                  tabIndex={-1}\r\n                  disableRipple\r\n                  inputProps={{ 'aria-labelledby': labelId }}\r\n                />\r\n              </ListItemIcon>\r\n              <ListItemText id={labelId} primary={`List item ${value + 1}`} />\r\n            </ListItem>\r\n          );\r\n        })}\r\n        <ListItem />\r\n      </List>\r\n    </Card>\r\n  );\r\n\r\n  return (\r\n    <Grid container spacing={2} justify=\"center\" alignItems=\"center\" className={classes.root}>\r\n      <Grid item>{customList('Choices', left)}</Grid>\r\n      <Grid item>\r\n        <Grid container direction=\"column\" alignItems=\"center\">\r\n          <Button\r\n            variant=\"outlined\"\r\n            size=\"small\"\r\n            className={classes.button}\r\n            onClick={handleCheckedRight}\r\n            disabled={leftChecked.length === 0}\r\n            aria-label=\"move selected right\"\r\n          >\r\n            &gt;\r\n          </Button>\r\n          <Button\r\n            variant=\"outlined\"\r\n            size=\"small\"\r\n            className={classes.button}\r\n            onClick={handleCheckedLeft}\r\n            disabled={rightChecked.length === 0}\r\n            aria-label=\"move selected left\"\r\n          >\r\n            &lt;\r\n          </Button>\r\n        </Grid>\r\n      </Grid>\r\n      <Grid item>{customList('Chosen', right)}</Grid>\r\n    </Grid>\r\n  );\r\n}\r\n"},2907:function(e,t,n){"use strict";n.r(t);var r=n(0),a=n.n(r),i=n(1233),o=(n(140),n(1170)),c=n(547),l=n(169),s=n(1166),u=n(1),d=Object(s.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));t.default=function(e){return d(),Object(u.a)(a.a.Fragment,null,Object(u.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(u.a)(o.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/transfer-list",target:"_blank",role:"button"},Object(u.a)(c.a,null,"link"),Object(u.a)("span",{className:"mx-4"},"Reference"))),Object(u.a)(l.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Transfer List"),Object(u.a)(l.a,{className:"description"},'A transfer list (or "shuttle") enables the user to move one or more list items between lists.'),Object(u.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Simple Transfer List"),Object(u.a)(l.a,{className:"mb-16",component:"div"},' For completeness, this example includes buttons for "move all", but not every transfer list needs these.'),Object(u.a)(l.a,{className:"mb-16",component:"div"},Object(u.a)(i.a,{className:"my-24",iframe:!1,component:n(2492).default,raw:n(2493)})),Object(u.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Enhanced Transfer List"),Object(u.a)(l.a,{className:"mb-16",component:"div"},'This example exchanges the "move all" buttons for a "select all / select none" checkbox, and adds a counter.'),Object(u.a)(l.a,{className:"mb-16",component:"div"},Object(u.a)(i.a,{className:"my-24",iframe:!1,component:n(2494).default,raw:n(2495)})))}}}]);