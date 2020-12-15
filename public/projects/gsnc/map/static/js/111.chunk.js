(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[111],{1239:function(e,t,a){"use strict";var c=a(0),n=c.createContext();t.a=n},1253:function(e,t,a){"use strict";var c=a(0),n=c.createContext();t.a=n},1306:function(e,t,a){"use strict";var c=a(7),n=a(2),l=a(0),r=(a(5),a(3)),s=a(10),o=a(12),i=a(26),d=a(1253),b=a(1239),m=l.forwardRef((function(e,t){var a,s,i=e.align,m=void 0===i?"inherit":i,u=e.classes,p=e.className,j=e.component,O=e.padding,f=e.scope,x=e.size,w=e.sortDirection,g=e.variant,v=Object(c.a)(e,["align","classes","className","component","padding","scope","size","sortDirection","variant"]),N=l.useContext(d.a),h=l.useContext(b.a),y=h&&"head"===h.variant;j?(s=j,a=y?"columnheader":"cell"):s=y?"th":"td";var k=f;!k&&y&&(k="col");var C=O||(N&&N.padding?N.padding:"default"),S=x||(N&&N.size?N.size:"medium"),R=g||h&&h.variant,B=null;return w&&(B="asc"===w?"ascending":"descending"),l.createElement(s,Object(n.a)({ref:t,className:Object(r.default)(u.root,u[R],p,"inherit"!==m&&u["align".concat(Object(o.a)(m))],"default"!==C&&u["padding".concat(Object(o.a)(C))],"medium"!==S&&u["size".concat(Object(o.a)(S))],"head"===R&&N&&N.stickyHeader&&u.stickyHeader),"aria-sort":B,role:a,scope:k},v))}));t.a=Object(s.a)((function(e){return{root:Object(n.a)({},e.typography.body2,{display:"table-cell",verticalAlign:"inherit",borderBottom:"1px solid\n    ".concat("light"===e.palette.type?Object(i.i)(Object(i.d)(e.palette.divider,1),.88):Object(i.a)(Object(i.d)(e.palette.divider,1),.68)),textAlign:"left",padding:16}),head:{color:e.palette.text.primary,lineHeight:e.typography.pxToRem(24),fontWeight:e.typography.fontWeightMedium},body:{color:e.palette.text.primary},footer:{color:e.palette.text.secondary,lineHeight:e.typography.pxToRem(21),fontSize:e.typography.pxToRem(12)},sizeSmall:{padding:"6px 24px 6px 16px","&:last-child":{paddingRight:16},"&$paddingCheckbox":{width:24,padding:"0 12px 0 16px","&:last-child":{paddingLeft:12,paddingRight:16},"& > *":{padding:0}}},paddingCheckbox:{width:48,padding:"0 0 0 4px","&:last-child":{paddingLeft:0,paddingRight:4}},paddingNone:{padding:0,"&:last-child":{padding:0}},alignLeft:{textAlign:"left"},alignCenter:{textAlign:"center"},alignRight:{textAlign:"right",flexDirection:"row-reverse"},alignJustify:{textAlign:"justify"},stickyHeader:{position:"sticky",top:0,left:0,zIndex:2,backgroundColor:e.palette.background.default}}}),{name:"MuiTableCell"})(m)},1318:function(e,t,a){"use strict";var c=a(7),n=a(2),l=a(0),r=(a(5),a(3)),s=a(10),o=a(1253),i=l.forwardRef((function(e,t){var a=e.classes,s=e.className,i=e.component,d=void 0===i?"table":i,b=e.padding,m=void 0===b?"default":b,u=e.size,p=void 0===u?"medium":u,j=e.stickyHeader,O=void 0!==j&&j,f=Object(c.a)(e,["classes","className","component","padding","size","stickyHeader"]),x=l.useMemo((function(){return{padding:m,size:p,stickyHeader:O}}),[m,p,O]);return l.createElement(o.a.Provider,{value:x},l.createElement(d,Object(n.a)({role:"table"===d?null:"table",ref:t,className:Object(r.default)(a.root,s,O&&a.stickyHeader)},f)))}));t.a=Object(s.a)((function(e){return{root:{display:"table",width:"100%",borderCollapse:"collapse",borderSpacing:0,"& caption":Object(n.a)({},e.typography.body2,{padding:e.spacing(2),color:e.palette.text.secondary,textAlign:"left",captionSide:"bottom"})},stickyHeader:{borderCollapse:"separate"}}}),{name:"MuiTable"})(i)},1319:function(e,t,a){"use strict";var c=a(2),n=a(7),l=a(0),r=(a(5),a(3)),s=a(10),o=a(1239),i={variant:"head"},d=l.forwardRef((function(e,t){var a=e.classes,s=e.className,d=e.component,b=void 0===d?"thead":d,m=Object(n.a)(e,["classes","className","component"]);return l.createElement(o.a.Provider,{value:i},l.createElement(b,Object(c.a)({className:Object(r.default)(a.root,s),ref:t,role:"thead"===b?null:"rowgroup"},m)))}));t.a=Object(s.a)({root:{display:"table-header-group"}},{name:"MuiTableHead"})(d)},1320:function(e,t,a){"use strict";var c=a(2),n=a(7),l=a(0),r=(a(5),a(3)),s=a(10),o=a(1239),i=a(26),d=l.forwardRef((function(e,t){var a=e.classes,s=e.className,i=e.component,d=void 0===i?"tr":i,b=e.hover,m=void 0!==b&&b,u=e.selected,p=void 0!==u&&u,j=Object(n.a)(e,["classes","className","component","hover","selected"]),O=l.useContext(o.a);return l.createElement(d,Object(c.a)({ref:t,className:Object(r.default)(a.root,s,O&&{head:a.head,footer:a.footer}[O.variant],m&&a.hover,p&&a.selected),role:"tr"===d?null:"row"},j))}));t.a=Object(s.a)((function(e){return{root:{color:"inherit",display:"table-row",verticalAlign:"middle",outline:0,"&$hover:hover":{backgroundColor:e.palette.action.hover},"&$selected, &$selected:hover":{backgroundColor:Object(i.d)(e.palette.secondary.main,e.palette.action.selectedOpacity)}},selected:{},hover:{},head:{},footer:{}}}),{name:"MuiTableRow"})(d)},1321:function(e,t,a){"use strict";var c=a(2),n=a(7),l=a(0),r=(a(5),a(3)),s=a(10),o=a(1239),i={variant:"body"},d=l.forwardRef((function(e,t){var a=e.classes,s=e.className,d=e.component,b=void 0===d?"tbody":d,m=Object(n.a)(e,["classes","className","component"]);return l.createElement(o.a.Provider,{value:i},l.createElement(b,Object(c.a)({className:Object(r.default)(a.root,s),ref:t,role:"tbody"===b?null:"rowgroup"},m)))}));t.a=Object(s.a)({root:{display:"table-row-group"}},{name:"MuiTableBody"})(d)},2976:function(e,t,a){"use strict";a.r(t);var c=a(14),n=a(153),l=a(189),r=a(1177),s=a(547),o=a(399),i=a(445),d=a(1167),b=a(1166),m=a(1224),u=a(1225),p=a(169),j=a(258),O=a(3),f=a(9),x=a(0),w=a.n(x),g=a(6),v=a(124),N=a(22),h=a(16),y=a.n(h),k=a(37),C=a(13),S=a(51),R=a.n(S),B=Object(C.b)("projectDashboardApp/projects/getProjects",Object(k.a)(y.a.mark((function e(){var t;return y.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,R.a.get("/api/project-dashboard-app/projects");case 2:return t=e.sent,e.abrupt("return",t.data);case 4:case"end":return e.stop()}}),e)})))),E=Object(C.c)({}),H=E.getSelectors((function(e){return e.projectDashboardApp.projects})),A=H.selectAll,T=(H.selectEntities,H.selectById,Object(C.d)({name:"projectDashboardApp/projects",initialState:E.getInitialState(),reducers:{},extraReducers:Object(N.a)({},B.fulfilled,E.setAll)}).reducer),D=Object(C.b)("projectDashboardApp/widgets/getWidgets",Object(k.a)(y.a.mark((function e(){var t,a;return y.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,R.a.get("/api/project-dashboard-app/widgets");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),L=Object(C.c)({}),M=L.getSelectors((function(e){return e.projectDashboardApp.widgets})),U=M.selectEntities,z=(M.selectById,Object(C.d)({name:"projectDashboardApp/widgets",initialState:L.getInitialState(),reducers:{},extraReducers:Object(N.a)({},D.fulfilled,L.setAll)}).reducer),I=Object(v.c)({widgets:z,projects:T}),P=a(221),_=a(685),W=a(1);var $=w.a.memo((function(e){var t=Object(x.useState)(e.widget.currentRange),a=Object(c.a)(t,2),n=a[0],l=a[1];return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)(_.a,{className:"px-12",native:!0,value:n,onChange:function(e){l(e.target.value)},inputProps:{name:"currentRange"},disableUnderline:!0},Object.entries(e.widget.ranges).map((function(e){var t=Object(c.a)(e,2),a=t[0],n=t[1];return Object(W.a)("option",{key:a,value:a},n)}))),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"text-center pt-12 pb-28"},Object(W.a)(p.a,{className:"text-72 leading-none text-blue"},e.widget.data.count[n]),Object(W.a)(p.a,{className:"text-16",color:"textSecondary"},e.widget.data.label)),Object(W.a)("div",{className:"flex items-center px-16 h-52 border-t-1"},Object(W.a)(p.a,{className:"text-15 flex w-full",color:"textSecondary"},Object(W.a)("span",{className:"truncate"},e.widget.data.extra.label),":",Object(W.a)("b",{className:"px-8"},e.widget.data.extra.count[n]))))})),J=a(1318),Y=a(1321),q=a(1306),F=a(1319),G=a(1320);var K=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},e.widget.title)),Object(W.a)("div",{className:"table-responsive"},Object(W.a)(J.a,{className:"w-full min-w-full"},Object(W.a)(F.a,null,Object(W.a)(G.a,null,e.widget.table.columns.map((function(e){return Object(W.a)(q.a,{key:e.id,className:"whitespace-no-wrap"},e.title)})))),Object(W.a)(Y.a,null,e.widget.table.rows.map((function(e){return Object(W.a)(G.a,{key:e.id},e.cells.map((function(e){switch(e.id){case"budget_type":return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row"},Object(W.a)(p.a,{className:Object(O.default)(e.classes,"inline text-11 font-500 px-8 py-4 rounded-4")},e.value));case"spent_perc":return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row"},Object(W.a)(p.a,{className:Object(O.default)(e.classes,"flex items-center")},e.value,Object(W.a)(s.a,{className:"text-14 mx-4"},e.icon)));default:return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row"},Object(W.a)(p.a,{className:e.classes},e.value))}})))}))))))})),Q=a(1229);var V=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},e.widget.title),Object(W.a)(p.a,{className:"text-11 font-500 rounded-4 text-white bg-blue px-8 py-4"},"".concat(e.widget.table.rows.length," Members"))),Object(W.a)("div",{className:"table-responsive"},Object(W.a)(J.a,{className:"w-full min-w-full",size:"small"},Object(W.a)(F.a,null,Object(W.a)(G.a,null,e.widget.table.columns.map((function(e){switch(e.id){case"avatar":return Object(W.a)(q.a,{key:e.id,className:"whitespace-no-wrap p-8 px-16"},e.title);default:return Object(W.a)(q.a,{key:e.id,className:"whitespace-no-wrap"},e.title)}})))),Object(W.a)(Y.a,null,e.widget.table.rows.map((function(e){return Object(W.a)(G.a,{key:e.id},e.cells.map((function(e){switch(e.id){case"avatar":return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row",className:"px-16"},Object(W.a)(Q.a,{src:e.value}));case"name":return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row",className:"truncate font-600"},e.value);default:return Object(W.a)(q.a,{key:e.id,component:"th",scope:"row",className:"truncate"},e.value)}})))}))))))}));var X=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)(p.a,{className:"text-16 px-12"},e.widget.title),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"text-center pt-12 pb-28"},Object(W.a)(p.a,{className:"text-72 leading-none text-red"},e.widget.data.count),Object(W.a)(p.a,{className:"text-16",color:"textSecondary"},e.widget.data.label)),Object(W.a)("div",{className:"flex items-center px-16 h-52 border-t-1"},Object(W.a)(p.a,{className:"text-15 flex w-full",color:"textSecondary"},Object(W.a)("span",{className:"truncate"},e.widget.data.extra.label),":",Object(W.a)("b",{className:"px-8"},e.widget.data.extra.count))))}));var Z=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)(p.a,{className:"text-16 px-12"},e.widget.title),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"text-center pt-12 pb-28"},Object(W.a)(p.a,{className:"text-72 leading-none text-orange"},e.widget.data.count),Object(W.a)(p.a,{className:"text-16",color:"textSecondary"},e.widget.data.label)),Object(W.a)("div",{className:"flex items-center px-16 h-52 border-t-1"},Object(W.a)(p.a,{className:"text-15 flex w-full",color:"textSecondary"},Object(W.a)("span",{className:"truncate"},e.widget.data.extra.label),":",Object(W.a)("b",{className:"px-8"},e.widget.data.extra.count))))}));var ee=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)(p.a,{className:"text-16 px-12"},e.widget.title),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"text-center pt-12 pb-28"},Object(W.a)(p.a,{className:"text-72 leading-none text-green"},e.widget.data.count),Object(W.a)(p.a,{className:"text-16",color:"textSecondary"},e.widget.data.label)),Object(W.a)("div",{className:"flex items-center px-16 h-52 border-t-1"},Object(W.a)(p.a,{className:"text-15 flex w-full",color:"textSecondary"},Object(W.a)("span",{className:"truncate"},e.widget.data.extra.label),":",Object(W.a)("b",{className:"px-8"},e.widget.data.extra.count))))})),te=a(8),ae=a(1170),ce=a(47),ne=a(152);var le=w.a.memo((function(e){var t=Object(x.useState)("TW"),a=Object(c.a)(t,2),n=a[0],l=a[1],r=Object(ce.a)(),s=f.a.merge({},e.widget);return f.a.setWith(s,"widget.mainChart.options.scales.xAxes[0].ticks.fontColor",r.palette.text.secondary),f.a.setWith(s,"widget.mainChart.options.scales.yAxes[0].ticks.fontColor",r.palette.text.secondary),Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 py-16 border-b-1"},Object(W.a)(p.a,{className:"text-16"},s.title),Object(W.a)("div",{className:"items-center"},Object.entries(s.ranges).map((function(e){var t=Object(c.a)(e,2),a=t[0],r=t[1];return Object(W.a)(ae.a,{key:a,className:"normal-case shadow-none px-16",onClick:function(){l(a)},color:n===a?"secondary":"default",variant:n===a?"contained":"text"},r)})))),Object(W.a)("div",{className:"flex flex-row flex-wrap"},Object(W.a)("div",{className:"w-full md:w-1/2 p-8 min-h-420 h-420"},Object(W.a)(ne.Bar,{data:{labels:s.mainChart[n].labels,datasets:s.mainChart[n].datasets.map((function(e,t){var a=r.palette[0===t?"primary":"secondary"];return Object(te.a)(Object(te.a)({},e),{},{borderColor:a.main,backgroundColor:a.main,pointBackgroundColor:a.dark,pointHoverBackgroundColor:a.main,pointBorderColor:a.contrastText,pointHoverBorderColor:a.contrastText})}))},options:s.mainChart.options})),Object(W.a)("div",{className:"flex w-full md:w-1/2 flex-wrap p-8"},Object.entries(s.supporting).map((function(e){var t=Object(c.a)(e,2),a=t[0],l=t[1];return Object(W.a)("div",{key:a,className:"w-full sm:w-1/2 p-12"},Object(W.a)(p.a,{className:"text-15 whitespace-no-wrap",color:"textSecondary"},l.label),Object(W.a)(p.a,{className:"text-32"},l.count[n]),Object(W.a)("div",{className:"h-64 w-full"},Object(W.a)(ne.Line,{data:{labels:l.chart[n].labels,datasets:l.chart[n].datasets.map((function(e,t){var a=r.palette.secondary;return Object(te.a)(Object(te.a)({},e),{},{borderColor:a.main,backgroundColor:a.main,pointBackgroundColor:a.dark,pointHoverBackgroundColor:a.main,pointBorderColor:a.contrastText,pointHoverBorderColor:a.contrastText})}))},options:l.chart.options})))})))))}));var re=w.a.memo((function(e){var t=Object(x.useState)(e.widget.currentRange),a=Object(c.a)(t,2),n=a[0],l=a[1],r=f.a.merge({},e.widget);return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},r.title),Object(W.a)(_.a,{native:!0,value:n,onChange:function(e){l(e.target.value)},inputProps:{name:"currentRange"},disableUnderline:!0},Object.entries(r.ranges).map((function(e){var t=Object(c.a)(e,2),a=t[0],n=t[1];return Object(W.a)("option",{key:a,value:a},n)})))),Object(W.a)("div",{className:"h-400 w-full p-32"},Object(W.a)(ne.Doughnut,{data:{labels:r.mainChart.labels,datasets:r.mainChart.datasets[n]},options:r.mainChart.options})),Object(W.a)("div",{className:"flex items-center p-8 border-t-1"},Object(W.a)("div",{className:"flex flex-1 flex-col items-center justify-center p-16 border-r-1"},Object(W.a)(p.a,{className:"text-32 leading-none"},r.footerLeft.count[n]),Object(W.a)(p.a,{className:"text-15",color:"textSecondary"},r.footerLeft.title)),Object(W.a)("div",{className:"flex flex-1 flex-col items-center justify-center p-16"},Object(W.a)(p.a,{className:"text-32 leading-none"},r.footerRight.count[n]),Object(W.a)(p.a,{className:"text-15",color:"textSecondary"},r.footerRight.title))))})),se=a(1129),oe=a(1130),ie=a(1221),de=a(1173);var be=w.a.memo((function(e){var t=Object(x.useState)(e.widget.currentRange),a=Object(c.a)(t,2),n=a[0],l=a[1];return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},e.widget.title),Object(W.a)(_.a,{native:!0,value:n,onChange:function(e){l(e.target.value)},inputProps:{name:"currentRange"},disableUnderline:!0},Object.entries(e.widget.ranges).map((function(e){var t=Object(c.a)(e,2),a=t[0],n=t[1];return Object(W.a)("option",{key:a,value:a},n)})))),Object(W.a)(se.a,null,e.widget.schedule[n].map((function(e){return Object(W.a)(oe.a,{key:e.id},Object(W.a)(de.a,{primary:e.title,secondary:e.time}),Object(W.a)(ie.a,null,Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))))}))))}));var me=w.a.memo((function(e){var t=f.a.merge({},e.widget);return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},t.title)),Object(W.a)("div",{className:"h-400 w-full p-32"},Object(W.a)(ne.Doughnut,{data:{labels:t.mainChart.labels,datasets:t.mainChart.datasets},options:t.mainChart.options})))})),ue=a(1217);var pe=w.a.memo((function(e){var t=Object(x.useState)(e.widget.currentRange),a=Object(c.a)(t,2),n=a[0],l=a[1],r=f.a.merge({},e.widget),s=Object(ce.a)();return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-16 h-64 border-b-1"},Object(W.a)(p.a,{className:"text-16"},r.title),Object(W.a)(_.a,{native:!0,value:n,onChange:function(e){l(e.target.value)},inputProps:{name:"currentRange"},disableUnderline:!0},Object.entries(r.ranges).map((function(e){var t=Object(c.a)(e,2),a=t[0],n=t[1];return Object(W.a)("option",{key:a,value:a},n)})))),["weeklySpent","totalSpent","remaining"].map((function(e){return Object(W.a)("div",{className:"flex flex-wrap items-center w-full p-8",key:e},Object(W.a)("div",{className:"flex flex-col w-full sm:w-1/2 p-8"},Object(W.a)(p.a,{className:"text-14",color:"textSecondary"},r[e].title),Object(W.a)("div",{className:"flex items-center"},Object(W.a)(p.a,{className:"text-32",color:"textSecondary"},"$"),Object(W.a)(p.a,{className:"text-32 mx-4"},r[e].count[n]))),Object(W.a)("div",{className:"flex w-full sm:w-1/2 p-8"},Object(W.a)("div",{className:"h-48 w-full"},Object(W.a)(ne.Line,{data:{labels:r[e].chart[n].labels,datasets:r[e].chart[n].datasets.map((function(e,t){var a=s.palette.secondary;return Object(te.a)(Object(te.a)({},e),{},{borderColor:a.main,backgroundColor:a.main,pointBackgroundColor:a.dark,pointHoverBackgroundColor:a.main,pointBorderColor:a.contrastText,pointHoverBorderColor:a.contrastText})}))},options:r[e].chart.options}))))})),Object(W.a)(ue.a,null),Object(W.a)("div",{className:"flex flex-col w-full px-16 py-24"},Object(W.a)(p.a,{className:"text-14",color:"textSecondary"},r.totalBudget.title),Object(W.a)("div",{className:"flex items-center"},Object(W.a)(p.a,{className:"text-32",color:"textSecondary"},"$"),Object(W.a)(p.a,{className:"text-32 mx-4"},r.totalBudget.count))))})),je=a(120),Oe=a.n(je);var fe=w.a.memo((function(){var e=Object(x.useState)(Oe()()),t=Object(c.a)(e,2),a=t[0],n=t[1],l=Object(x.useRef)();function r(){n(Oe()())}return Object(x.useEffect)((function(){return l.current=setInterval(r,1e3),function(){clearInterval(l.current)}})),Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)(p.a,{className:"text-16 px-12"},a.format("dddd, HH:mm:ss")),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"text-center px-24 py-32"},Object(W.a)(p.a,{className:"text-24 leading-tight",color:"textSecondary"},a.format("MMMM")),Object(W.a)(p.a,{className:"text-72 leading-tight",color:"textSecondary"},a.format("D")),Object(W.a)(p.a,{className:"text-24 leading-tight",color:"textSecondary"},a.format("Y"))))}));var xe=w.a.memo((function(e){return Object(W.a)(P.a,{className:"w-full rounded-8 shadow-1"},Object(W.a)("div",{className:"flex items-center justify-between px-4 pt-4"},Object(W.a)("div",{className:"flex items-center px-12"},Object(W.a)(s.a,{color:"action"},"location_on"),Object(W.a)(p.a,{className:"text-16 mx-8"},e.widget.locations[e.widget.currentLocation].name)),Object(W.a)(o.a,{"aria-label":"more"},Object(W.a)(s.a,null,"more_vert"))),Object(W.a)("div",{className:"flex items-center justify-center p-16 pb-32"},Object(W.a)(s.a,{className:"meteocons text-40 ltr:mr-8 rtl:ml-8",color:"action"},e.widget.locations[e.widget.currentLocation].icon),Object(W.a)(p.a,{className:"text-44 mx-8",color:"textSecondary"},e.widget.locations[e.widget.currentLocation].temp[e.widget.tempUnit]),Object(W.a)(p.a,{className:"text-48 font-300",color:"textSecondary"},"\xb0"),Object(W.a)(p.a,{className:"text-44 font-300",color:"textSecondary"},"C")),Object(W.a)(ue.a,null),Object(W.a)("div",{className:"flex justify-between items-center p-16"},Object(W.a)("div",{className:"flex items-center"},Object(W.a)(s.a,{className:"meteocons text-14",color:"action"},"windy"),Object(W.a)(p.a,{className:"mx-4"},e.widget.locations[e.widget.currentLocation].windSpeed[e.widget.speedUnit]),Object(W.a)(p.a,{color:"textSecondary"},e.widget.speedUnit)),Object(W.a)("div",{className:"flex items-center"},Object(W.a)(s.a,{className:"meteocons text-14",color:"action"},"compass"),Object(W.a)(p.a,{className:"mx-4"},e.widget.locations[e.widget.currentLocation].windDirection)),Object(W.a)("div",{className:"flex items-center"},Object(W.a)(s.a,{className:"meteocons text-14",color:"action"},"rainy"),Object(W.a)(p.a,{className:"mx-4"},e.widget.locations[e.widget.currentLocation].rainProbability))),Object(W.a)(ue.a,null),Object(W.a)("div",{className:"w-full py-16"},e.widget.locations[e.widget.currentLocation].next3Days.map((function(t){return Object(W.a)("div",{className:"flex items-center justify-between w-full py-16 px-24",key:t.name},Object(W.a)(p.a,{className:"text-15"},t.name),Object(W.a)("div",{className:"flex items-center"},Object(W.a)(s.a,{className:"meteocons text-24 ltr:mr-16 rtl:ml-16",color:"action"},t.icon),Object(W.a)(p.a,{className:"text-20"},t.temp[e.widget.tempUnit]),Object(W.a)(p.a,{className:"text-20",color:"textSecondary"},"\xb0"),Object(W.a)(p.a,{className:"text-20",color:"textSecondary"},e.widget.tempUnit)))}))))})),we=Object(b.a)((function(e){return{content:{"& canvas":{maxHeight:"100%"}},selectedProject:{background:e.palette.primary.main,color:e.palette.primary.contrastText,borderRadius:"8px 0 0 0"},projectMenuButton:{background:e.palette.primary.main,color:e.palette.primary.contrastText,borderRadius:"0 8px 0 0",marginLeft:1}}}));t.default=Object(j.a)("projectDashboardApp",I)((function(e){var t=Object(g.c)(),a=Object(g.d)(U),b=Object(g.d)(A),j=we(e),w=Object(x.useRef)(null),v=Object(x.useState)(0),N=Object(c.a)(v,2),h=N[0],y=N[1],k=Object(x.useState)({id:1,menuEl:null}),C=Object(c.a)(k,2),S=C[0],R=C[1];return Object(x.useEffect)((function(){t(D()),t(B())}),[t]),f.a.isEmpty(a)||f.a.isEmpty(b)?null:Object(W.a)(l.a,{classes:{header:"min-h-160 h-160",toolbar:"min-h-48 h-48",rightSidebar:"w-288",content:j.content},header:Object(W.a)("div",{className:"flex flex-col justify-between flex-1 px-24 pt-24"},Object(W.a)("div",{className:"flex justify-between items-start"},Object(W.a)(p.a,{className:"py-0 sm:py-24 text-24 md:text-32",variant:"h4"},"Welcome back, John!"),Object(W.a)(r.a,{lgUp:!0},Object(W.a)(o.a,{onClick:function(e){return w.current.toggleRightSidebar()},"aria-label":"open left sidebar",color:"inherit"},Object(W.a)(s.a,null,"menu")))),Object(W.a)("div",{className:"flex items-end"},Object(W.a)("div",{className:"flex items-center"},Object(W.a)("div",{className:Object(O.default)(j.selectedProject,"flex items-center h-40 px-16 text-16")},f.a.find(b,["id",S.id]).name),Object(W.a)(o.a,{className:Object(O.default)(j.projectMenuButton,"h-40 w-40 p-0"),"aria-owns":S.menuEl?"project-menu":void 0,"aria-haspopup":"true",onClick:function(e){R({id:S.id,menuEl:e.currentTarget})}},Object(W.a)(s.a,null,"more_horiz")),Object(W.a)(i.a,{id:"project-menu",anchorEl:S.menuEl,open:Boolean(S.menuEl),onClose:function(){R({id:S.id,menuEl:null})}},b&&b.map((function(e){return Object(W.a)(d.a,{key:e.id,onClick:function(t){var a;a=e.id,R({id:a,menuEl:null})}},e.name)})))))),contentToolbar:Object(W.a)(u.a,{value:h,onChange:function(e,t){y(t)},indicatorColor:"secondary",textColor:"secondary",variant:"scrollable",scrollButtons:"off",className:"w-full px-24"},Object(W.a)(m.a,{className:"text-14 font-600 normal-case",label:"Home"}),Object(W.a)(m.a,{className:"text-14 font-600 normal-case",label:"Budget Summary"}),Object(W.a)(m.a,{className:"text-14 font-600 normal-case",label:"Team Members"})),content:Object(W.a)("div",{className:"p-12"},0===h&&Object(W.a)(n.a,{className:"flex flex-wrap",enter:{animation:"transition.slideUpBigIn"}},Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 md:w-1/4 p-12"},Object(W.a)($,{widget:a.widget1})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 md:w-1/4 p-12"},Object(W.a)(X,{widget:a.widget2})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 md:w-1/4 p-12"},Object(W.a)(Z,{widget:a.widget3})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 md:w-1/4 p-12"},Object(W.a)(ee,{widget:a.widget4})),Object(W.a)("div",{className:"widget flex w-full p-12"},Object(W.a)(le,{widget:a.widget5})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 p-12"},Object(W.a)(re,{widget:a.widget6})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 p-12"},Object(W.a)(be,{widget:a.widget7}))),1===h&&Object(W.a)(n.a,{className:"flex flex-wrap",enter:{animation:"transition.slideUpBigIn"}},Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 p-12"},Object(W.a)(me,{widget:a.widget8})),Object(W.a)("div",{className:"widget flex w-full sm:w-1/2 p-12"},Object(W.a)(pe,{widget:a.widget9})),Object(W.a)("div",{className:"widget flex w-full p-12"},Object(W.a)(K,{widget:a.widget10}))),2===h&&Object(W.a)(n.a,{className:"flex flex-wrap",enter:{animation:"transition.slideUpBigIn"}},Object(W.a)("div",{className:"widget flex w-full p-12"},Object(W.a)(V,{widget:a.widget11})))),rightSidebarContent:Object(W.a)(n.a,{className:"w-full",enter:{animation:"transition.slideUpBigIn"}},Object(W.a)("div",{className:"widget w-full p-12"},Object(W.a)(fe,null)),Object(W.a)("div",{className:"widget w-full p-12"},Object(W.a)(xe,{widget:a.weatherWidget}))),ref:w})}))}}]);