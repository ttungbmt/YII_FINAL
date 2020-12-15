(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[99],{1413:function(e,t,a){"use strict";a.d(t,"b",(function(){return b})),a.d(t,"c",(function(){return m}));var r,n=a(22),c=a(8),l=a(16),i=a.n(l),o=a(37),s=a(13),d=a(51),p=a.n(d),u=a(48),b=Object(s.b)("academyApp/course/getCourse",function(){var e=Object(o.a)(i.a.mark((function e(t){var a,r;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,p.a.get("/api/academy-app/course",{params:t});case 2:return a=e.sent,e.next=5,a.data;case 5:return r=e.sent,e.abrupt("return",r);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),m=Object(s.b)("academyApp/course/updateCourse",function(){var e=Object(o.a)(i.a.mark((function e(t,a){var r,n,l,o,s;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=a.getState,n=a.dispatch,l=r().academyApp.course.id,e.next=4,p.a.post("/api/academy-app/course/update",Object(c.a)({id:l},t));case 4:return o=e.sent,e.next=7,o.data;case 7:return s=e.sent,n(Object(u.c)({message:"Course Saved"})),e.abrupt("return",s);case 10:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),f=Object(s.d)({name:"academyApp/course",initialState:null,reducers:{},extraReducers:(r={},Object(n.a)(r,b.fulfilled,(function(e,t){return t.payload})),Object(n.a)(r,m.fulfilled,(function(e,t){return Object(c.a)(Object(c.a)({},e),t.payload)})),r)});t.a=f.reducer},1414:function(e,t,a){"use strict";a.d(t,"b",(function(){return d})),a.d(t,"c",(function(){return b}));var r=a(22),n=a(16),c=a.n(n),l=a(37),i=a(13),o=a(51),s=a.n(o),d=Object(i.b)("academyApp/categories/getCourses",Object(l.a)(c.a.mark((function e(){var t,a;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.a.get("/api/academy-app/courses");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),p=Object(i.c)({}),u=p.getSelectors((function(e){return e.academyApp.courses})),b=u.selectAll,m=(u.selectById,Object(i.d)({name:"academyApp/courses",initialState:p.getInitialState({}),reducers:{},extraReducers:Object(r.a)({},d.fulfilled,p.setAll)}));t.a=m.reducer},1415:function(e,t,a){"use strict";a.d(t,"b",(function(){return d})),a.d(t,"c",(function(){return b}));var r=a(22),n=a(16),c=a.n(n),l=a(37),i=a(13),o=a(51),s=a.n(o),d=Object(i.b)("academyApp/categories/getCategories",Object(l.a)(c.a.mark((function e(){var t,a;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.a.get("/api/academy-app/categories");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),p=Object(i.c)({}),u=p.getSelectors((function(e){return e.academyApp.categories})),b=u.selectAll,m=(u.selectById,Object(i.d)({name:"academyApp/categories",initialState:p.getInitialState({}),reducers:{},extraReducers:Object(r.a)({},d.fulfilled,p.setAll)}));t.a=m.reducer},1458:function(e,t,a){"use strict";var r=a(124),n=a(1413),c=a(1414),l=a(1415),i=Object(r.c)({categories:l.a,courses:c.a,course:n.a});t.a=i},1543:function(e,t,a){"use strict";var r=a(2),n=a(7),c=a(0),l=(a(5),a(3)),i=a(10),o=a(221),s=a(1544),d=c.createElement(s.a,null),p=c.forwardRef((function(e,t){var a=e.activeStep,i=void 0===a?0:a,s=e.alternativeLabel,p=void 0!==s&&s,u=e.children,b=e.classes,m=e.className,f=e.connector,v=void 0===f?d:f,j=e.nonLinear,O=void 0!==j&&j,x=e.orientation,h=void 0===x?"horizontal":x,y=Object(n.a)(e,["activeStep","alternativeLabel","children","classes","className","connector","nonLinear","orientation"]),g=c.isValidElement(v)?c.cloneElement(v,{orientation:h}):null,S=c.Children.toArray(u),L=S.map((function(e,t){var a={index:t,active:!1,completed:!1,disabled:!1};return i===t?a.active=!0:!O&&i>t?a.completed=!0:!O&&i<t&&(a.disabled=!0),c.cloneElement(e,Object(r.a)({alternativeLabel:p,connector:g,last:t+1===S.length,orientation:h},a,e.props))}));return c.createElement(o.a,Object(r.a)({square:!0,elevation:0,className:Object(l.default)(b.root,b[h],m,p&&b.alternativeLabel),ref:t},y),L)}));t.a=Object(i.a)({root:{display:"flex",padding:24},horizontal:{flexDirection:"row",alignItems:"center"},vertical:{flexDirection:"column"},alternativeLabel:{alignItems:"flex-start"}},{name:"MuiStepper"})(p)},1544:function(e,t,a){"use strict";var r=a(2),n=a(7),c=a(0),l=(a(5),a(3)),i=a(10),o=c.forwardRef((function(e,t){var a=e.active,i=e.alternativeLabel,o=void 0!==i&&i,s=e.classes,d=e.className,p=e.completed,u=e.disabled,b=(e.index,e.orientation),m=void 0===b?"horizontal":b,f=Object(n.a)(e,["active","alternativeLabel","classes","className","completed","disabled","index","orientation"]);return c.createElement("div",Object(r.a)({className:Object(l.default)(s.root,s[m],d,o&&s.alternativeLabel,a&&s.active,p&&s.completed,u&&s.disabled),ref:t},f),c.createElement("span",{className:Object(l.default)(s.line,{horizontal:s.lineHorizontal,vertical:s.lineVertical}[m])}))}));t.a=Object(i.a)((function(e){return{root:{flex:"1 1 auto"},horizontal:{},vertical:{marginLeft:12,padding:"0 0 8px"},alternativeLabel:{position:"absolute",top:12,left:"calc(-50% + 20px)",right:"calc(50% + 20px)"},active:{},completed:{},disabled:{},line:{display:"block",borderColor:"light"===e.palette.type?e.palette.grey[400]:e.palette.grey[600]},lineHorizontal:{borderTopStyle:"solid",borderTopWidth:1},lineVertical:{borderLeftStyle:"solid",borderLeftWidth:1,minHeight:24}}}),{name:"MuiStepConnector"})(o)},1545:function(e,t,a){"use strict";var r=a(2),n=a(7),c=a(0),l=(a(119),a(5),a(3)),i=a(10),o=c.forwardRef((function(e,t){var a=e.active,i=void 0!==a&&a,o=e.alternativeLabel,s=e.children,d=e.classes,p=e.className,u=e.completed,b=void 0!==u&&u,m=e.connector,f=e.disabled,v=void 0!==f&&f,j=e.expanded,O=void 0!==j&&j,x=e.index,h=e.last,y=e.orientation,g=Object(n.a)(e,["active","alternativeLabel","children","classes","className","completed","connector","disabled","expanded","index","last","orientation"]),S=m?c.cloneElement(m,{orientation:y,alternativeLabel:o,index:x,active:i,completed:b,disabled:v}):null,L=c.createElement("div",Object(r.a)({className:Object(l.default)(d.root,d[y],p,o&&d.alternativeLabel,b&&d.completed),ref:t},g),S&&o&&0!==x?S:null,c.Children.map(s,(function(e){return c.isValidElement(e)?c.cloneElement(e,Object(r.a)({active:i,alternativeLabel:o,completed:b,disabled:v,expanded:O,last:h,icon:x+1,orientation:y},e.props)):null})));return S&&!o&&0!==x?c.createElement(c.Fragment,null,S,L):L}));t.a=Object(i.a)({root:{},horizontal:{paddingLeft:8,paddingRight:8},vertical:{},alternativeLabel:{flex:1,position:"relative"},completed:{}},{name:"MuiStep"})(o)},1546:function(e,t,a){"use strict";var r=a(2),n=a(7),c=a(0),l=(a(5),a(3)),i=a(10),o=a(169),s=a(1640),d=c.forwardRef((function(e,t){var a=e.active,i=void 0!==a&&a,d=e.alternativeLabel,p=void 0!==d&&d,u=e.children,b=e.classes,m=e.className,f=e.completed,v=void 0!==f&&f,j=e.disabled,O=void 0!==j&&j,x=e.error,h=void 0!==x&&x,y=(e.expanded,e.icon),g=(e.last,e.optional),S=e.orientation,L=void 0===S?"horizontal":S,N=e.StepIconComponent,w=e.StepIconProps,E=Object(n.a)(e,["active","alternativeLabel","children","classes","className","completed","disabled","error","expanded","icon","last","optional","orientation","StepIconComponent","StepIconProps"]),C=N;return y&&!C&&(C=s.a),c.createElement("span",Object(r.a)({className:Object(l.default)(b.root,b[L],m,O&&b.disabled,p&&b.alternativeLabel,h&&b.error),ref:t},E),y||C?c.createElement("span",{className:Object(l.default)(b.iconContainer,p&&b.alternativeLabel)},c.createElement(C,Object(r.a)({completed:v,active:i,error:h,icon:y},w))):null,c.createElement("span",{className:b.labelContainer},u?c.createElement(o.a,{variant:"body2",component:"span",display:"block",className:Object(l.default)(b.label,p&&b.alternativeLabel,v&&b.completed,i&&b.active,h&&b.error)},u):null,g))}));d.muiName="StepLabel",t.a=Object(i.a)((function(e){return{root:{display:"flex",alignItems:"center","&$alternativeLabel":{flexDirection:"column"},"&$disabled":{cursor:"default"}},horizontal:{},vertical:{},label:{color:e.palette.text.secondary,"&$active":{color:e.palette.text.primary,fontWeight:500},"&$completed":{color:e.palette.text.primary,fontWeight:500},"&$alternativeLabel":{textAlign:"center",marginTop:16},"&$error":{color:e.palette.error.main}},active:{},completed:{},error:{},disabled:{},iconContainer:{flexShrink:0,display:"flex",paddingRight:8,"&$alternativeLabel":{paddingRight:0}},alternativeLabel:{},labelContainer:{width:"100%"}}}),{name:"MuiStepLabel"})(d)},1640:function(e,t,a){"use strict";var r=a(0),n=(a(5),a(3)),c=a(66),l=Object(c.a)(r.createElement("path",{d:"M12 0a12 12 0 1 0 0 24 12 12 0 0 0 0-24zm-2 17l-5-5 1.4-1.4 3.6 3.6 7.6-7.6L19 8l-9 9z"}),"CheckCircle"),i=Object(c.a)(r.createElement("path",{d:"M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"}),"Warning"),o=a(10),s=a(419),d=r.createElement("circle",{cx:"12",cy:"12",r:"12"}),p=r.forwardRef((function(e,t){var a=e.completed,c=void 0!==a&&a,o=e.icon,p=e.active,u=void 0!==p&&p,b=e.error,m=void 0!==b&&b,f=e.classes;if("number"===typeof o||"string"===typeof o){var v=Object(n.default)(f.root,u&&f.active,m&&f.error,c&&f.completed);return m?r.createElement(i,{className:v,ref:t}):c?r.createElement(l,{className:v,ref:t}):r.createElement(s.a,{className:v,ref:t},d,r.createElement("text",{className:f.text,x:"12",y:"16",textAnchor:"middle"},o))}return o}));t.a=Object(o.a)((function(e){return{root:{display:"block",color:e.palette.text.disabled,"&$completed":{color:e.palette.primary.main},"&$active":{color:e.palette.primary.main},"&$error":{color:e.palette.error.main}},text:{fill:e.palette.primary.contrastText,fontSize:e.typography.caption.fontSize,fontFamily:e.typography.fontFamily},active:{},completed:{},error:{}}}),{name:"MuiStepIcon"})(p)},2817:function(e,t,a){"use strict";a.r(t);var r=a(189),n=a(35),c=a(208),l=a(1212),i=a(1177),o=a(547),s=a(399),d=a(221),p=a(1545),u=a(1546),b=a(1543),m=a(1166),f=a(47),v=a(169),j=a(258),O=a(0),x=a(6),h=a(52),y=a(31),g=a(151),S=a(1410),L=a.n(S),N=a(1458),w=a(1413),E=a(1),C=Object(m.a)((function(e){return{stepLabel:{cursor:"pointer!important"},successFab:{background:"".concat(c.a[500],"!important"),color:"white!important"}}}));t.default=Object(j.a)("academyApp",N.a)((function(e){var t=Object(x.c)(),a=Object(x.d)((function(e){return e.academyApp.course})),c=Object(f.a)(),m=Object(h.j)(),j=C(e),S=Object(O.useRef)(null);function N(e){t(Object(w.c)({activeStep:e+1}))}Object(g.b)((function(){t(Object(w.b)(m))}),[t,m]),Object(O.useEffect)((function(){a&&0===a.activeStep&&t(Object(w.c)({activeStep:1}))}),[t,a]);var k=a&&0!==a.activeStep?a.activeStep:1;return Object(E.a)(r.a,{classes:{content:"flex flex-col flex-auto overflow-hidden",header:"h-72 min-h-72"},header:Object(E.a)("div",{className:"flex flex-1 items-center px-16 lg:px-24"},Object(E.a)(i.a,{lgUp:!0},Object(E.a)(s.a,{onClick:function(e){return S.current.toggleLeftSidebar()},"aria-label":"open left sidebar"},Object(E.a)(o.a,null,"menu"))),Object(E.a)(s.a,{to:"/apps/academy/courses",component:y.a},Object(E.a)(o.a,null,"ltr"===c.direction?"arrow_back":"arrow_forward")),a&&Object(E.a)(v.a,{className:"flex-1 text-20 mx-16"},a.title)),content:a&&Object(E.a)("div",{className:"flex flex-1 relative overflow-hidden"},Object(E.a)(n.a,{className:"w-full overflow-auto"},Object(E.a)(L.a,{className:"overflow-hidden",index:k-1,enableMouseEvents:!0,onChangeIndex:N},a.steps.map((function(e,t){return Object(E.a)("div",{className:"flex justify-center p-16 pb-64 sm:p-24 sm:pb-64 md:p-48 md:pb-64",key:e.id},Object(E.a)(d.a,{className:"w-full max-w-lg rounded-8 p-16 md:p-24",elevation:1},Object(E.a)("div",{dangerouslySetInnerHTML:{__html:e.content},dir:c.direction})))})))),Object(E.a)("div",{className:"flex justify-center w-full absolute left-0 right-0 bottom-0 pb-16 md:pb-32"},Object(E.a)("div",{className:"flex justify-between w-full max-w-xl px-8"},Object(E.a)("div",null,1!==k&&Object(E.a)(l.a,{className:"",color:"secondary",onClick:function(){t(Object(w.c)({activeStep:a.activeStep-1}))}},Object(E.a)(o.a,null,"ltr"===c.direction?"chevron_left":"chevron_right"))),Object(E.a)("div",null,k<a.steps.length?Object(E.a)(l.a,{className:"",color:"secondary",onClick:function(){t(Object(w.c)({activeStep:a.activeStep+1}))}},Object(E.a)(o.a,null,"ltr"===c.direction?"chevron_right":"chevron_left")):Object(E.a)(l.a,{className:j.successFab,to:"/apps/academy/courses",component:y.a},Object(E.a)(o.a,null,"check")))))),leftSidebarContent:a&&Object(E.a)(b.a,{classes:{root:"bg-transparent"},activeStep:k-1,orientation:"vertical"},a.steps.map((function(e,t){return Object(E.a)(p.a,{key:e.id,onClick:function(){return N(t)}},Object(E.a)(u.a,{classes:{root:j.stepLabel}},e.title))}))),innerScroll:!0,ref:S})}))}}]);