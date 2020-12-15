(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[76],{1233:function(e,n,t){"use strict";t.d(n,"a",(function(){return M}));var a=t(14),i=t(140),r=t(1211),l=t(1218),o=t(547),m=t(1224),c=t(1225),p=t(0),u=t.n(p),T=t(18),s=t(8),b=t(86),O=t(87),j=t(150),f=t(149),d=t(1121),y=t(643),C=t(1158),h=t(1210),S=t(10),g=t(420),v=t(421),I=t(1234),D=t.n(I),N=t(1),x=Object(d.a)({productionPrefix:"iframe-"}),R=function(e){Object(j.a)(t,e);var n=Object(f.a)(t);function t(){var e;Object(b.a)(this,t);for(var a=arguments.length,i=new Array(a),r=0;r<a;r++)i[r]=arguments[r];return(e=n.call.apply(n,[this].concat(i))).state={ready:!1},e.handleRef=function(n){e.contentDocument=n?n.node.contentDocument:null},e.onContentDidMount=function(){e.setState({ready:!0,jss:Object(g.a)(Object(s.a)(Object(s.a)({},Object(y.a)()),{},{plugins:[].concat(Object(T.a)(Object(y.a)().plugins),[Object(v.a)()]),insertionPoint:e.contentDocument.querySelector("#jss-demo-insertion-point")})),sheetsManager:new Map,container:e.contentDocument.body})},e.onContentDidUpdate=function(){e.contentDocument.body.dir=e.props.theme.direction},e.renderHead=function(){return Object(N.a)(u.a.Fragment,null,Object(N.a)("style",{dangerouslySetInnerHTML:{__html:"\n                    html {\n                    font-size: 62.5%;\n                    font-family: Muli, Roboto, Helvetica Neue, Arial, sans-serif;\n                    }\n                "}}),Object(N.a)("noscript",{id:"jss-demo-insertion-point"}))},e}return Object(O.a)(t,[{key:"render",value:function(){var e=this.props,n=e.children,t=e.classes,a=e.theme;return Object(N.a)(D.a,{head:this.renderHead(),ref:this.handleRef,className:t.root,contentDidMount:this.onContentDidMount,contentDidUpdate:this.onContentDidUpdate},this.state.ready?Object(N.a)(C.b,{jss:this.state.jss,generateClassName:x,sheetsManager:this.state.sheetsManager},Object(N.a)(h.a,{theme:a},u.a.cloneElement(n,{container:this.state.container}))):null)}}]),t}(u.a.Component),w=Object(S.a)((function(e){return{root:{backgroundColor:e.palette.background.default,flexGrow:1,height:400,border:"none",boxShadow:e.shadows[1]}}}),{withTheme:!0})(R);function E(e){var n=Object(p.useState)(e.currentTabIndex),t=Object(a.a)(n,2),u=t[0],T=t[1],s=e.component,b=e.raw,O=e.iframe,j=e.className;return Object(N.a)(l.a,{className:j},Object(N.a)(r.a,{position:"static",color:"default",elevation:0},Object(N.a)(c.a,{classes:{root:"border-b-1",flexContainer:"justify-end"},value:u,onChange:function(e,n){T(n)}},s&&Object(N.a)(m.a,{classes:{root:"min-w-64"},icon:Object(N.a)(o.a,null,"remove_red_eye")}),b&&Object(N.a)(m.a,{classes:{root:"min-w-64"},icon:Object(N.a)(o.a,null,"code")}))),Object(N.a)("div",{className:"flex justify-center max-w-full"},Object(N.a)("div",{className:0===u?"flex flex-1 max-w-full":"hidden"},s&&(O?Object(N.a)(w,null,Object(N.a)(s,null)):Object(N.a)("div",{className:"p-24 flex flex-1 justify-center max-w-full"},Object(N.a)(s,null)))),Object(N.a)("div",{className:1===u?"flex flex-1":"hidden"},b&&Object(N.a)("div",{className:"flex flex-1"},Object(N.a)(i.a,{component:"pre",className:"language-javascript w-full"},b.default)))))}E.defaultProps={currentTabIndex:0};var M=E},2452:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));t(0);var a=t(2899),i=t(2900),r=t(2901),l=t(2903),o=t(2904),m=t(2902),c=t(1);function p(){return Object(c.a)(a.a,null,Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Eat")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Code")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null)),Object(c.a)(o.a,null,"Sleep")))}},2453:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\n\r\nexport default function BasicTimeline() {\r\n  return (\r\n    <Timeline>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Eat</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Code</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Sleep</TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n"},2454:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));t(0);var a=t(2899),i=t(2900),r=t(2901),l=t(2903),o=t(2904),m=t(2902),c=t(1);function p(){return Object(c.a)(a.a,{align:"right"},Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Eat")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Code")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Sleep")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null)),Object(c.a)(o.a,null,"Repeat")))}},2455:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\n\r\nexport default function RightAlignedTimeline() {\r\n  return (\r\n    <Timeline align=\"right\">\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Eat</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Code</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Sleep</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Repeat</TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n"},2456:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));t(0);var a=t(2899),i=t(2900),r=t(2901),l=t(2903),o=t(2904),m=t(2902),c=t(1);function p(){return Object(c.a)(a.a,{align:"alternate"},Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Eat")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Code")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Sleep")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null)),Object(c.a)(o.a,null,"Repeat")))}},2457:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\n\r\nexport default function AlternateTimeline() {\r\n  return (\r\n    <Timeline align=\"alternate\">\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Eat</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Code</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Sleep</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Repeat</TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n"},2458:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));t(0);var a=t(2899),i=t(2900),r=t(2901),l=t(2903),o=t(2904),m=t(2902),c=t(1);function p(){return Object(c.a)(a.a,{align:"alternate"},Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Eat")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{color:"primary"}),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Code")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{color:"secondary"}),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Sleep")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,null)),Object(c.a)(o.a,null,"Repeat")))}},2459:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\n\r\nexport default function ColorsTimeline() {\r\n  return (\r\n    <Timeline align=\"alternate\">\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Eat</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot color=\"primary\" />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Code</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot color=\"secondary\" />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Sleep</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Repeat</TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n"},2460:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return p}));t(0);var a=t(2899),i=t(2900),r=t(2901),l=t(2903),o=t(2904),m=t(2902),c=t(1);function p(){return Object(c.a)(a.a,{align:"alternate"},Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{variant:"outlined"}),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Eat")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{variant:"outlined",color:"primary"}),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Code")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{variant:"outlined",color:"secondary"}),Object(c.a)(l.a,null)),Object(c.a)(o.a,null,"Sleep")),Object(c.a)(i.a,null,Object(c.a)(r.a,null,Object(c.a)(m.a,{variant:"outlined"})),Object(c.a)(o.a,null,"Repeat")))}},2461:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\n\r\nexport default function OutlinedTimeline() {\r\n  return (\r\n    <Timeline align=\"alternate\">\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot variant=\"outlined\" />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Eat</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot variant=\"outlined\" color=\"primary\" />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Code</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot variant=\"outlined\" color=\"secondary\" />\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Sleep</TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot variant=\"outlined\" />\r\n        </TimelineSeparator>\r\n        <TimelineContent>Repeat</TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n"},2462:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return b}));var a=t(0),i=t.n(a),r=t(2899),l=t(2900),o=t(2901),m=t(2903),c=t(2904),p=t(2902),u=t(2905),T=t(169),s=t(1);function b(){return Object(s.a)(i.a.Fragment,null,Object(s.a)(r.a,{align:"alternate"},Object(s.a)(l.a,null,Object(s.a)(u.a,null,Object(s.a)(T.a,{color:"textSecondary"},"09:30 am")),Object(s.a)(o.a,null,Object(s.a)(p.a,null),Object(s.a)(m.a,null)),Object(s.a)(c.a,null,Object(s.a)(T.a,null,"Eat"))),Object(s.a)(l.a,null,Object(s.a)(u.a,null,Object(s.a)(T.a,{color:"textSecondary"},"10:00 am")),Object(s.a)(o.a,null,Object(s.a)(p.a,null),Object(s.a)(m.a,null)),Object(s.a)(c.a,null,Object(s.a)(T.a,null,"Code"))),Object(s.a)(l.a,null,Object(s.a)(u.a,null,Object(s.a)(T.a,{color:"textSecondary"},"12:00 am")),Object(s.a)(o.a,null,Object(s.a)(p.a,null),Object(s.a)(m.a,null)),Object(s.a)(c.a,null,Object(s.a)(T.a,null,"Sleep"))),Object(s.a)(l.a,null,Object(s.a)(u.a,null,Object(s.a)(T.a,{color:"textSecondary"},"9:00 am")),Object(s.a)(o.a,null,Object(s.a)(p.a,null),Object(s.a)(m.a,null)),Object(s.a)(c.a,null,Object(s.a)(T.a,null,"Repeat")))))}},2463:function(e,n,t){"use strict";t.r(n),n.default="import React from 'react';\r\nimport Timeline from '@material-ui/lab/Timeline';\r\nimport TimelineItem from '@material-ui/lab/TimelineItem';\r\nimport TimelineSeparator from '@material-ui/lab/TimelineSeparator';\r\nimport TimelineConnector from '@material-ui/lab/TimelineConnector';\r\nimport TimelineContent from '@material-ui/lab/TimelineContent';\r\nimport TimelineDot from '@material-ui/lab/TimelineDot';\r\nimport TimelineOppositeContent from '@material-ui/lab/TimelineOppositeContent';\r\nimport Typography from '@material-ui/core/Typography';\r\n\r\nexport default function OppositeContentTimeline() {\r\n  return (\r\n    <React.Fragment>\r\n      <Timeline align=\"alternate\">\r\n        <TimelineItem>\r\n          <TimelineOppositeContent>\r\n            <Typography color=\"textSecondary\">09:30 am</Typography>\r\n          </TimelineOppositeContent>\r\n          <TimelineSeparator>\r\n            <TimelineDot />\r\n            <TimelineConnector />\r\n          </TimelineSeparator>\r\n          <TimelineContent>\r\n            <Typography>Eat</Typography>\r\n          </TimelineContent>\r\n        </TimelineItem>\r\n        <TimelineItem>\r\n          <TimelineOppositeContent>\r\n            <Typography color=\"textSecondary\">10:00 am</Typography>\r\n          </TimelineOppositeContent>\r\n          <TimelineSeparator>\r\n            <TimelineDot />\r\n            <TimelineConnector />\r\n          </TimelineSeparator>\r\n          <TimelineContent>\r\n            <Typography>Code</Typography>\r\n          </TimelineContent>\r\n        </TimelineItem>\r\n        <TimelineItem>\r\n          <TimelineOppositeContent>\r\n            <Typography color=\"textSecondary\">12:00 am</Typography>\r\n          </TimelineOppositeContent>\r\n          <TimelineSeparator>\r\n            <TimelineDot />\r\n            <TimelineConnector />\r\n          </TimelineSeparator>\r\n          <TimelineContent>\r\n            <Typography>Sleep</Typography>\r\n          </TimelineContent>\r\n        </TimelineItem>\r\n        <TimelineItem>\r\n          <TimelineOppositeContent>\r\n            <Typography color=\"textSecondary\">9:00 am</Typography>\r\n          </TimelineOppositeContent>\r\n          <TimelineSeparator>\r\n            <TimelineDot />\r\n            <TimelineConnector />\r\n          </TimelineSeparator>\r\n          <TimelineContent>\r\n            <Typography>Repeat</Typography>\r\n          </TimelineContent>\r\n        </TimelineItem>\r\n      </Timeline>\r\n    </React.Fragment>\r\n  );\r\n}\r\n"},2464:function(e,n,t){"use strict";t.r(n),t.d(n,"default",(function(){return g}));t(0);var a=t(1166),i=t(2899),r=t(2900),l=t(2901),o=t(2903),m=t(2904),c=t(2905),p=t(2902),u=t(2465),T=t.n(u),s=t(2466),b=t.n(s),O=t(2467),j=t.n(O),f=t(2468),d=t.n(f),y=t(221),C=t(169),h=t(1),S=Object(a.a)((function(e){return{paper:{padding:"6px 16px"},secondaryTail:{backgroundColor:e.palette.secondary.main}}}));function g(){var e=S();return Object(h.a)(i.a,{align:"alternate"},Object(h.a)(r.a,null,Object(h.a)(c.a,null,Object(h.a)(C.a,{variant:"body2",color:"textSecondary"},"9:30 am")),Object(h.a)(l.a,null,Object(h.a)(p.a,null,Object(h.a)(T.a,null)),Object(h.a)(o.a,null)),Object(h.a)(m.a,null,Object(h.a)(y.a,{elevation:3,className:e.paper},Object(h.a)(C.a,{variant:"h6",component:"h1"},"Eat"),Object(h.a)(C.a,null,"Because you need strength")))),Object(h.a)(r.a,null,Object(h.a)(c.a,null,Object(h.a)(C.a,{variant:"body2",color:"textSecondary"},"10:00 am")),Object(h.a)(l.a,null,Object(h.a)(p.a,{color:"primary"},Object(h.a)(b.a,null)),Object(h.a)(o.a,null)),Object(h.a)(m.a,null,Object(h.a)(y.a,{elevation:3,className:e.paper},Object(h.a)(C.a,{variant:"h6",component:"h1"},"Code"),Object(h.a)(C.a,null,"Because it's awesome!")))),Object(h.a)(r.a,null,Object(h.a)(l.a,null,Object(h.a)(p.a,{color:"primary",variant:"outlined"},Object(h.a)(j.a,null)),Object(h.a)(o.a,{className:e.secondaryTail})),Object(h.a)(m.a,null,Object(h.a)(y.a,{elevation:3,className:e.paper},Object(h.a)(C.a,{variant:"h6",component:"h1"},"Sleep"),Object(h.a)(C.a,null,"Because you need rest")))),Object(h.a)(r.a,null,Object(h.a)(l.a,null,Object(h.a)(p.a,{color:"secondary"},Object(h.a)(d.a,null))),Object(h.a)(m.a,null,Object(h.a)(y.a,{elevation:3,className:e.paper},Object(h.a)(C.a,{variant:"h6",component:"h1"},"Repeat"),Object(h.a)(C.a,null,"Because this is the life you love!")))))}},2469:function(e,n,t){"use strict";t.r(n),n.default='import React from \'react\';\r\nimport { makeStyles } from \'@material-ui/core/styles\';\r\nimport Timeline from \'@material-ui/lab/Timeline\';\r\nimport TimelineItem from \'@material-ui/lab/TimelineItem\';\r\nimport TimelineSeparator from \'@material-ui/lab/TimelineSeparator\';\r\nimport TimelineConnector from \'@material-ui/lab/TimelineConnector\';\r\nimport TimelineContent from \'@material-ui/lab/TimelineContent\';\r\nimport TimelineOppositeContent from \'@material-ui/lab/TimelineOppositeContent\';\r\nimport TimelineDot from \'@material-ui/lab/TimelineDot\';\r\nimport FastfoodIcon from \'@material-ui/icons/Fastfood\';\r\nimport LaptopMacIcon from \'@material-ui/icons/LaptopMac\';\r\nimport HotelIcon from \'@material-ui/icons/Hotel\';\r\nimport RepeatIcon from \'@material-ui/icons/Repeat\';\r\nimport Paper from \'@material-ui/core/Paper\';\r\nimport Typography from \'@material-ui/core/Typography\';\r\n\r\nconst useStyles = makeStyles((theme) => ({\r\n  paper: {\r\n    padding: \'6px 16px\',\r\n  },\r\n  secondaryTail: {\r\n    backgroundColor: theme.palette.secondary.main,\r\n  },\r\n}));\r\n\r\nexport default function CustomizedTimeline() {\r\n  const classes = useStyles();\r\n\r\n  return (\r\n    <Timeline align="alternate">\r\n      <TimelineItem>\r\n        <TimelineOppositeContent>\r\n          <Typography variant="body2" color="textSecondary">\r\n            9:30 am\r\n          </Typography>\r\n        </TimelineOppositeContent>\r\n        <TimelineSeparator>\r\n          <TimelineDot>\r\n            <FastfoodIcon />\r\n          </TimelineDot>\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>\r\n          <Paper elevation={3} className={classes.paper}>\r\n            <Typography variant="h6" component="h1">\r\n              Eat\r\n            </Typography>\r\n            <Typography>Because you need strength</Typography>\r\n          </Paper>\r\n        </TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineOppositeContent>\r\n          <Typography variant="body2" color="textSecondary">\r\n            10:00 am\r\n          </Typography>\r\n        </TimelineOppositeContent>\r\n        <TimelineSeparator>\r\n          <TimelineDot color="primary">\r\n            <LaptopMacIcon />\r\n          </TimelineDot>\r\n          <TimelineConnector />\r\n        </TimelineSeparator>\r\n        <TimelineContent>\r\n          <Paper elevation={3} className={classes.paper}>\r\n            <Typography variant="h6" component="h1">\r\n              Code\r\n            </Typography>\r\n            <Typography>Because it&apos;s awesome!</Typography>\r\n          </Paper>\r\n        </TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot color="primary" variant="outlined">\r\n            <HotelIcon />\r\n          </TimelineDot>\r\n          <TimelineConnector className={classes.secondaryTail} />\r\n        </TimelineSeparator>\r\n        <TimelineContent>\r\n          <Paper elevation={3} className={classes.paper}>\r\n            <Typography variant="h6" component="h1">\r\n              Sleep\r\n            </Typography>\r\n            <Typography>Because you need rest</Typography>\r\n          </Paper>\r\n        </TimelineContent>\r\n      </TimelineItem>\r\n      <TimelineItem>\r\n        <TimelineSeparator>\r\n          <TimelineDot color="secondary">\r\n            <RepeatIcon />\r\n          </TimelineDot>\r\n        </TimelineSeparator>\r\n        <TimelineContent>\r\n          <Paper elevation={3} className={classes.paper}>\r\n            <Typography variant="h6" component="h1">\r\n              Repeat\r\n            </Typography>\r\n            <Typography>Because this is the life you love!</Typography>\r\n          </Paper>\r\n        </TimelineContent>\r\n      </TimelineItem>\r\n    </Timeline>\r\n  );\r\n}\r\n'},2898:function(e,n,t){"use strict";t.r(n);var a=t(0),i=t.n(a),r=t(1233),l=(t(140),t(1170)),o=t(547),m=t(169),c=t(1166),p=t(1),u=Object(c.a)((function(e){return{layoutRoot:{"& .description":{marginBottom:16}}}}));n.default=function(e){return u(),Object(p.a)(i.a.Fragment,null,Object(p.a)("div",{className:"flex flex-1 flex-grow-0 items-center justify-end"},Object(p.a)(l.a,{className:"normal-case",variant:"outlined",component:"a",href:"https://material-ui.com/components/timeline",target:"_blank",role:"button"},Object(p.a)(o.a,null,"link"),Object(p.a)("span",{className:"mx-4"},"Reference"))),Object(p.a)(m.a,{className:"text-44 mt-32 mb-8",component:"h1"},"Timeline"),Object(p.a)(m.a,{className:"description"},"The timeline displays a list of events in chronological order."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)("strong",null,"Note:")," This component is not documented in the ",Object(p.a)("a",{href:"https://material.io/"},"Material Design guidelines"),", but Material-UI supports it."),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Basic timeline"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"A basic timeline showing list of events."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2452).default,raw:t(2453)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Right aligned timeline"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"The timeline can be positioned on the right side of the events."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2454).default,raw:t(2455)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Alternating timeline"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"The timeline can display the events on alternating sides."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2456).default,raw:t(2457)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Color"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"The ",Object(p.a)("code",null,"TimelineDot")," can appear in different colors."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2458).default,raw:t(2459)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Outlined"),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2460).default,raw:t(2461)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Opposite content"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"The timeline can display content on opposite sides."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2462).default,raw:t(2463)})),Object(p.a)(m.a,{className:"text-32 mt-32 mb-8",component:"h2"},"Customized timeline"),Object(p.a)(m.a,{className:"mb-16",component:"div"},"Here is an example of customizing the component. You can learn more about this in the",Object(p.a)("a",{href:"/customization/components/"},"overrides documentation page"),"."),Object(p.a)(m.a,{className:"mb-16",component:"div"},Object(p.a)(r.a,{className:"my-24",iframe:!1,component:t(2464).default,raw:t(2469)})))}}}]);