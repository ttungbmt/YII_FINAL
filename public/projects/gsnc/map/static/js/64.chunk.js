(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[64],{1233:function(n,e,t){"use strict";t.d(e,"a",(function(){return A}));var a=t(14),r=t(140),o=t(1211),c=t(1218),s=t(547),i=t(1224),l=t(1225),u=t(0),m=t.n(u),b=t(18),p=t(8),d=t(86),f=t(87),h=t(150),k=t(149),O=t(1121),j=t(643),v=t(1158),g=t(1210),C=t(10),y=t(420),S=t(421),B=t(1234),w=t.n(B),N=t(1),T=Object(O.a)({productionPrefix:"iframe-"}),I=function(n){Object(h.a)(t,n);var e=Object(k.a)(t);function t(){var n;Object(d.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=e.call.apply(e,[this].concat(r))).state={ready:!1},n.handleRef=function(e){n.contentDocument=e?e.node.contentDocument:null},n.onContentDidMount=function(){n.setState({ready:!0,jss:Object(y.a)(Object(p.a)(Object(p.a)({},Object(j.a)()),{},{plugins:[].concat(Object(b.a)(Object(j.a)().plugins),[Object(S.a)()]),insertionPoint:n.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:n.contentDocument.body})},n.onContentDidUpdate=function(){n.contentDocument.body.dir=n.props.theme.direction},n.renderHead=function(){return Object(N.a)(m.a.Fragment,null,Object(N.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(N.a)("noscript",{id:"jss-demo-insertion-point"}))},n}return Object(f.a)(t,[{key:"render",value:function(){var n=this.props,e=n.children,t=n.classes,a=n.theme;return Object(N.a)(w.a,{head:this.renderHead(),ref:this.handleRef,className:t.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(N.a)(v.b,{jss:this.state.jss,generateClassName:T,sheetsManager:this.state.sheetsManager},Object(N.a)(g.a,{theme:a},m.a.cloneElement(e,{container:this.state.container}))):null)}}]),t}(m.a.Component),x=Object(C.a)((function(n){return{root:{backgroundColor:n.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:n.shadows[1]}}}),{withTheme:!0})(I);function R(n){var e=Object(u.useState)(n.currentTabIndex),t=Object(a.a)(e,2),m=t[0],b=t[1],p=n.component,d=n.raw,f=n.iframe,h=n.className;return Object(N.a)(c.a,{className:h},Object(N.a)(o.a,{position:"static",color:"default",elevation:0},Object(N.a)(l.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:m,onChange:function(n,e){b(e)}},p&&Object(N.a)(i.a,{classes:{root:"min-w-64"},icon:Object(N.a)(s.a,null,"remove_red_eye")}),d&&Object(N.a)(i.a,{classes:{root:"min-w-64"},icon:Object(N.a)(s.a,null,"code")}))),Object(N.a)("div",{className:"flex justify-center max-w-full"},Object(N.a)("div",{className:0===m?"flex flex-1 max-w-full":"hidden"},p&&(f?Object(N.a)(x,null,Object(N.a)(p,null)):Object(N.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(N.a)(p,null)))),Object(N.a)("div",{className:1===m?"flex flex-1":"hidden"},d&&Object(N.a)("div",{className:"flex flex-1"},Object(N.a)(r.a,{component:"pre",className:"language-javascript w-full"},d.default)))))}R.defaultProps={currentTabIndex:0};var A=R},2238:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return b}));var a=t(14),r=t(0),o=t.n(r),c=t(1170),s=t(1208),i=t(399),l=t(1307),u=t.n(l),m=t(1);function b(){var n=o.a.useState(!1),e=Object(a.a)(n,2),t=e[0],r=e[1],l=function(n,e){"clickaway"!==e&&r(!1)};return Object(m.a)("div",null,Object(m.a)(c.a,{onClick:function(){r(!0)}},"Open simple snackbar"),Object(m.a)(s.a,{anchorOrigin:{vertical:"bottom",horizontal:"left"},open:t,autoHideDuration:6e3,onClose:l,message:"Note archived",action:Object(m.a)(o.a.Fragment,null,Object(m.a)(c.a,{color:"secondary",size:"small",onClick:l},"UNDO"),Object(m.a)(i.a,{size:"small","aria-label":"close",color:"inherit",onClick:l},Object(m.a)(u.a,{fontSize:"small"})))}))}},2239:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\nimport IconButton from '@material-ui/core/IconButton';\r\nimport CloseIcon from '@material-ui/icons/Close';\r\n\r\nexport default function SimpleSnackbar() {\r\n  const [open, setOpen] = React.useState(false);\r\n\r\n  const handleClick = () => {\r\n    setOpen(true);\r\n  };\r\n\r\n  const handleClose = (event, reason) => {\r\n    if (reason === 'clickaway') {\r\n      return;\r\n    }\r\n\r\n    setOpen(false);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button onClick={handleClick}>Open simple snackbar</Button>\r\n      <Snackbar\r\n        anchorOrigin={{\r\n          vertical: 'bottom',\r\n          horizontal: 'left',\r\n        }}\r\n        open={open}\r\n        autoHideDuration={6000}\r\n        onClose={handleClose}\r\n        message=\"Note archived\"\r\n        action={\r\n          <React.Fragment>\r\n            <Button color=\"secondary\" size=\"small\" onClick={handleClose}>\r\n              UNDO\r\n            </Button>\r\n            <IconButton size=\"small\" aria-label=\"close\" color=\"inherit\" onClick={handleClose}>\r\n              <CloseIcon fontSize=\"small\" />\r\n            </IconButton>\r\n          </React.Fragment>\r\n        }\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2240:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return d}));var a=t(14),r=t(20),o=t(0),c=t.n(o),s=t(1170),i=t(1208),l=t(2804),u=t(1166),m=t(1);function b(n){return Object(m.a)(l.a,Object(r.a)({elevation:6,variant:"filled"},n))}var p=Object(u.a)((function(n){return{root:{width:"100%","& > * + *":{marginTop:n.spacing(2)}}}}));function d(){var n=p(),e=c.a.useState(!1),t=Object(a.a)(e,2),r=t[0],o=t[1],l=function(n,e){"clickaway"!==e&&o(!1)};return Object(m.a)("div",{className:n.root},Object(m.a)(s.a,{variant:"outlined",onClick:function(){o(!0)}},"Open success snackbar"),Object(m.a)(i.a,{open:r,autoHideDuration:6e3,onClose:l},Object(m.a)(b,{onClose:l,severity:"success"},"This is a success message!")),Object(m.a)(b,{severity:"error"},"This is an error message!"),Object(m.a)(b,{severity:"warning"},"This is a warning message!"),Object(m.a)(b,{severity:"info"},"This is an information message!"),Object(m.a)(b,{severity:"success"},"This is a success message!"))}},2241:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\nimport MuiAlert from '@material-ui/lab/Alert';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\n\r\nfunction Alert(props) {\r\n  return <MuiAlert elevation={6} variant=\"filled\" {...props} />;\r\n}\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function CustomizedSnackbars() {\r\n  const classes = useStyles();\r\n  const [open, setOpen] = React.useState(false);\r\n\r\n  const handleClick = () => {\r\n    setOpen(true);\r\n  };\r\n\r\n  const handleClose = (event, reason) => {\r\n    if (reason === 'clickaway') {\r\n      return;\r\n    }\r\n\r\n    setOpen(false);\r\n  };\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Button variant=\"outlined\" onClick={handleClick}>\r\n        Open success snackbar\r\n      </Button>\r\n      <Snackbar open={open} autoHideDuration={6000} onClose={handleClose}>\r\n        <Alert onClose={handleClose} severity=\"success\">\r\n          This is a success message!\r\n        </Alert>\r\n      </Snackbar>\r\n      <Alert severity=\"error\">This is an error message!</Alert>\r\n      <Alert severity=\"warning\">This is a warning message!</Alert>\r\n      <Alert severity=\"info\">This is an information message!</Alert>\r\n      <Alert severity=\"success\">This is a success message!</Alert>\r\n    </div>\r\n  );\r\n}\r\n"},2242:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return u}));var a=t(8),r=t(14),o=t(0),c=t.n(o),s=t(1170),i=t(1208),l=t(1);function u(){var n=c.a.useState({open:!1,vertical:"top",horizontal:"center"}),e=Object(r.a)(n,2),t=e[0],o=e[1],u=t.vertical,m=t.horizontal,b=t.open,p=function(n){return function(){o(Object(a.a)({open:!0},n))}},d=Object(l.a)(c.a.Fragment,null,Object(l.a)(s.a,{onClick:p({vertical:"top",horizontal:"center"})},"Top-Center"),Object(l.a)(s.a,{onClick:p({vertical:"top",horizontal:"right"})},"Top-Right"),Object(l.a)(s.a,{onClick:p({vertical:"bottom",horizontal:"right"})},"Bottom-Right"),Object(l.a)(s.a,{onClick:p({vertical:"bottom",horizontal:"center"})},"Bottom-Center"),Object(l.a)(s.a,{onClick:p({vertical:"bottom",horizontal:"left"})},"Bottom-Left"),Object(l.a)(s.a,{onClick:p({vertical:"top",horizontal:"left"})},"Top-Left"));return Object(l.a)("div",null,d,Object(l.a)(i.a,{anchorOrigin:{vertical:u,horizontal:m},open:b,onClose:function(){o(Object(a.a)(Object(a.a)({},t),{},{open:!1}))},message:"I love snacks",key:u+m}))}},2243:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\n\r\nexport default function PositionedSnackbar() {\r\n  const [state, setState] = React.useState({\r\n    open: false,\r\n    vertical: 'top',\r\n    horizontal: 'center',\r\n  });\r\n\r\n  const { vertical, horizontal, open } = state;\r\n\r\n  const handleClick = (newState) => () => {\r\n    setState({ open: true, ...newState });\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setState({ ...state, open: false });\r\n  };\r\n\r\n  const buttons = (\r\n    <React.Fragment>\r\n      <Button onClick={handleClick({ vertical: 'top', horizontal: 'center' })}>Top-Center</Button>\r\n      <Button onClick={handleClick({ vertical: 'top', horizontal: 'right' })}>Top-Right</Button>\r\n      <Button onClick={handleClick({ vertical: 'bottom', horizontal: 'right' })}>\r\n        Bottom-Right\r\n      </Button>\r\n      <Button onClick={handleClick({ vertical: 'bottom', horizontal: 'center' })}>\r\n        Bottom-Center\r\n      </Button>\r\n      <Button onClick={handleClick({ vertical: 'bottom', horizontal: 'left' })}>Bottom-Left</Button>\r\n      <Button onClick={handleClick({ vertical: 'top', horizontal: 'left' })}>Top-Left</Button>\r\n    </React.Fragment>\r\n  );\r\n\r\n  return (\r\n    <div>\r\n      {buttons}\r\n      <Snackbar\r\n        anchorOrigin={{ vertical, horizontal }}\r\n        open={open}\r\n        onClose={handleClose}\r\n        message=\"I love snacks\"\r\n        key={vertical + horizontal}\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2244:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return l}));t(0);var a=t(1170),r=t(1166),o=t(1124),c=t(1),s=Object(c.a)(a.a,{color:"secondary",size:"small"},"lorem ipsum dolorem"),i=Object(r.a)((function(n){return{root:{maxWidth:600,"& > * + *":{marginTop:n.spacing(2)}}}}));function l(){var n=i();return Object(c.a)("div",{className:n.root},Object(c.a)(o.a,{message:"I love snacks.",action:s}),Object(c.a)(o.a,{message:"I love candy. I love cookies. I love cupcakes.           I love cheesecake. I love chocolate."}),Object(c.a)(o.a,{message:"I love candy. I love cookies. I love cupcakes.",action:s}),Object(c.a)(o.a,{message:"I love candy. I love cookies. I love cupcakes.           I love cheesecake. I love chocolate.",action:s}))}},2245:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport SnackbarContent from '@material-ui/core/SnackbarContent';\r\n\r\nconst action = (\r\n  <Button color=\"secondary\" size=\"small\">\r\n    lorem ipsum dolorem\r\n  </Button>\r\n);\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    maxWidth: 600,\r\n    '& > * + *': {\r\n      marginTop: theme.spacing(2),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function LongTextSnackbar() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <SnackbarContent message=\"I love snacks.\" action={action} />\r\n      <SnackbarContent\r\n        message={\r\n          'I love candy. I love cookies. I love cupcakes. \\\r\n          I love cheesecake. I love chocolate.'\r\n        }\r\n      />\r\n      <SnackbarContent message=\"I love candy. I love cookies. I love cupcakes.\" action={action} />\r\n      <SnackbarContent\r\n        message={\r\n          'I love candy. I love cookies. I love cupcakes. \\\r\n          I love cheesecake. I love chocolate.'\r\n        }\r\n        action={action}\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2246:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return h}));var a=t(18),r=t(8),o=t(14),c=t(0),s=t.n(c),i=t(1166),l=t(1170),u=t(1208),m=t(399),b=t(1307),p=t.n(b),d=t(1),f=Object(i.a)((function(n){return{close:{padding:n.spacing(.5)}}}));function h(){var n=s.a.useState([]),e=Object(o.a)(n,2),t=e[0],c=e[1],i=s.a.useState(!1),b=Object(o.a)(i,2),h=b[0],k=b[1],O=s.a.useState(void 0),j=Object(o.a)(O,2),v=j[0],g=j[1];s.a.useEffect((function(){t.length&&!v?(g(Object(r.a)({},t[0])),c((function(n){return n.slice(1)})),k(!0)):t.length&&v&&h&&k(!1)}),[t,v,h]);var C=function(n){return function(){c((function(e){return[].concat(Object(a.a)(e),[{message:n,key:(new Date).getTime()}])}))}},y=function(n,e){"clickaway"!==e&&k(!1)},S=f();return Object(d.a)("div",null,Object(d.a)(l.a,{onClick:C("Message A")},"Show message A"),Object(d.a)(l.a,{onClick:C("Message B")},"Show message B"),Object(d.a)(u.a,{key:v?v.key:void 0,anchorOrigin:{vertical:"bottom",horizontal:"left"},open:h,autoHideDuration:6e3,onClose:y,onExited:function(){g(void 0)},message:v?v.message:void 0,action:Object(d.a)(s.a.Fragment,null,Object(d.a)(l.a,{color:"secondary",size:"small",onClick:y},"UNDO"),Object(d.a)(m.a,{"aria-label":"close",color:"inherit",className:S.close,onClick:y},Object(d.a)(p.a,null)))}))}},2247:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\nimport IconButton from '@material-ui/core/IconButton';\r\nimport CloseIcon from '@material-ui/icons/Close';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  close: {\r\n    padding: theme.spacing(0.5),\r\n  },\r\n}));\r\n\r\nexport default function ConsecutiveSnackbars() {\r\n  const [snackPack, setSnackPack] = React.useState([]);\r\n  const [open, setOpen] = React.useState(false);\r\n  const [messageInfo, setMessageInfo] = React.useState(undefined);\r\n\r\n  React.useEffect(() => {\r\n    if (snackPack.length && !messageInfo) {\r\n      // Set a new snack when we don't have an active one\r\n      setMessageInfo({ ...snackPack[0] });\r\n      setSnackPack((prev) => prev.slice(1));\r\n      setOpen(true);\r\n    } else if (snackPack.length && messageInfo && open) {\r\n      // Close an active snack when a new one is added\r\n      setOpen(false);\r\n    }\r\n  }, [snackPack, messageInfo, open]);\r\n\r\n  const handleClick = (message) => () => {\r\n    setSnackPack((prev) => [...prev, { message, key: new Date().getTime() }]);\r\n  };\r\n\r\n  const handleClose = (event, reason) => {\r\n    if (reason === 'clickaway') {\r\n      return;\r\n    }\r\n    setOpen(false);\r\n  };\r\n\r\n  const handleExited = () => {\r\n    setMessageInfo(undefined);\r\n  };\r\n\r\n  const classes = useStyles();\r\n  return (\r\n    <div>\r\n      <Button onClick={handleClick('Message A')}>Show message A</Button>\r\n      <Button onClick={handleClick('Message B')}>Show message B</Button>\r\n      <Snackbar\r\n        key={messageInfo ? messageInfo.key : undefined}\r\n        anchorOrigin={{\r\n          vertical: 'bottom',\r\n          horizontal: 'left',\r\n        }}\r\n        open={open}\r\n        autoHideDuration={6000}\r\n        onClose={handleClose}\r\n        onExited={handleExited}\r\n        message={messageInfo ? messageInfo.message : undefined}\r\n        action={\r\n          <React.Fragment>\r\n            <Button color=\"secondary\" size=\"small\" onClick={handleClose}>\r\n              UNDO\r\n            </Button>\r\n            <IconButton\r\n              aria-label=\"close\"\r\n              color=\"inherit\"\r\n              className={classes.close}\r\n              onClick={handleClose}\r\n            >\r\n              <CloseIcon />\r\n            </IconButton>\r\n          </React.Fragment>\r\n        }\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2248:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return g}));var a=t(22),r=t(0),o=t.n(r),c=t(1166),s=t(1211),i=t(1425),l=t(1172),u=t(399),m=t(1271),b=t.n(m),p=t(169),d=t(1170),f=t(1212),h=t(1282),k=t.n(h),O=t(1208),j=t(1),v=Object(c.a)((function(n){return{"@global":{body:{backgroundColor:n.palette.background.paper}},menuButton:{marginRight:n.spacing(2)},fab:{position:"absolute",bottom:n.spacing(2),right:n.spacing(2)},snackbar:Object(a.a)({},n.breakpoints.down("xs"),{bottom:90})}}));function g(){var n=v();return Object(j.a)(o.a.Fragment,null,Object(j.a)(i.a,null),Object(j.a)("div",null,Object(j.a)(s.a,{position:"static",color:"primary"},Object(j.a)(l.a,null,Object(j.a)(u.a,{edge:"start",className:n.menuButton,color:"inherit","aria-label":"menu"},Object(j.a)(b.a,null)),Object(j.a)(p.a,{variant:"h6",color:"inherit"},"App Bar"))),Object(j.a)(f.a,{color:"secondary",className:n.fab},Object(j.a)(k.a,null)),Object(j.a)(O.a,{open:!0,autoHideDuration:6e3,message:"Archived",action:Object(j.a)(d.a,{color:"inherit",size:"small"},"Undo"),className:n.snackbar})))}},2249:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport AppBar from '@material-ui/core/AppBar';\r\nimport CssBaseline from '@material-ui/core/CssBaseline';\r\nimport Toolbar from '@material-ui/core/Toolbar';\r\nimport IconButton from '@material-ui/core/IconButton';\r\nimport MenuIcon from '@material-ui/icons/Menu';\r\nimport Typography from '@material-ui/core/Typography';\r\nimport Button from '@material-ui/core/Button';\r\nimport Fab from '@material-ui/core/Fab';\r\nimport AddIcon from '@material-ui/icons/Add';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  '@global': {\r\n    body: {\r\n      backgroundColor: theme.palette.background.paper,\r\n    },\r\n  },\r\n  menuButton: {\r\n    marginRight: theme.spacing(2),\r\n  },\r\n  fab: {\r\n    position: 'absolute',\r\n    bottom: theme.spacing(2),\r\n    right: theme.spacing(2),\r\n  },\r\n  snackbar: {\r\n    [theme.breakpoints.down('xs')]: {\r\n      bottom: 90,\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function FabIntegrationSnackbar() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <React.Fragment>\r\n      <CssBaseline />\r\n      <div>\r\n        <AppBar position=\"static\" color=\"primary\">\r\n          <Toolbar>\r\n            <IconButton\r\n              edge=\"start\"\r\n              className={classes.menuButton}\r\n              color=\"inherit\"\r\n              aria-label=\"menu\"\r\n            >\r\n              <MenuIcon />\r\n            </IconButton>\r\n            <Typography variant=\"h6\" color=\"inherit\">\r\n              App Bar\r\n            </Typography>\r\n          </Toolbar>\r\n        </AppBar>\r\n        <Fab color=\"secondary\" className={classes.fab}>\r\n          <AddIcon />\r\n        </Fab>\r\n        <Snackbar\r\n          open\r\n          autoHideDuration={6000}\r\n          message=\"Archived\"\r\n          action={\r\n            <Button color=\"inherit\" size=\"small\">\r\n              Undo\r\n            </Button>\r\n          }\r\n          className={classes.snackbar}\r\n        />\r\n      </div>\r\n    </React.Fragment>\r\n  );\r\n}\r\n"},2250:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return h}));var a=t(8),r=t(14),o=t(20),c=t(0),s=t.n(c),i=t(1170),l=t(1208),u=t(644),m=t(1132),b=t(414),p=t(1);function d(n){return Object(p.a)(m.a,Object(o.a)({},n,{direction:"up"}))}function f(n){return Object(p.a)(b.a,n)}function h(){var n=s.a.useState({open:!1,Transition:u.a}),e=Object(r.a)(n,2),t=e[0],o=e[1],c=function(n){return function(){o({open:!0,Transition:n})}};return Object(p.a)("div",null,Object(p.a)(i.a,{onClick:c(f)},"Grow Transition"),Object(p.a)(i.a,{onClick:c(u.a)},"Fade Transition"),Object(p.a)(i.a,{onClick:c(d)},"Slide Transition"),Object(p.a)(l.a,{open:t.open,onClose:function(){o(Object(a.a)(Object(a.a)({},t),{},{open:!1}))},TransitionComponent:t.Transition,message:"I love snacks",key:t.Transition.name}))}},2251:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\nimport Fade from '@material-ui/core/Fade';\r\nimport Slide from '@material-ui/core/Slide';\r\nimport Grow from '@material-ui/core/Grow';\r\n\r\nfunction SlideTransition(props) {\r\n  return <Slide {...props} direction=\"up\" />;\r\n}\r\n\r\nfunction GrowTransition(props) {\r\n  return <Grow {...props} />;\r\n}\r\n\r\nexport default function TransitionsSnackbar() {\r\n  const [state, setState] = React.useState({\r\n    open: false,\r\n    Transition: Fade,\r\n  });\r\n\r\n  const handleClick = (Transition) => () => {\r\n    setState({\r\n      open: true,\r\n      Transition,\r\n    });\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setState({\r\n      ...state,\r\n      open: false,\r\n    });\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button onClick={handleClick(GrowTransition)}>Grow Transition</Button>\r\n      <Button onClick={handleClick(Fade)}>Fade Transition</Button>\r\n      <Button onClick={handleClick(SlideTransition)}>Slide Transition</Button>\r\n      <Snackbar\r\n        open={state.open}\r\n        onClose={handleClose}\r\n        TransitionComponent={state.Transition}\r\n        message=\"I love snacks\"\r\n        key={state.Transition.name}\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2252:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return f}));var a=t(14),r=t(20),o=t(0),c=t.n(o),s=t(1170),i=t(1208),l=t(1132),u=t(1);function m(n){return Object(u.a)(l.a,Object(r.a)({},n,{direction:"left"}))}function b(n){return Object(u.a)(l.a,Object(r.a)({},n,{direction:"up"}))}function p(n){return Object(u.a)(l.a,Object(r.a)({},n,{direction:"right"}))}function d(n){return Object(u.a)(l.a,Object(r.a)({},n,{direction:"down"}))}function f(){var n=c.a.useState(!1),e=Object(a.a)(n,2),t=e[0],r=e[1],o=c.a.useState(void 0),l=Object(a.a)(o,2),f=l[0],h=l[1],k=function(n){return function(){h((function(){return n})),r(!0)}};return Object(u.a)("div",null,Object(u.a)(s.a,{onClick:k(m)},"Right"),Object(u.a)(s.a,{onClick:k(b)},"Up"),Object(u.a)(s.a,{onClick:k(p)},"Left"),Object(u.a)(s.a,{onClick:k(d)},"Down"),Object(u.a)(i.a,{open:t,onClose:function(){r(!1)},TransitionComponent:f,message:"I love snacks",key:f?f.name:""}))}},2253:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Snackbar from '@material-ui/core/Snackbar';\r\nimport Slide from '@material-ui/core/Slide';\r\n\r\nfunction TransitionLeft(props) {\r\n  return <Slide {...props} direction=\"left\" />;\r\n}\r\n\r\nfunction TransitionUp(props) {\r\n  return <Slide {...props} direction=\"up\" />;\r\n}\r\n\r\nfunction TransitionRight(props) {\r\n  return <Slide {...props} direction=\"right\" />;\r\n}\r\n\r\nfunction TransitionDown(props) {\r\n  return <Slide {...props} direction=\"down\" />;\r\n}\r\n\r\nexport default function DirectionSnackbar() {\r\n  const [open, setOpen] = React.useState(false);\r\n  const [transition, setTransition] = React.useState(undefined);\r\n\r\n  const handleClick = (Transition) => () => {\r\n    setTransition(() => Transition);\r\n    setOpen(true);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setOpen(false);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button onClick={handleClick(TransitionLeft)}>Right</Button>\r\n      <Button onClick={handleClick(TransitionUp)}>Up</Button>\r\n      <Button onClick={handleClick(TransitionRight)}>Left</Button>\r\n      <Button onClick={handleClick(TransitionDown)}>Down</Button>\r\n      <Snackbar\r\n        open={open}\r\n        onClose={handleClose}\r\n        TransitionComponent={transition}\r\n        message=\"I love snacks\"\r\n        key={transition ? transition.name : ''}\r\n      />\r\n    </div>\r\n  );\r\n}\r\n"},2254:function(n,e,t){"use strict";t.r(e),t.d(e,"default",(function(){return l}));var a=t(0),r=t.n(a),o=t(1170),c=t(2255),s=t(1);function i(){var n,e=Object(c.b)().enqueueSnackbar;return Object(s.a)(r.a.Fragment,null,Object(s.a)(o.a,{onClick:function(){e("I love snacks.")}},"Show snackbar"),Object(s.a)(o.a,{onClick:(n="success",function(){e("This is a success message!",{variant:n})})},"Show success snackbar"))}function l(){return Object(s.a)(c.a,{maxSnack:3},Object(s.a)(i,null))}},2256:function(n,e,t){"use strict";t.r(e),e.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport { SnackbarProvider, useSnackbar } from 'notistack';\r\n\r\nfunction MyApp() {\r\n  const { enqueueSnackbar } = useSnackbar();\r\n\r\n  const handleClick = () => {\r\n    enqueueSnackbar('I love snacks.');\r\n  };\r\n\r\n  const handleClickVariant = (variant) => () => {\r\n    // variant could be success, error, warning, info, or default\r\n    enqueueSnackbar('This is a success message!', { variant });\r\n  };\r\n\r\n  return (\r\n    <React.Fragment>\r\n      <Button onClick={handleClick}>Show snackbar</Button>\r\n      <Button onClick={handleClickVariant('success')}>Show success snackbar</Button>\r\n    </React.Fragment>\r\n  );\r\n}\r\n\r\nexport default function IntegrationNotistack() {\r\n  return (\r\n    <SnackbarProvider maxSnack={3}>\r\n      <MyApp />\r\n    </SnackbarProvider>\r\n  );\r\n}\r\n"},2890:function(n,e,t){"use strict";t.r(e);var a=t(0),r=t.n(a),o=t(1233),c=(t(140),t(1170)),s=t(547),i=t(169),l=t(1166),u=t(1),m=Object(l.a)((function(n){return{layoutRoot:{"& .description":{marginBottom:16}}}}));e.default=function(n){return m(),Object(u.a)(r.a.Fragment,null,Object(u.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(u.a)(c.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/snackbars",target:"_blank",role:"button"},Object(u.a)(s.a,null,"link"),Object(u.a)("span",{className:"mx-4"},"Reference"))),Object(u.a)(i.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Snackbar"),Object(u.a)(i.a,{className:"description"},"Snackbars provide brief messages about app processes. The component is also known as a toast."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)("a",{href:"https://material.io/design/components/snackbars.html"},"Snackbars")," inform users of a process that an app has performed or will perform. They appear temporarily, towards the bottom of the screen. They shouldn\u2019t interrupt the user experience, and they don\u2019t require user input to disappear."),Object(u.a)(i.a,{className:"mb-16",component:"div"},"Snackbars contain a single line of text directly related to the operation performed. They may contain a text action, but no icons. You can use them to display notifications."),Object(u.a)(i.a,{className:"text-16 mt-32 mb-8",component:"h4"},"Frequency"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"Only one snackbar may be displayed at a time."),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Simple snackbars"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"A basic snackbar that aims to reproduce Google Keep's snackbar behavior."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2238).default,raw:t(2239)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Customized snackbars"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"Here are some examples of customizing the component. You can learn more about this in the",Object(u.a)("a",{href:"/customization/components/"},"overrides documentation page"),"."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2240).default,raw:t(2241)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Positioned snackbars"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"In wide layouts, snackbars can be left-aligned or center-aligned if they are consistently placed on the same spot at the bottom of the screen, however there may be circumstances where the placement of the snackbar needs to be more flexible. You can control the position of the snackbar by specifying the ",Object(u.a)("code",null,"anchorOrigin")," prop."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2242).default,raw:t(2243)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Message Length"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"Some snackbars with varying message length."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2244).default,raw:t(2245)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Transitions"),Object(u.a)(i.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Consecutive Snackbars"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"When multiple snackbar updates are necessary, they should appear one at a time."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2246).default,raw:t(2247)})),Object(u.a)(i.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Snackbars and floating action buttons (FABs)"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"Snackbars should appear above FABs (on mobile)."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!0,component:t(2248).default,raw:t(2249)})),Object(u.a)(i.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Change Transition"),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)("a",{href:"/components/transitions/#grow"},"Grow")," is the default transition but you can use a different one."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2250).default,raw:t(2251)})),Object(u.a)(i.a,{className:"text-24 mt-32 mb-8",component:"h3"},"Control Slide direction"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"You can change the direction of the ",Object(u.a)("a",{href:"/components/transitions/#slide"},"Slide")," transition."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2252).default,raw:t(2253)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Complementary projects"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"For more advanced use cases you might be able to take advantage of:"),Object(u.a)(i.a,{className:"text-24 mt-32 mb-8",component:"h3"},"notistack"),Object(u.a)(i.a,{className:"mb-16",component:"div"},' src="https://img.shields.io/github/stars/iamhosseindhv/notistack.svg?style=social&label=Stars" alt="stars/> src="https://img.shields.io/npm/dm/notistack.svg" alt="npm downloads/>'),Object(u.a)(i.a,{className:"mb-16",component:"div"},"This example demonstrates how to use ",Object(u.a)("a",{href:"https://github.com/iamhosseindhv/notistack"},"notistack"),". notistack has an ",Object(u.a)("strong",null,"imperative API")," that makes it easy to display snackbars, without having to handle their open/close state. It also enables you to ",Object(u.a)("strong",null,"stack")," them on top of one another (although this is discouraged by the Material Design specification)."),Object(u.a)(i.a,{className:"mb-16",component:"div"},Object(u.a)(o.a,{className:"my-24",iframe:!1,component:t(2254).default,raw:t(2256)})),Object(u.a)(i.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Accessibility"),Object(u.a)(i.a,{className:"mb-16",component:"div"},"(WAI-ARIA: ",Object(u.a)("a",{href:"https://www.w3.org/TR/wai-aria-1.1/#alert"},"https://www.w3.org/TR/wai-aria-1.1/#alert"),")"),Object(u.a)("ul",null,Object(u.a)("li",null,"By default, the snackbar won't auto-hide. However, if you decide to use the ",Object(u.a)("code",null,"autoHideDuration")," prop, it's recommended to give the user ",Object(u.a)("a",{href:"https://www.w3.org/TR/UNDERSTANDING-WCAG20/time-limits.html"},"sufficient time")," to respond.")))}}}]);