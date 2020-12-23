(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[121],{1413:function(e,t,a){"use strict";a.d(t,"b",(function(){return f})),a.d(t,"c",(function(){return b}));var c,r=a(22),n=a(8),s=a(16),l=a.n(s),i=a(37),o=a(13),u=a(51),p=a.n(u),d=a(48),f=Object(o.b)("academyApp/course/getCourse",function(){var e=Object(i.a)(l.a.mark((function e(t){var a,c;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,p.a.get("/api/academy-app/course",{params:t});case 2:return a=e.sent,e.next=5,a.data;case 5:return c=e.sent,e.abrupt("return",c);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),b=Object(o.b)("academyApp/course/updateCourse",function(){var e=Object(i.a)(l.a.mark((function e(t,a){var c,r,s,i,o;return l.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return c=a.getState,r=a.dispatch,s=c().academyApp.course.id,e.next=4,p.a.post("/api/academy-app/course/update",Object(n.a)({id:s},t));case 4:return i=e.sent,e.next=7,i.data;case 7:return o=e.sent,r(Object(d.c)({message:"Course Saved"})),e.abrupt("return",o);case 10:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),m=Object(o.d)({name:"academyApp/course",initialState:null,reducers:{},extraReducers:(c={},Object(r.a)(c,f.fulfilled,(function(e,t){return t.payload})),Object(r.a)(c,b.fulfilled,(function(e,t){return Object(n.a)(Object(n.a)({},e),t.payload)})),c)});t.a=m.reducer},1414:function(e,t,a){"use strict";a.d(t,"b",(function(){return u})),a.d(t,"c",(function(){return f}));var c=a(22),r=a(16),n=a.n(r),s=a(37),l=a(13),i=a(51),o=a.n(i),u=Object(l.b)("academyApp/categories/getCourses",Object(s.a)(n.a.mark((function e(){var t,a;return n.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,o.a.get("/api/academy-app/courses");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),p=Object(l.c)({}),d=p.getSelectors((function(e){return e.academyApp.courses})),f=d.selectAll,b=(d.selectById,Object(l.d)({name:"academyApp/courses",initialState:p.getInitialState({}),reducers:{},extraReducers:Object(c.a)({},u.fulfilled,p.setAll)}));t.a=b.reducer},1415:function(e,t,a){"use strict";a.d(t,"b",(function(){return u})),a.d(t,"c",(function(){return f}));var c=a(22),r=a(16),n=a.n(r),s=a(37),l=a(13),i=a(51),o=a.n(i),u=Object(l.b)("academyApp/categories/getCategories",Object(s.a)(n.a.mark((function e(){var t,a;return n.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,o.a.get("/api/academy-app/categories");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),p=Object(l.c)({}),d=p.getSelectors((function(e){return e.academyApp.categories})),f=d.selectAll,b=(d.selectById,Object(l.d)({name:"academyApp/categories",initialState:p.getInitialState({}),reducers:{},extraReducers:Object(c.a)({},u.fulfilled,p.setAll)}));t.a=b.reducer},1458:function(e,t,a){"use strict";var c=a(124),r=a(1413),n=a(1414),s=a(1415),l=Object(c.c)({categories:s.a,courses:n.a,course:r.a});t.a=l},1459:function(e,t,a){"use strict";var c=a(2),r=a(7),n=a(0),s=(a(5),a(3)),l=a(10),i=n.forwardRef((function(e,t){var a=e.disableSpacing,l=void 0!==a&&a,i=e.classes,o=e.className,u=Object(r.a)(e,["disableSpacing","classes","className"]);return n.createElement("div",Object(c.a)({className:Object(s.default)(i.root,o,!l&&i.spacing),ref:t},u))}));t.a=Object(l.a)({root:{display:"flex",alignItems:"center",padding:8},spacing:{"& > :not(:first-child)":{marginLeft:8}}},{name:"MuiCardActions"})(i)},2818:function(e,t,a){"use strict";a.r(t);var c=a(14),r=a(129),n=a(153),s=a(9),l=a(1170),i=a(1218),o=a(1459),u=a(1222),p=a(1217),d=a(678),f=a(547),b=a(680),m=a(677),j=a(1167),O=a(1137),x=a(685),y=a(1166),g=a(47),h=a(1174),v=a(169),w=a(258),N=a(3),S=a(0),A=a(6),k=a(31),C=a(1458),E=a(1415),I=a(1414),T=a(1),L=Object(y.a)((function(e){return{header:{background:"linear-gradient(to left, ".concat(e.palette.primary.dark," 0%, ").concat(e.palette.primary.main," 100%)"),color:e.palette.getContrastText(e.palette.primary.main)},headerIcon:{position:"absolute",top:-64,left:0,opacity:.04,fontSize:512,width:512,height:512,pointerEvents:"none"}}}));t.default=Object(w.a)("academyApp",C.a)((function(e){var t=Object(A.c)(),a=Object(A.d)(I.c),y=Object(A.d)(E.c),w=L(e),C=Object(g.a)(),M=Object(S.useState)(null),R=Object(c.a)(M,2),B=R[0],P=R[1],U=Object(S.useState)(""),D=Object(c.a)(U,2),J=D[0],W=D[1],z=Object(S.useState)("all"),F=Object(c.a)(z,2),Y=F[0],_=F[1];return Object(S.useEffect)((function(){t(Object(E.b)()),t(Object(I.b)())}),[t]),Object(S.useEffect)((function(){a&&P(0===J.length&&"all"===Y?a:s.a.filter(a,(function(e){return("all"===Y||e.category===Y)&&e.title.toLowerCase().includes(J.toLowerCase())})))}),[a,J,Y]),Object(T.a)("div",{className:"flex flex-col flex-auto flex-shrink-0 w-full"},Object(T.a)("div",{className:Object(N.default)(w.header,"relative overflow-hidden flex flex-col flex-shrink-0 items-center justify-center text-center p-16 sm:p-24 h-200 sm:h-288")},Object(T.a)(r.a,{animation:"transition.slideUpIn",duration:400,delay:100},Object(T.a)(v.a,{color:"inherit",className:"text-24 sm:text-40 font-light"},"WELCOME TO ACADEMY")),Object(T.a)(r.a,{duration:400,delay:600},Object(T.a)(v.a,{variant:"subtitle1",color:"inherit",className:"mt-8 sm:mt-16 mx-auto max-w-512"},Object(T.a)("span",{className:"opacity-75"},"Our courses will step you through the process of building a small application, or adding a new feature to an existing application."))),Object(T.a)(f.a,{className:w.headerIcon}," school ")),Object(T.a)("div",{className:"flex flex-col flex-1 max-w-2xl w-full mx-auto px-8 sm:px-16 py-24"},Object(T.a)("div",{className:"flex flex-col flex-shrink-0 sm:flex-row items-center justify-between py-24"},Object(T.a)(h.a,{label:"Search for a course",placeholder:"Enter a keyword...",className:"flex w-full sm:w-320 mb-16 sm:mb-0 mx-16",value:J,inputProps:{"aria-label":"Search"},onChange:function(e){W(e.target.value)},variant:"outlined",InputLabelProps:{shrink:!0}}),Object(T.a)(d.a,{className:"flex w-full sm:w-320 mx-16",variant:"outlined"},Object(T.a)(b.a,{htmlFor:"category-label-placeholder"}," Category "),Object(T.a)(x.a,{value:Y,onChange:function(e){_(e.target.value)},input:Object(T.a)(O.a,{labelWidth:9*"category".length,name:"category",id:"category-label-placeholder"})},Object(T.a)(j.a,{value:"all"},Object(T.a)("em",null," All ")),y.map((function(e){return Object(T.a)(j.a,{value:e.value,key:e.id},e.label)}))))),Object(S.useMemo)((function(){return B&&(B.length>0?Object(T.a)(n.a,{enter:{animation:"transition.slideUpBigIn"},className:"flex flex-wrap py-24"},B.map((function(e){var t=y.find((function(t){return t.value===e.category}));return Object(T.a)("div",{className:"w-full pb-24 sm:w-1/2 lg:w-1/3 sm:p-16",key:e.id},Object(T.a)(i.a,{elevation:1,className:"flex flex-col h-256 rounded-8"},Object(T.a)("div",{className:"flex flex-shrink-0 items-center justify-between px-24 h-64",style:{background:t.color,color:C.palette.getContrastText(t.color)}},Object(T.a)(v.a,{className:"font-medium truncate",color:"inherit"},t.label),Object(T.a)("div",{className:"flex items-center justify-center opacity-75"},Object(T.a)(f.a,{className:"text-20 mx-8",color:"inherit"},"access_time"),Object(T.a)("div",{className:"text-16 whitespace-no-wrap"},e.length,"min"))),Object(T.a)(u.a,{className:"flex flex-col flex-auto items-center justify-center"},Object(T.a)(v.a,{className:"text-center text-16 font-400"},e.title),Object(T.a)(v.a,{className:"text-center text-13 font-600 mt-4",color:"textSecondary"},e.updated)),Object(T.a)(p.a,null),Object(T.a)(o.a,{className:"justify-center"},Object(T.a)(l.a,{to:"/apps/academy/courses/".concat(e.id,"/").concat(e.slug),component:k.a,className:"justify-start px-32",color:"secondary"},function(e){switch(e.activeStep){case e.totalSteps:return"COMPLETED";case 0:return"START";default:return"CONTINUE"}}(e))),Object(T.a)(m.a,{className:"w-full",variant:"determinate",value:100*e.activeStep/e.totalSteps,color:"secondary"})))}))):Object(T.a)("div",{className:"flex flex-1 items-center justify-center"},Object(T.a)(v.a,{color:"textSecondary",className:"text-24 my-24"},"No courses found!")))}),[y,B,C.palette])))}))}}]);