(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[47],{1138:function(e,n,t){"use strict";t.r(n);var r=t(419);t.d(n,"default",(function(){return r.a}))},1231:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=function(e,n){var t=o.default.memo(o.default.forwardRef((function(n,t){return o.default.createElement(i.default,(0,a.default)({ref:t},n),e)})));0;return t.muiName=i.default.muiName,t};var a=r(t(141)),o=r(t(0)),i=r(t(1138))},1233:function(e,n,t){"use strict";t.d(n,"a",(function(){return P}));var r=t(14),a=t(140),o=t(1211),i=t(1218),c=t(547),l=t(1224),u=t(1225),s=t(0),m=t.n(s),p=t(18),d=t(8),f=t(86),b=t(87),h=t(150),O=t(149),v=t(1121),j=t(643),M=t(1158),y=t(1210),I=t(10),g=t(420),C=t(421),k=t(1234),x=t.n(k),S=t(1),w=Object(v.a)({productionPrefix:"iframe-"}),L=function(e){Object(h.a)(t,e);var n=Object(O.a)(t);function t(){var e;Object(f.a)(this,t);for(var r=arguments.length,a=new Array(r),o=0;o<r;o++)a[o]=arguments[o];return(e=n.call.apply(n,[this].concat(a))).state={ready:!1},e.handleRef=function(n){e.contentDocument=n?n.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(g.a)(Object(d.a)(Object(d.a)({},Object(j.a)()),{},{plugins:[].concat(Object(p.a)(Object(j.a)().plugins),[Object(C.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(S.a)(m.a.Fragment,null,Object(S.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(S.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(b.a)(t,[{key:"render",value:function(){var e=this.props,n=e.children,t=e.classes,r=e.theme;return Object(S.a)(x.a,{head:this.renderHead(),ref:this.handleRef,className:t.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(S.a)(M.b,{jss:this.state.jss,generateClassName:w,sheetsManager:this.state.sheetsManager},Object(S.a)(y.a,{theme:r},m.a.cloneElement(n,{container:this.state.container}))):null)}}]),t}(m.a.Component),N=Object(I.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(L);function T(e){var n=Object(s.useState)(e.currentTabIndex),t=Object(r.a)(n,2),m=t[0],p=t[1],d=e.component,f=e.raw,b=e.iframe,h=e.className;return Object(S.a)(i.a,{className:h},Object(S.a)(o.a,{position:"static",color:"default",elevation:0},Object(S.a)(u.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:m,onChange:function(e,n){p(n)}},d&&Object(S.a)(l.a,{classes:{root:"min-w-64"},icon:Object(S.a)(c.a,null,"remove_red_eye")}),f&&Object(S.a)(l.a,{classes:{root:"min-w-64"},icon:Object(S.a)(c.a,null,"code")}))),Object(S.a)("div",{className:"flex justify-center max-w-full"},Object(S.a)("div",{className:0===m?"flex flex-1 max-w-full":"hidden"},d&&(b?Object(S.a)(N,null,Object(S.a)(d,null)):Object(S.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(S.a)(d,null)))),Object(S.a)("div",{className:1===m?"flex flex-1":"hidden"},f&&Object(S.a)("div",{className:"flex flex-1"},Object(S.a)(a.a,{component:"pre",className:"language-javascript w-full"},f.default)))))}T.defaultProps={currentTabIndex:0};var P=T},1284:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=r(t(0)),o=(0,r(t(1231)).default)(a.default.createElement("path",{d:"M19 3H4.99c-1.11 0-1.98.9-1.98 2L3 19c0 1.1.88 2 1.99 2H19c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 12h-4c0 1.66-1.35 3-3 3s-3-1.34-3-3H4.99V5H19v10zm-3-5h-2V7h-4v3H8l4 4 4-4z"}),"MoveToInbox");n.default=o},1348:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=r(t(0)),o=(0,r(t(1231)).default)(a.default.createElement("path",{d:"M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"}),"MoreVert");n.default=o},1368:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=r(t(0)),o=(0,r(t(1231)).default)(a.default.createElement("path",{d:"M21.99 8c0-.72-.37-1.35-.94-1.7L12 1 2.95 6.3C2.38 6.65 2 7.28 2 8v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2l-.01-10zM12 13L3.74 7.84 12 3l8.26 4.84L12 13z"}),"Drafts");n.default=o},1432:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=r(t(0)),o=(0,r(t(1231)).default)(a.default.createElement("path",{d:"M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"}),"Send");n.default=o},2077:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return s}));var r=t(14),a=t(0),o=t.n(a),i=t(1170),c=t(445),l=t(1167),u=t(1);function s(){var e=o.a.useState(null),n=Object(r.a)(e,2),t=n[0],a=n[1],s=function(){a(null)};return Object(u.a)("div",null,Object(u.a)(i.a,{"aria-controls":"simple-menu","aria-haspopup":"true",onClick:function(e){a(e.currentTarget)}},"Open Menu"),Object(u.a)(c.a,{id:"simple-menu",anchorEl:t,keepMounted:!0,open:Boolean(t),onClose:s},Object(u.a)(l.a,{onClick:s},"Profile"),Object(u.a)(l.a,{onClick:s},"My account"),Object(u.a)(l.a,{onClick:s},"Logout")))}},2078:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\n\r\nexport default function SimpleMenu() {\r\n  const [anchorEl, setAnchorEl] = React.useState(null);\r\n\r\n  const handleClick = (event) => {\r\n    setAnchorEl(event.currentTarget);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button aria-controls=\"simple-menu\" aria-haspopup=\"true\" onClick={handleClick}>\r\n        Open Menu\r\n      </Button>\r\n      <Menu\r\n        id=\"simple-menu\"\r\n        anchorEl={anchorEl}\r\n        keepMounted\r\n        open={Boolean(anchorEl)}\r\n        onClose={handleClose}\r\n      >\r\n        <MenuItem onClick={handleClose}>Profile</MenuItem>\r\n        <MenuItem onClick={handleClose}>My account</MenuItem>\r\n        <MenuItem onClick={handleClose}>Logout</MenuItem>\r\n      </Menu>\r\n    </div>\r\n  );\r\n}\r\n"},2079:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return b}));var r=t(14),a=t(0),o=t.n(a),i=t(1166),c=t(1129),l=t(1130),u=t(1173),s=t(1167),m=t(445),p=t(1),d=Object(i.a)((function(e){return{root:{backgroundColor:e.palette.background.paper}}})),f=["Show some love to Material-UI","Show all notification content","Hide sensitive notification content","Hide all notification content"];function b(){var e=d(),n=o.a.useState(null),t=Object(r.a)(n,2),a=t[0],i=t[1],b=o.a.useState(1),h=Object(r.a)(b,2),O=h[0],v=h[1];return Object(p.a)("div",{className:e.root},Object(p.a)(c.a,{component:"nav","aria-label":"Device settings"},Object(p.a)(l.a,{button:!0,"aria-haspopup":"true","aria-controls":"lock-menu","aria-label":"when device is locked",onClick:function(e){i(e.currentTarget)}},Object(p.a)(u.a,{primary:"When device is locked",secondary:f[O]}))),Object(p.a)(m.a,{id:"lock-menu",anchorEl:a,keepMounted:!0,open:Boolean(a),onClose:function(){i(null)}},f.map((function(e,n){return Object(p.a)(s.a,{key:e,disabled:0===n,selected:n===O,onClick:function(e){return function(e,n){v(n),i(null)}(0,n)}},e)}))))}},2080:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport List from '@material-ui/core/List';\r\nimport ListItem from '@material-ui/core/ListItem';\r\nimport ListItemText from '@material-ui/core/ListItemText';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport Menu from '@material-ui/core/Menu';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    backgroundColor: theme.palette.background.paper,\r\n  },\r\n}));\r\n\r\nconst options = [\r\n  'Show some love to Material-UI',\r\n  'Show all notification content',\r\n  'Hide sensitive notification content',\r\n  'Hide all notification content',\r\n];\r\n\r\nexport default function SimpleListMenu() {\r\n  const classes = useStyles();\r\n  const [anchorEl, setAnchorEl] = React.useState(null);\r\n  const [selectedIndex, setSelectedIndex] = React.useState(1);\r\n\r\n  const handleClickListItem = (event) => {\r\n    setAnchorEl(event.currentTarget);\r\n  };\r\n\r\n  const handleMenuItemClick = (event, index) => {\r\n    setSelectedIndex(index);\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <List component=\"nav\" aria-label=\"Device settings\">\r\n        <ListItem\r\n          button\r\n          aria-haspopup=\"true\"\r\n          aria-controls=\"lock-menu\"\r\n          aria-label=\"when device is locked\"\r\n          onClick={handleClickListItem}\r\n        >\r\n          <ListItemText primary=\"When device is locked\" secondary={options[selectedIndex]} />\r\n        </ListItem>\r\n      </List>\r\n      <Menu\r\n        id=\"lock-menu\"\r\n        anchorEl={anchorEl}\r\n        keepMounted\r\n        open={Boolean(anchorEl)}\r\n        onClose={handleClose}\r\n      >\r\n        {options.map((option, index) => (\r\n          <MenuItem\r\n            key={option}\r\n            disabled={index === 0}\r\n            selected={index === selectedIndex}\r\n            onClick={(event) => handleMenuItemClick(event, index)}\r\n          >\r\n            {option}\r\n          </MenuItem>\r\n        ))}\r\n      </Menu>\r\n    </div>\r\n  );\r\n}\r\n"},2081:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return O}));var r=t(20),a=t(14),o=t(0),i=t.n(o),c=t(1170),l=t(1123),u=t(414),s=t(221),m=t(1133),p=t(1167),d=t(1128),f=t(1166),b=t(1),h=Object(f.a)((function(e){return{root:{display:"flex"},paper:{marginRight:e.spacing(2)}}}));function O(){var e=h(),n=i.a.useState(!1),t=Object(a.a)(n,2),o=t[0],f=t[1],O=i.a.useRef(null),v=function(e){O.current&&O.current.contains(e.target)||f(!1)};function j(e){"Tab"===e.key&&(e.preventDefault(),f(!1))}var M=i.a.useRef(o);return i.a.useEffect((function(){!0===M.current&&!1===o&&O.current.focus(),M.current=o}),[o]),Object(b.a)("div",{className:e.root},Object(b.a)(s.a,{className:e.paper},Object(b.a)(d.a,null,Object(b.a)(p.a,null,"Profile"),Object(b.a)(p.a,null,"My account"),Object(b.a)(p.a,null,"Logout"))),Object(b.a)("div",null,Object(b.a)(c.a,{ref:O,"aria-controls":o?"menu-list-grow":void 0,"aria-haspopup":"true",onClick:function(){f((function(e){return!e}))}},"Toggle Menu Grow"),Object(b.a)(m.a,{open:o,anchorEl:O.current,role:void 0,transition:!0,disablePortal:!0},(function(e){var n=e.TransitionProps,t=e.placement;return Object(b.a)(u.a,Object(r.a)({},n,{style:{transformOrigin:"bottom"===t?"center top":"center bottom"}}),Object(b.a)(s.a,null,Object(b.a)(l.a,{onClickAway:v},Object(b.a)(d.a,{autoFocusItem:o,id:"menu-list-grow",onKeyDown:j},Object(b.a)(p.a,{onClick:v},"Profile"),Object(b.a)(p.a,{onClick:v},"My account"),Object(b.a)(p.a,{onClick:v},"Logout")))))}))))}},2082:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport ClickAwayListener from '@material-ui/core/ClickAwayListener';\r\nimport Grow from '@material-ui/core/Grow';\r\nimport Paper from '@material-ui/core/Paper';\r\nimport Popper from '@material-ui/core/Popper';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport MenuList from '@material-ui/core/MenuList';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    display: 'flex',\r\n  },\r\n  paper: {\r\n    marginRight: theme.spacing(2),\r\n  },\r\n}));\r\n\r\nexport default function MenuListComposition() {\r\n  const classes = useStyles();\r\n  const [open, setOpen] = React.useState(false);\r\n  const anchorRef = React.useRef(null);\r\n\r\n  const handleToggle = () => {\r\n    setOpen((prevOpen) => !prevOpen);\r\n  };\r\n\r\n  const handleClose = (event) => {\r\n    if (anchorRef.current && anchorRef.current.contains(event.target)) {\r\n      return;\r\n    }\r\n\r\n    setOpen(false);\r\n  };\r\n\r\n  function handleListKeyDown(event) {\r\n    if (event.key === 'Tab') {\r\n      event.preventDefault();\r\n      setOpen(false);\r\n    }\r\n  }\r\n\r\n  // return focus to the button when we transitioned from !open -> open\r\n  const prevOpen = React.useRef(open);\r\n  React.useEffect(() => {\r\n    if (prevOpen.current === true && open === false) {\r\n      anchorRef.current.focus();\r\n    }\r\n\r\n    prevOpen.current = open;\r\n  }, [open]);\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <Paper className={classes.paper}>\r\n        <MenuList>\r\n          <MenuItem>Profile</MenuItem>\r\n          <MenuItem>My account</MenuItem>\r\n          <MenuItem>Logout</MenuItem>\r\n        </MenuList>\r\n      </Paper>\r\n      <div>\r\n        <Button\r\n          ref={anchorRef}\r\n          aria-controls={open ? 'menu-list-grow' : undefined}\r\n          aria-haspopup=\"true\"\r\n          onClick={handleToggle}\r\n        >\r\n          Toggle Menu Grow\r\n        </Button>\r\n        <Popper open={open} anchorEl={anchorRef.current} role={undefined} transition disablePortal>\r\n          {({ TransitionProps, placement }) => (\r\n            <Grow\r\n              {...TransitionProps}\r\n              style={{ transformOrigin: placement === 'bottom' ? 'center top' : 'center bottom' }}\r\n            >\r\n              <Paper>\r\n                <ClickAwayListener onClickAway={handleClose}>\r\n                  <MenuList autoFocusItem={open} id=\"menu-list-grow\" onKeyDown={handleListKeyDown}>\r\n                    <MenuItem onClick={handleClose}>Profile</MenuItem>\r\n                    <MenuItem onClick={handleClose}>My account</MenuItem>\r\n                    <MenuItem onClick={handleClose}>Logout</MenuItem>\r\n                  </MenuList>\r\n                </ClickAwayListener>\r\n              </Paper>\r\n            </Grow>\r\n          )}\r\n        </Popper>\r\n      </div>\r\n    </div>\r\n  );\r\n}\r\n"},2083:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return I}));var r=t(14),a=t(20),o=t(0),i=t.n(o),c=t(10),l=t(1170),u=t(445),s=t(1167),m=t(1220),p=t(1173),d=t(1284),f=t.n(d),b=t(1368),h=t.n(b),O=t(1432),v=t.n(O),j=t(1),M=Object(c.a)({paper:{border:"1px solid #d3d4d5"}})((function(e){return Object(j.a)(u.a,Object(a.a)({elevation:0,getContentAnchorEl:null,anchorOrigin:{vertical:"bottom",horizontal:"center"},transformOrigin:{vertical:"top",horizontal:"center"}},e))})),y=Object(c.a)((function(e){return{root:{"&:focus":{backgroundColor:e.palette.primary.main,"& .MuiListItemIcon-root, & .MuiListItemText-primary":{color:e.palette.common.white}}}}}))(s.a);function I(){var e=i.a.useState(null),n=Object(r.a)(e,2),t=n[0],a=n[1];return Object(j.a)("div",null,Object(j.a)(l.a,{"aria-controls":"customized-menu","aria-haspopup":"true",variant:"contained",color:"primary",onClick:function(e){a(e.currentTarget)}},"Open Menu"),Object(j.a)(M,{id:"customized-menu",anchorEl:t,keepMounted:!0,open:Boolean(t),onClose:function(){a(null)}},Object(j.a)(y,null,Object(j.a)(m.a,null,Object(j.a)(v.a,{fontSize:"small"})),Object(j.a)(p.a,{primary:"Sent mail"})),Object(j.a)(y,null,Object(j.a)(m.a,null,Object(j.a)(h.a,{fontSize:"small"})),Object(j.a)(p.a,{primary:"Drafts"})),Object(j.a)(y,null,Object(j.a)(m.a,null,Object(j.a)(f.a,{fontSize:"small"})),Object(j.a)(p.a,{primary:"Inbox"}))))}},2084:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport { withStyles } from '@material-ui/core/styles';\r\nimport Button from '@material-ui/core/Button';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport ListItemIcon from '@material-ui/core/ListItemIcon';\r\nimport ListItemText from '@material-ui/core/ListItemText';\r\nimport InboxIcon from '@material-ui/icons/MoveToInbox';\r\nimport DraftsIcon from '@material-ui/icons/Drafts';\r\nimport SendIcon from '@material-ui/icons/Send';\r\n\r\nconst StyledMenu = withStyles({\r\n  paper: {\r\n    border: '1px solid #d3d4d5',\r\n  },\r\n})((props) => (\r\n  <Menu\r\n    elevation={0}\r\n    getContentAnchorEl={null}\r\n    anchorOrigin={{\r\n      vertical: 'bottom',\r\n      horizontal: 'center',\r\n    }}\r\n    transformOrigin={{\r\n      vertical: 'top',\r\n      horizontal: 'center',\r\n    }}\r\n    {...props}\r\n  />\r\n));\r\n\r\nconst StyledMenuItem = withStyles((theme) => ({\r\n  root: {\r\n    '&:focus': {\r\n      backgroundColor: theme.palette.primary.main,\r\n      '& .MuiListItemIcon-root, & .MuiListItemText-primary': {\r\n        color: theme.palette.common.white,\r\n      },\r\n    },\r\n  },\r\n}))(MenuItem);\r\n\r\nexport default function CustomizedMenus() {\r\n  const [anchorEl, setAnchorEl] = React.useState(null);\r\n\r\n  const handleClick = (event) => {\r\n    setAnchorEl(event.currentTarget);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button\r\n        aria-controls=\"customized-menu\"\r\n        aria-haspopup=\"true\"\r\n        variant=\"contained\"\r\n        color=\"primary\"\r\n        onClick={handleClick}\r\n      >\r\n        Open Menu\r\n      </Button>\r\n      <StyledMenu\r\n        id=\"customized-menu\"\r\n        anchorEl={anchorEl}\r\n        keepMounted\r\n        open={Boolean(anchorEl)}\r\n        onClose={handleClose}\r\n      >\r\n        <StyledMenuItem>\r\n          <ListItemIcon>\r\n            <SendIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <ListItemText primary=\"Sent mail\" />\r\n        </StyledMenuItem>\r\n        <StyledMenuItem>\r\n          <ListItemIcon>\r\n            <DraftsIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <ListItemText primary=\"Drafts\" />\r\n        </StyledMenuItem>\r\n        <StyledMenuItem>\r\n          <ListItemIcon>\r\n            <InboxIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <ListItemText primary=\"Inbox\" />\r\n        </StyledMenuItem>\r\n      </StyledMenu>\r\n    </div>\r\n  );\r\n}\r\n"},2085:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return d}));var r=t(14),a=t(0),o=t.n(a),i=t(399),c=t(445),l=t(1167),u=t(1348),s=t.n(u),m=t(1),p=["None","Atria","Callisto","Dione","Ganymede","Hangouts Call","Luna","Oberon","Phobos","Pyxis","Sedna","Titania","Triton","Umbriel"];function d(){var e=o.a.useState(null),n=Object(r.a)(e,2),t=n[0],a=n[1],u=Boolean(t),d=function(){a(null)};return Object(m.a)("div",null,Object(m.a)(i.a,{"aria-label":"more","aria-controls":"long-menu","aria-haspopup":"true",onClick:function(e){a(e.currentTarget)}},Object(m.a)(s.a,null)),Object(m.a)(c.a,{id:"long-menu",anchorEl:t,keepMounted:!0,open:u,onClose:d,PaperProps:{style:{maxHeight:216,width:"20ch"}}},p.map((function(e){return Object(m.a)(l.a,{key:e,selected:"Pyxis"===e,onClick:d},e)}))))}},2086:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport IconButton from '@material-ui/core/IconButton';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport MoreVertIcon from '@material-ui/icons/MoreVert';\r\n\r\nconst options = [\r\n  'None',\r\n  'Atria',\r\n  'Callisto',\r\n  'Dione',\r\n  'Ganymede',\r\n  'Hangouts Call',\r\n  'Luna',\r\n  'Oberon',\r\n  'Phobos',\r\n  'Pyxis',\r\n  'Sedna',\r\n  'Titania',\r\n  'Triton',\r\n  'Umbriel',\r\n];\r\n\r\nconst ITEM_HEIGHT = 48;\r\n\r\nexport default function LongMenu() {\r\n  const [anchorEl, setAnchorEl] = React.useState(null);\r\n  const open = Boolean(anchorEl);\r\n\r\n  const handleClick = (event) => {\r\n    setAnchorEl(event.currentTarget);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <IconButton\r\n        aria-label=\"more\"\r\n        aria-controls=\"long-menu\"\r\n        aria-haspopup=\"true\"\r\n        onClick={handleClick}\r\n      >\r\n        <MoreVertIcon />\r\n      </IconButton>\r\n      <Menu\r\n        id=\"long-menu\"\r\n        anchorEl={anchorEl}\r\n        keepMounted\r\n        open={open}\r\n        onClose={handleClose}\r\n        PaperProps={{\r\n          style: {\r\n            maxHeight: ITEM_HEIGHT * 4.5,\r\n            width: '20ch',\r\n          },\r\n        }}\r\n      >\r\n        {options.map((option) => (\r\n          <MenuItem key={option} selected={option === 'Pyxis'} onClick={handleClose}>\r\n            {option}\r\n          </MenuItem>\r\n        ))}\r\n      </Menu>\r\n    </div>\r\n  );\r\n}\r\n"},2087:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return O}));t(0);var r=t(1128),a=t(1167),o=t(221),i=t(1166),c=t(1220),l=t(169),u=t(1368),s=t.n(u),m=t(1432),p=t.n(m),d=t(2088),f=t.n(d),b=t(1),h=Object(i.a)({root:{width:230}});function O(){var e=h();return Object(b.a)(o.a,{className:e.root},Object(b.a)(r.a,null,Object(b.a)(a.a,null,Object(b.a)(c.a,null,Object(b.a)(p.a,{fontSize:"small"})),Object(b.a)(l.a,{variant:"inherit"},"A short message")),Object(b.a)(a.a,null,Object(b.a)(c.a,null,Object(b.a)(f.a,{fontSize:"small"})),Object(b.a)(l.a,{variant:"inherit"},"A very long text that overflows")),Object(b.a)(a.a,null,Object(b.a)(c.a,null,Object(b.a)(s.a,{fontSize:"small"})),Object(b.a)(l.a,{variant:"inherit",noWrap:!0},"A very long text that overflows"))))}},2088:function(e,n,t){"use strict";var r=t(648);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=r(t(0)),o=(0,r(t(1231)).default)(a.default.createElement(a.default.Fragment,null,a.default.createElement("circle",{cx:"12",cy:"19",r:"2"}),a.default.createElement("path",{d:"M10 3h4v12h-4z"})),"PriorityHigh");n.default=o},2089:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport MenuList from '@material-ui/core/MenuList';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport Paper from '@material-ui/core/Paper';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport ListItemIcon from '@material-ui/core/ListItemIcon';\r\nimport Typography from '@material-ui/core/Typography';\r\nimport DraftsIcon from '@material-ui/icons/Drafts';\r\nimport SendIcon from '@material-ui/icons/Send';\r\nimport PriorityHighIcon from '@material-ui/icons/PriorityHigh';\r\n\r\nconst useStyles = makeStyles({\r\n  root: {\r\n    width: 230,\r\n  },\r\n});\r\n\r\nexport default function TypographyMenu() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <Paper className={classes.root}>\r\n      <MenuList>\r\n        <MenuItem>\r\n          <ListItemIcon>\r\n            <SendIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <Typography variant=\"inherit\">A short message</Typography>\r\n        </MenuItem>\r\n        <MenuItem>\r\n          <ListItemIcon>\r\n            <PriorityHighIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <Typography variant=\"inherit\">A very long text that overflows</Typography>\r\n        </MenuItem>\r\n        <MenuItem>\r\n          <ListItemIcon>\r\n            <DraftsIcon fontSize=\"small\" />\r\n          </ListItemIcon>\r\n          <Typography variant=\"inherit\" noWrap>\r\n            A very long text that overflows\r\n          </Typography>\r\n        </MenuItem>\r\n      </MenuList>\r\n    </Paper>\r\n  );\r\n}\r\n"},2090:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return m}));var r=t(14),a=t(0),o=t.n(a),i=t(1170),c=t(445),l=t(1167),u=t(644),s=t(1);function m(){var e=o.a.useState(null),n=Object(r.a)(e,2),t=n[0],a=n[1],m=Boolean(t),p=function(){a(null)};return Object(s.a)("div",null,Object(s.a)(i.a,{"aria-controls":"fade-menu","aria-haspopup":"true",onClick:function(e){a(e.currentTarget)}},"Open with fade transition"),Object(s.a)(c.a,{id:"fade-menu",anchorEl:t,keepMounted:!0,open:m,onClose:p,TransitionComponent:u.a},Object(s.a)(l.a,{onClick:p},"Profile"),Object(s.a)(l.a,{onClick:p},"My account"),Object(s.a)(l.a,{onClick:p},"Logout")))}},2091:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport Fade from '@material-ui/core/Fade';\r\n\r\nexport default function FadeMenu() {\r\n  const [anchorEl, setAnchorEl] = React.useState(null);\r\n  const open = Boolean(anchorEl);\r\n\r\n  const handleClick = (event) => {\r\n    setAnchorEl(event.currentTarget);\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setAnchorEl(null);\r\n  };\r\n\r\n  return (\r\n    <div>\r\n      <Button aria-controls=\"fade-menu\" aria-haspopup=\"true\" onClick={handleClick}>\r\n        Open with fade transition\r\n      </Button>\r\n      <Menu\r\n        id=\"fade-menu\"\r\n        anchorEl={anchorEl}\r\n        keepMounted\r\n        open={open}\r\n        onClose={handleClose}\r\n        TransitionComponent={Fade}\r\n      >\r\n        <MenuItem onClick={handleClose}>Profile</MenuItem>\r\n        <MenuItem onClick={handleClose}>My account</MenuItem>\r\n        <MenuItem onClick={handleClose}>Logout</MenuItem>\r\n      </Menu>\r\n    </div>\r\n  );\r\n}\r\n"},2092:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return m}));var r=t(14),a=t(0),o=t.n(a),i=t(445),c=t(1167),l=t(169),u=t(1),s={mouseX:null,mouseY:null};function m(){var e=o.a.useState(s),n=Object(r.a)(e,2),t=n[0],a=n[1],m=function(){a(s)};return Object(u.a)("div",{onContextMenu:function(e){e.preventDefault(),a({mouseX:e.clientX-2,mouseY:e.clientY-4})},style:{cursor:"context-menu"}},Object(u.a)(l.a,null,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum purus, bibendum sit amet vulputate eget, porta semper ligula. Donec bibendum vulputate erat, ac fringilla mi finibus nec. Donec ac dolor sed dolor porttitor blandit vel vel purus. Fusce vel malesuada ligula. Nam quis vehicula ante, eu finibus est. Proin ullamcorper fermentum orci, quis finibus massa. Nunc lobortis, massa ut rutrum ultrices, metus metus finibus ex, sit amet facilisis neque enim sed neque. Quisque accumsan metus vel maximus consequat. Suspendisse lacinia tellus a libero volutpat maximus."),Object(u.a)(i.a,{keepMounted:!0,open:null!==t.mouseY,onClose:m,anchorReference:"anchorPosition",anchorPosition:null!==t.mouseY&&null!==t.mouseX?{top:t.mouseY,left:t.mouseX}:void 0},Object(u.a)(c.a,{onClick:m},"Copy"),Object(u.a)(c.a,{onClick:m},"Print"),Object(u.a)(c.a,{onClick:m},"Highlight"),Object(u.a)(c.a,{onClick:m},"Email")))}},2093:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport Typography from '@material-ui/core/Typography';\r\n\r\nconst initialState = {\r\n  mouseX: null,\r\n  mouseY: null,\r\n};\r\n\r\nexport default function ContextMenu() {\r\n  const [state, setState] = React.useState(initialState);\r\n\r\n  const handleClick = (event) => {\r\n    event.preventDefault();\r\n    setState({\r\n      mouseX: event.clientX - 2,\r\n      mouseY: event.clientY - 4,\r\n    });\r\n  };\r\n\r\n  const handleClose = () => {\r\n    setState(initialState);\r\n  };\r\n\r\n  return (\r\n    <div onContextMenu={handleClick} style={{ cursor: 'context-menu' }}>\r\n      <Typography>\r\n        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ipsum purus, bibendum sit\r\n        amet vulputate eget, porta semper ligula. Donec bibendum vulputate erat, ac fringilla mi\r\n        finibus nec. Donec ac dolor sed dolor porttitor blandit vel vel purus. Fusce vel malesuada\r\n        ligula. Nam quis vehicula ante, eu finibus est. Proin ullamcorper fermentum orci, quis\r\n        finibus massa. Nunc lobortis, massa ut rutrum ultrices, metus metus finibus ex, sit amet\r\n        facilisis neque enim sed neque. Quisque accumsan metus vel maximus consequat. Suspendisse\r\n        lacinia tellus a libero volutpat maximus.\r\n      </Typography>\r\n      <Menu\r\n        keepMounted\r\n        open={state.mouseY !== null}\r\n        onClose={handleClose}\r\n        anchorReference=\"anchorPosition\"\r\n        anchorPosition={\r\n          state.mouseY !== null && state.mouseX !== null\r\n            ? { top: state.mouseY, left: state.mouseX }\r\n            : undefined\r\n        }\r\n      >\r\n        <MenuItem onClick={handleClose}>Copy</MenuItem>\r\n        <MenuItem onClick={handleClose}>Print</MenuItem>\r\n        <MenuItem onClick={handleClose}>Highlight</MenuItem>\r\n        <MenuItem onClick={handleClose}>Email</MenuItem>\r\n      </Menu>\r\n    </div>\r\n  );\r\n}\r\n"},2094:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));var r=t(20),a=t(0),o=t.n(a),i=t(1170),c=t(445),l=t(1167),u=t(1490),s=t.n(u),m=t(1);function p(){return Object(m.a)(s.a,{variant:"popover",popupId:"demo-popup-menu"},(function(e){return Object(m.a)(o.a.Fragment,null,Object(m.a)(i.a,Object(r.a)({variant:"contained",color:"primary"},Object(u.bindTrigger)(e)),"Open Menu"),Object(m.a)(c.a,Object(u.bindMenu)(e),Object(m.a)(l.a,{onClick:e.close},"Cake"),Object(m.a)(l.a,{onClick:e.close},"Death")))}))}},2096:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Button from '@material-ui/core/Button';\r\nimport Menu from '@material-ui/core/Menu';\r\nimport MenuItem from '@material-ui/core/MenuItem';\r\nimport PopupState, { bindTrigger, bindMenu } from 'material-ui-popup-state';\r\n\r\nexport default function MenuPopupState() {\r\n  return (\r\n    <PopupState variant=\"popover\" popupId=\"demo-popup-menu\">\r\n      {(popupState) => (\r\n        <React.Fragment>\r\n          <Button variant=\"contained\" color=\"primary\" {...bindTrigger(popupState)}>\r\n            Open Menu\r\n          </Button>\r\n          <Menu {...bindMenu(popupState)}>\r\n            <MenuItem onClick={popupState.close}>Cake</MenuItem>\r\n            <MenuItem onClick={popupState.close}>Death</MenuItem>\r\n          </Menu>\r\n        </React.Fragment>\r\n      )}\r\n    </PopupState>\r\n  );\r\n}\r\n"},2877:function(e,n,t){"use strict";t.r(n);var r=t(0),a=t.n(r),o=t(1233),i=(t(140),t(1170)),c=t(547),l=t(169),u=t(1166),s=t(1),m=Object(u.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));n.default=function(e){return m(),Object(s.a)(a.a.Fragment,null,Object(s.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(s.a)(i.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/menus",target:"_blank",role:"button"},Object(s.a)(c.a,null,"link"),Object(s.a)("span",{className:"mx-4"},"Reference"))),Object(s.a)(l.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Menus"),Object(s.a)(l.a,{className:"description"},"Menus display a list of choices on temporary surfaces."),Object(s.a)(l.a,{className:"mb-16",component:"div"},"A ",Object(s.a)("a",{href:"https://material.io/design/components/menus.html"},"Menu")," displays a list of choices on a temporary surface. It appears when the user interacts with a button, or other control."),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Simple Menu"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"Simple menus open over the anchor element by default (this option can be changed via props). When close to a screen edge, simple menus vertically realign to make sure that all menu items are completely visible."),Object(s.a)(l.a,{className:"mb-16",component:"div"},"Choosing an option should immediately ideally commit the option and close the menu."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)("strong",null,"Disambiguation"),": In contrast to simple menus, simple dialogs can present additional detail related to the options available for a list item or provide navigational or orthogonal actions related to the primary task. Although they can display the same content, simple menus are preferred over simple dialogs because simple menus are less disruptive to the user\u2019s current context."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2077).default,raw:t(2078)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Selected menus"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"If used for item selection, when opened, simple menus attempt to vertically align the currently selected menu item with the anchor element, and the initial focus will be placed on the selected menu item. The currently selected menu item is set using the ",Object(s.a)("code",null,"selected")," property (from ",Object(s.a)("a",{href:"/api/list-item/"},"ListItem"),"). To use a selected menu item without impacting the initial focus or the vertical positioning of the menu, set the ",Object(s.a)("code",null,"variant")," property to ",Object(s.a)("code",null,"menu"),"."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2079).default,raw:t(2080)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"MenuList composition"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"The ",Object(s.a)("code",null,"Menu")," component uses the ",Object(s.a)("code",null,"Popover")," component internally. However, you might want to use a different positioning strategy, or not blocking the scroll. For answering those needs, we expose a ",Object(s.a)("code",null,"MenuList")," component that you can compose, with ",Object(s.a)("code",null,"Popper")," in this example."),Object(s.a)(l.a,{className:"mb-16",component:"div"},"The primary responsibility of the ",Object(s.a)("code",null,"MenuList")," component is to handle the focus."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2081).default,raw:t(2082)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Customized menus"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"Here is an example of customizing the component. You can learn more about this in the",Object(s.a)("a",{href:"/customization/components/"},"overrides documentation page"),"."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2083).default,raw:t(2084)})),Object(s.a)(l.a,{className:"mb-16",component:"div"},"The ",Object(s.a)("code",null,"MenuItem")," is a wrapper around ",Object(s.a)("code",null,"ListItem")," with some additional styles. You can use the same list composition features with the ",Object(s.a)("code",null,"MenuItem")," component:"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"\ud83c\udfa8 If you are looking for inspiration, you can check ",Object(s.a)("a",{href:"https://mui-treasury.com/styles/menu"},"MUI Treasury's customization examples"),"."),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Max height menus"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"If the height of a menu prevents all menu items from being displayed, the menu can scroll internally."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2085).default,raw:t(2086)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Limitations"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"There is ",Object(s.a)("a",{href:"https://bugs.chromium.org/p/chromium/issues/detail?id=327437"},"a flexbox bug")," that prevents ",Object(s.a)("code",null,"text-overflow: ellipsis")," from working in a flexbox layout. You can use the ",Object(s.a)("code",null,"Typography")," component with ",Object(s.a)("code",null,"noWrap")," to workaround this issue:"),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2087).default,raw:t(2089)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Change transition"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"Use a different transition."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2090).default,raw:t(2091)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Context menu"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"Here is an example of a context menu. (Right click to open.)"),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2092).default,raw:t(2093)})),Object(s.a)(l.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Complementary projects"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"For more advanced use cases you might be able to take advantage of:"),Object(s.a)(l.a,{className:"text-24 mt-32 mb-8",component:"h3"},"PopupState helper"),Object(s.a)(l.a,{className:"mb-16",component:"div"},"There is a 3rd party package ",Object(s.a)("a",{href:"https://github.com/jcoreio/material-ui-popup-state"},Object(s.a)("code",null,"material-ui-popup-state"))," that takes care of menu state for you in most cases."),Object(s.a)(l.a,{className:"mb-16",component:"div"},Object(s.a)(o.a,{className:"my-24",iframe:!1,component:t(2094).default,raw:t(2096)})))}}}]);