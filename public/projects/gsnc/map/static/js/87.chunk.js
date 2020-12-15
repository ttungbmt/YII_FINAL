(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[87],{1233:function(t,e,r){"use strict";r.d(e,"a",(function(){return C}));var a=r(14),n=r(140),i=r(1211),o=r(1218),c=r(547),s=r(1224),l=r(1225),m=r(0),d=r.n(m),u=r(18),p=r(8),b=r(86),f=r(87),h=r(150),j=r(149),v=r(1121),O=r(643),y=r(1158),g=r(1210),I=r(10),x=r(420),L=r(421),N=r(1234),k=r.n(N),D=r(1),A=Object(v.a)({productionPrefix:"iframe-"}),T=function(t){Object(h.a)(r,t);var e=Object(j.a)(r);function r(){var t;Object(b.a)(this,r);for(var a=arguments.length,n=new Array(a),i=0;i<a;i++)n[i]=arguments[i];return(t=e.call.apply(e,[this].concat(n))).state={ready:!1},t.handleRef=function(e){t.contentDocument=e?e.node.contentDocument:null},t.onContentDidMount=function(){t.setState({ready:!0,jss:Object(x.a)(Object(p.a)(Object(p.a)({},Object(O.a)()),{},{plugins:[].concat(Object(u.a)(Object(O.a)().plugins),[Object(L.a)()]),insertionPoint:t.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:t.contentDocument.body})},t.onContentDidUpdate=function(){t.contentDocument.body.dir=t.props.theme.direction},t.renderHead=function(){return Object(D.a)(d.a.Fragment,null,Object(D.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(D.a)("noscript",{id:"jss-demo-insertion-point"}))},t}return Object(f.a)(r,[{key:"render",value:function(){var t=this.props,e=t.children,r=t.classes,a=t.theme;return Object(D.a)(k.a,{head:this.renderHead(),ref:this.handleRef,className:r.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(D.a)(y.b,{jss:this.state.jss,generateClassName:A,sheetsManager:this.state.sheetsManager},Object(D.a)(g.a,{theme:a},d.a.cloneElement(e,{container:this.state.container}))):null)}}]),r}(d.a.Component),S=Object(I.a)((function(t){return{root:{backgroundColor:t.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:t.shadows[1]}}}),{withTheme:!0})(T);function w(t){var e=Object(m.useState)(t.currentTabIndex),r=Object(a.a)(e,2),d=r[0],u=r[1],p=t.component,b=t.raw,f=t.iframe,h=t.className;return Object(D.a)(o.a,{className:h},Object(D.a)(i.a,{position:"static",color:"default",elevation:0},Object(D.a)(l.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:d,onChange:function(t,e){u(e)}},p&&Object(D.a)(s.a,{classes:{root:"min-w-64"},icon:Object(D.a)(c.a,null,"remove_red_eye")}),b&&Object(D.a)(s.a,{classes:{root:"min-w-64"},icon:Object(D.a)(c.a,null,"code")}))),Object(D.a)("div",{className:"flex justify-center max-w-full"},Object(D.a)("div",{className:0===d?"flex flex-1 max-w-full":"hidden"},p&&(f?Object(D.a)(S,null,Object(D.a)(p,null)):Object(D.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(D.a)(p,null)))),Object(D.a)("div",{className:1===d?"flex flex-1":"hidden"},b&&Object(D.a)("div",{className:"flex flex-1"},Object(D.a)(n.a,{component:"pre",className:"language-javascript w-full"},b.default)))))}w.defaultProps={currentTabIndex:0};var C=w},1970:function(t,e,r){"use strict";r.r(e),r.d(e,"default",(function(){return m}));r(0);var a=r(1166),n=r(1129),i=r(1130),o=r(1173),c=r(1217),s=r(1),l=Object(a.a)((function(t){return{root:{width:"100%",maxWidth:360,backgroundColor:t.palette.background.paper}}}));function m(){var t=l();return Object(s.a)(n.a,{component:"nav",className:t.root,"aria-label":"mailbox folders"},Object(s.a)(i.a,{button:!0},Object(s.a)(o.a,{primary:"Inbox"})),Object(s.a)(c.a,null),Object(s.a)(i.a,{button:!0,divider:!0},Object(s.a)(o.a,{primary:"Drafts"})),Object(s.a)(i.a,{button:!0},Object(s.a)(o.a,{primary:"Trash"})),Object(s.a)(c.a,{light:!0}),Object(s.a)(i.a,{button:!0},Object(s.a)(o.a,{primary:"Spam"})))}},1971:function(t,e,r){"use strict";r.r(e),e.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport List from '@material-ui/core/List';\r\nimport ListItem from '@material-ui/core/ListItem';\r\nimport ListItemText from '@material-ui/core/ListItemText';\r\nimport Divider from '@material-ui/core/Divider';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    maxWidth: 360,\r\n    backgroundColor: theme.palette.background.paper,\r\n  },\r\n}));\r\n\r\nexport default function ListDividers() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <List component=\"nav\" className={classes.root} aria-label=\"mailbox folders\">\r\n      <ListItem button>\r\n        <ListItemText primary=\"Inbox\" />\r\n      </ListItem>\r\n      <Divider />\r\n      <ListItem button divider>\r\n        <ListItemText primary=\"Drafts\" />\r\n      </ListItem>\r\n      <ListItem button>\r\n        <ListItemText primary=\"Trash\" />\r\n      </ListItem>\r\n      <Divider light />\r\n      <ListItem button>\r\n        <ListItemText primary=\"Spam\" />\r\n      </ListItem>\r\n    </List>\r\n  );\r\n}\r\n"},1972:function(t,e,r){"use strict";r.r(e),r.d(e,"default",(function(){return v}));r(0);var a=r(1166),n=r(1129),i=r(1130),o=r(1173),c=r(1386),s=r(1229),l=r(1486),m=r.n(l),d=r(1487),u=r.n(d),p=r(1429),b=r.n(p),f=r(1217),h=r(1),j=Object(a.a)((function(t){return{root:{width:"100%",maxWidth:360,backgroundColor:t.palette.background.paper}}}));function v(){var t=j();return Object(h.a)(n.a,{className:t.root},Object(h.a)(i.a,null,Object(h.a)(c.a,null,Object(h.a)(s.a,null,Object(h.a)(m.a,null))),Object(h.a)(o.a,{primary:"Photos",secondary:"Jan 9, 2014"})),Object(h.a)(f.a,{variant:"inset",component:"li"}),Object(h.a)(i.a,null,Object(h.a)(c.a,null,Object(h.a)(s.a,null,Object(h.a)(u.a,null))),Object(h.a)(o.a,{primary:"Work",secondary:"Jan 7, 2014"})),Object(h.a)(f.a,{variant:"inset",component:"li"}),Object(h.a)(i.a,null,Object(h.a)(c.a,null,Object(h.a)(s.a,null,Object(h.a)(b.a,null))),Object(h.a)(o.a,{primary:"Vacation",secondary:"July 20, 2014"})))}},1973:function(t,e,r){"use strict";r.r(e),e.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport List from '@material-ui/core/List';\r\nimport ListItem from '@material-ui/core/ListItem';\r\nimport ListItemText from '@material-ui/core/ListItemText';\r\nimport ListItemAvatar from '@material-ui/core/ListItemAvatar';\r\nimport Avatar from '@material-ui/core/Avatar';\r\nimport ImageIcon from '@material-ui/icons/Image';\r\nimport WorkIcon from '@material-ui/icons/Work';\r\nimport BeachAccessIcon from '@material-ui/icons/BeachAccess';\r\nimport Divider from '@material-ui/core/Divider';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: '100%',\r\n    maxWidth: 360,\r\n    backgroundColor: theme.palette.background.paper,\r\n  },\r\n}));\r\n\r\nexport default function InsetDividers() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <List className={classes.root}>\r\n      <ListItem>\r\n        <ListItemAvatar>\r\n          <Avatar>\r\n            <ImageIcon />\r\n          </Avatar>\r\n        </ListItemAvatar>\r\n        <ListItemText primary=\"Photos\" secondary=\"Jan 9, 2014\" />\r\n      </ListItem>\r\n      <Divider variant=\"inset\" component=\"li\" />\r\n      <ListItem>\r\n        <ListItemAvatar>\r\n          <Avatar>\r\n            <WorkIcon />\r\n          </Avatar>\r\n        </ListItemAvatar>\r\n        <ListItemText primary=\"Work\" secondary=\"Jan 7, 2014\" />\r\n      </ListItem>\r\n      <Divider variant=\"inset\" component=\"li\" />\r\n      <ListItem>\r\n        <ListItemAvatar>\r\n          <Avatar>\r\n            <BeachAccessIcon />\r\n          </Avatar>\r\n        </ListItemAvatar>\r\n        <ListItemText primary=\"Vacation\" secondary=\"July 20, 2014\" />\r\n      </ListItem>\r\n    </List>\r\n  );\r\n}\r\n"},1974:function(t,e,r){"use strict";r.r(e),r.d(e,"default",(function(){return f}));r(0);var a=r(1166),n=r(1129),i=r(1130),o=r(1386),c=r(1173),s=r(1229),l=r(1429),m=r.n(l),d=r(1217),u=r(169),p=r(1),b=Object(a.a)((function(t){return{root:{width:"100%",maxWidth:360,backgroundColor:t.palette.background.paper},dividerFullWidth:{margin:"5px 0 0 ".concat(t.spacing(2),"px")},dividerInset:{margin:"5px 0 0 ".concat(t.spacing(9),"px")}}}));function f(){var t=b();return Object(p.a)(n.a,{className:t.root},Object(p.a)(i.a,null,Object(p.a)(c.a,{primary:"Photos",secondary:"Jan 9, 2014"})),Object(p.a)(d.a,{component:"li"}),Object(p.a)("li",null,Object(p.a)(u.a,{className:t.dividerFullWidth,color:"textSecondary",display:"block",variant:"caption"},"Divider")),Object(p.a)(i.a,null,Object(p.a)(c.a,{primary:"Work",secondary:"Jan 7, 2014"})),Object(p.a)(d.a,{component:"li",variant:"inset"}),Object(p.a)("li",null,Object(p.a)(u.a,{className:t.dividerInset,color:"textSecondary",display:"block",variant:"caption"},"Leisure")),Object(p.a)(i.a,null,Object(p.a)(o.a,null,Object(p.a)(s.a,null,Object(p.a)(m.a,null))),Object(p.a)(c.a,{primary:"Vacation",secondary:"July 20, 2014"})))}},1975:function(t,e,r){"use strict";r.r(e),e.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport List from \'@material-ui/core/List\';\r\nimport ListItem from \'@material-ui/core/ListItem\';\r\nimport ListItemAvatar from \'@material-ui/core/ListItemAvatar\';\r\nimport ListItemText from \'@material-ui/core/ListItemText\';\r\nimport Avatar from \'@material-ui/core/Avatar\';\r\nimport BeachAccessIcon from \'@material-ui/icons/BeachAccess\';\r\nimport Divider from \'@material-ui/core/Divider\';\r\nimport Typography from \'@material-ui/core/Typography\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: \'100%\',\r\n    maxWidth: 360,\r\n    backgroundColor: theme.palette.background.paper,\r\n  },\r\n  dividerFullWidth: {\r\n    margin: `5px 0 0 ${theme.spacing(2)}px`,\r\n  },\r\n  dividerInset: {\r\n    margin: `5px 0 0 ${theme.spacing(9)}px`,\r\n  },\r\n}));\r\n\r\nexport default function SubheaderDividers() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <List className={classes.root}>\r\n      <ListItem>\r\n        <ListItemText primary="Photos" secondary="Jan 9, 2014" />\r\n      </ListItem>\r\n      <Divider component="li" />\r\n      <li>\r\n        <Typography\r\n          className={classes.dividerFullWidth}\r\n          color="textSecondary"\r\n          display="block"\r\n          variant="caption"\r\n        >\r\n          Divider\r\n        </Typography>\r\n      </li>\r\n      <ListItem>\r\n        <ListItemText primary="Work" secondary="Jan 7, 2014" />\r\n      </ListItem>\r\n      <Divider component="li" variant="inset" />\r\n      <li>\r\n        <Typography\r\n          className={classes.dividerInset}\r\n          color="textSecondary"\r\n          display="block"\r\n          variant="caption"\r\n        >\r\n          Leisure\r\n        </Typography>\r\n      </li>\r\n      <ListItem>\r\n        <ListItemAvatar>\r\n          <Avatar>\r\n            <BeachAccessIcon />\r\n          </Avatar>\r\n        </ListItemAvatar>\r\n        <ListItemText primary="Vacation" secondary="July 20, 2014" />\r\n      </ListItem>\r\n    </List>\r\n  );\r\n}\r\n'},1976:function(t,e,r){"use strict";r.r(e),r.d(e,"default",(function(){return d}));r(0);var a=r(1166),n=r(1178),i=r(1170),o=r(1280),c=r(1217),s=r(169),l=r(1),m=Object(a.a)((function(t){return{root:{width:"100%",maxWidth:360,backgroundColor:t.palette.background.paper},chip:{margin:t.spacing(.5)},section1:{margin:t.spacing(3,2)},section2:{margin:t.spacing(2)},section3:{margin:t.spacing(3,1,1)}}}));function d(){var t=m();return Object(l.a)("div",{className:t.root},Object(l.a)("div",{className:t.section1},Object(l.a)(o.a,{container:!0,alignItems:"center"},Object(l.a)(o.a,{item:!0,xs:!0},Object(l.a)(s.a,{gutterBottom:!0,variant:"h4"},"Toothbrush")),Object(l.a)(o.a,{item:!0},Object(l.a)(s.a,{gutterBottom:!0,variant:"h6"},"$4.50"))),Object(l.a)(s.a,{color:"textSecondary",variant:"body2"},"Pinstriped cornflower blue cotton blouse takes you on a walk to the park or just down the hall.")),Object(l.a)(c.a,{variant:"middle"}),Object(l.a)("div",{className:t.section2},Object(l.a)(s.a,{gutterBottom:!0,variant:"body1"},"Select type"),Object(l.a)("div",null,Object(l.a)(n.a,{className:t.chip,label:"Extra Soft"}),Object(l.a)(n.a,{className:t.chip,color:"primary",label:"Soft"}),Object(l.a)(n.a,{className:t.chip,label:"Medium"}),Object(l.a)(n.a,{className:t.chip,label:"Hard"}))),Object(l.a)("div",{className:t.section3},Object(l.a)(i.a,{color:"primary"},"Add to cart")))}},1977:function(t,e,r){"use strict";r.r(e),e.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport Chip from \'@material-ui/core/Chip\';\r\nimport Button from \'@material-ui/core/Button\';\r\nimport Grid from \'@material-ui/core/Grid\';\r\nimport Divider from \'@material-ui/core/Divider\';\r\nimport Typography from \'@material-ui/core/Typography\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: \'100%\',\r\n    maxWidth: 360,\r\n    backgroundColor: theme.palette.background.paper,\r\n  },\r\n  chip: {\r\n    margin: theme.spacing(0.5),\r\n  },\r\n  section1: {\r\n    margin: theme.spacing(3, 2),\r\n  },\r\n  section2: {\r\n    margin: theme.spacing(2),\r\n  },\r\n  section3: {\r\n    margin: theme.spacing(3, 1, 1),\r\n  },\r\n}));\r\n\r\nexport default function MiddleDividers() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div className={classes.root}>\r\n      <div className={classes.section1}>\r\n        <Grid container alignItems="center">\r\n          <Grid item xs>\r\n            <Typography gutterBottom variant="h4">\r\n              Toothbrush\r\n            </Typography>\r\n          </Grid>\r\n          <Grid item>\r\n            <Typography gutterBottom variant="h6">\r\n              $4.50\r\n            </Typography>\r\n          </Grid>\r\n        </Grid>\r\n        <Typography color="textSecondary" variant="body2">\r\n          Pinstriped cornflower blue cotton blouse takes you on a walk to the park or just down the\r\n          hall.\r\n        </Typography>\r\n      </div>\r\n      <Divider variant="middle" />\r\n      <div className={classes.section2}>\r\n        <Typography gutterBottom variant="body1">\r\n          Select type\r\n        </Typography>\r\n        <div>\r\n          <Chip className={classes.chip} label="Extra Soft" />\r\n          <Chip className={classes.chip} color="primary" label="Soft" />\r\n          <Chip className={classes.chip} label="Medium" />\r\n          <Chip className={classes.chip} label="Hard" />\r\n        </div>\r\n      </div>\r\n      <div className={classes.section3}>\r\n        <Button color="primary">Add to cart</Button>\r\n      </div>\r\n    </div>\r\n  );\r\n}\r\n'},1978:function(t,e,r){"use strict";r.r(e),r.d(e,"default",(function(){return y}));r(0);var a=r(1166),n=r(1979),i=r.n(n),o=r(1980),c=r.n(o),s=r(1981),l=r.n(s),m=r(1982),d=r.n(m),u=r(1983),p=r.n(u),b=r(1984),f=r.n(b),h=r(1280),j=r(1217),v=r(1),O=Object(a.a)((function(t){return{root:{width:"fit-content",border:"1px solid ".concat(t.palette.divider),borderRadius:t.shape.borderRadius,backgroundColor:t.palette.background.paper,color:t.palette.text.secondary,"& svg":{margin:t.spacing(1.5)},"& hr":{margin:t.spacing(0,.5)}}}}));function y(){var t=O();return Object(v.a)("div",null,Object(v.a)(h.a,{container:!0,alignItems:"center",className:t.root},Object(v.a)(i.a,null),Object(v.a)(c.a,null),Object(v.a)(l.a,null),Object(v.a)(j.a,{orientation:"vertical",flexItem:!0}),Object(v.a)(d.a,null),Object(v.a)(p.a,null),Object(v.a)(f.a,null)))}},1985:function(t,e,r){"use strict";r.r(e),e.default="import React from 'react';\r\nimport { makeStyles } from '@material-ui/core/styles';\r\nimport FormatAlignLeftIcon from '@material-ui/icons/FormatAlignLeft';\r\nimport FormatAlignCenterIcon from '@material-ui/icons/FormatAlignCenter';\r\nimport FormatAlignRightIcon from '@material-ui/icons/FormatAlignRight';\r\nimport FormatBoldIcon from '@material-ui/icons/FormatBold';\r\nimport FormatItalicIcon from '@material-ui/icons/FormatItalic';\r\nimport FormatUnderlinedIcon from '@material-ui/icons/FormatUnderlined';\r\nimport Grid from '@material-ui/core/Grid';\r\nimport Divider from '@material-ui/core/Divider';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  root: {\r\n    width: 'fit-content',\r\n    border: `1px solid ${theme.palette.divider}`,\r\n    borderRadius: theme.shape.borderRadius,\r\n    backgroundColor: theme.palette.background.paper,\r\n    color: theme.palette.text.secondary,\r\n    '& svg': {\r\n      margin: theme.spacing(1.5),\r\n    },\r\n    '& hr': {\r\n      margin: theme.spacing(0, 0.5),\r\n    },\r\n  },\r\n}));\r\n\r\nexport default function VerticalDividers() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <div>\r\n      <Grid container alignItems=\"center\" className={classes.root}>\r\n        <FormatAlignLeftIcon />\r\n        <FormatAlignCenterIcon />\r\n        <FormatAlignRightIcon />\r\n        <Divider orientation=\"vertical\" flexItem />\r\n        <FormatBoldIcon />\r\n        <FormatItalicIcon />\r\n        <FormatUnderlinedIcon />\r\n      </Grid>\r\n    </div>\r\n  );\r\n}\r\n"},2869:function(t,e,r){"use strict";r.r(e);var a=r(0),n=r.n(a),i=r(1233),o=(r(140),r(1170)),c=r(547),s=r(169),l=r(1166),m=r(1),d=Object(l.a)((function(t){return{layoutRoot:{"& .description":{marginBottom:16}}}}));e.default=function(t){return d(),Object(m.a)(n.a.Fragment,null,Object(m.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(m.a)(o.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/dividers",target:"_blank",role:"button"},Object(m.a)(c.a,null,"link"),Object(m.a)("span",{className:"mx-4"},"Reference"))),Object(m.a)(s.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Divider"),Object(m.a)(s.a,{className:"description"},"A divider is a thin line that groups content in lists and layouts."),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)("a",{href:"https://material.io/design/components/dividers.html"},"Dividers")," separate content into clear groups."),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"List Dividers"),Object(m.a)(s.a,{className:"mb-16",component:"div"},"The divider renders as an ",Object(m.a)("code",null,"<hr>")," by default. You can save rendering this DOM element by using the ",Object(m.a)("code",null,"divider")," property on the ",Object(m.a)("code",null,"ListItem")," component."),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)(i.a,{className:"my-24",iframe:!1,component:r(1970).default,raw:r(1971)})),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"HTML5 Specification"),Object(m.a)(s.a,{className:"mb-16",component:"div"},"In a list, you should ensure the ",Object(m.a)("code",null,"Divider")," is rendered as an ",Object(m.a)("code",null,"<li>")," to match the HTML5 specification. The examples below show two ways of achieving this."),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Inset Dividers"),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)(i.a,{className:"my-24",iframe:!1,component:r(1972).default,raw:r(1973)})),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Subheader Dividers"),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)(i.a,{className:"my-24",iframe:!1,component:r(1974).default,raw:r(1975)})),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Middle Dividers"),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)(i.a,{className:"my-24",iframe:!1,component:r(1976).default,raw:r(1977)})),Object(m.a)(s.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Vertical Dividers"),Object(m.a)(s.a,{className:"mb-16",component:"div"},"You can also render a divider vertically using the ",Object(m.a)("code",null,"orientation")," prop. Note the use of the ",Object(m.a)("code",null,"flexItem")," prop to accommodate for the flex container."),Object(m.a)(s.a,{className:"mb-16",component:"div"},Object(m.a)(i.a,{className:"my-24",iframe:!1,component:r(1978).default,raw:r(1985)})))}}}]);