(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[137],{1246:function(e,t,a){"use strict";a.d(t,"a",(function(){return S}));var n=a(22),o=a(35),r=a(1166),c=a(3),l=a(0),i=a.n(l),s=a(47),d=a(1210),u=a(27),b=a(6),p=a(1);var f=function(e){var t=Object(s.a)(),a=Object(b.d)(Object(u.c)(t.palette.primary.main));return Object(p.a)("div",{className:e.classes.header},e.header&&Object(p.a)(d.a,{theme:a},e.header))},O=a(14),j=a(116),m=a(1177),g=a(1230);var h=function(e){var t=Object(s.a)(),a=Object(b.d)(Object(u.c)(t.palette.primary.main)),n=e.classes;return Object(p.a)(i.a.Fragment,null,e.header&&Object(p.a)(d.a,{theme:a},Object(p.a)("div",{className:Object(c.default)(n.sidebarHeader,e.variant)},e.header)),e.content&&Object(p.a)(o.a,{className:n.sidebarContent,enable:e.innerScroll},e.content))};var v=i.a.forwardRef((function(e,t){var a=Object(l.useState)(!1),n=Object(O.a)(a,2),o=n[0],r=n[1],s=e.classes;Object(l.useImperativeHandle)(t,(function(){return{toggleSidebar:d}}));var d=function(){r(!o)};return Object(p.a)(i.a.Fragment,null,Object(p.a)(m.a,{lgUp:"permanent"===e.variant},Object(p.a)(g.a,{variant:"temporary",anchor:e.position,open:o,onOpen:function(e){},onClose:function(e){return d()},disableSwipeToOpen:!0,classes:{root:Object(c.default)(s.sidebarWrapper,e.variant),paper:Object(c.default)(s.sidebar,e.variant,"left"===e.position?s.leftSidebar:s.rightSidebar)},ModalProps:{keepMounted:!0},container:e.rootRef.current,BackdropProps:{classes:{root:s.backdrop}},style:{position:"absolute"}},Object(p.a)(h,e))),"permanent"===e.variant&&Object(p.a)(m.a,{mdDown:!0},Object(p.a)(j.a,{variant:"permanent",className:Object(c.default)(s.sidebarWrapper,e.variant),open:o,classes:{paper:Object(c.default)(s.sidebar,e.variant,"left"===e.position?s.leftSidebar:s.rightSidebar)}},Object(p.a)(h,e))))})),x=Object(r.a)((function(e){return{root:{display:"flex",flexDirection:"row",minHeight:"100%",position:"relative",flex:"1 0 auto",height:"auto",backgroundColor:e.palette.background.default},innerScroll:{flex:"1 1 auto",height:"100%"},topBg:{position:"absolute",left:0,right:0,top:0,height:200,background:"linear-gradient(to left, ".concat(e.palette.primary.dark," 0%, ").concat(e.palette.primary.main," 100%)"),backgroundSize:"cover",pointerEvents:"none"},contentWrapper:Object(n.a)({display:"flex",flexDirection:"column",padding:"0 3.2rem",flex:"1 1 100%",zIndex:2,maxWidth:"100%",minWidth:0,minHeight:0},e.breakpoints.down("xs"),{padding:"0 1.6rem"}),header:{height:136,minHeight:136,maxHeight:136,display:"flex",color:e.palette.primary.contrastText},headerSidebarToggleButton:{color:e.palette.primary.contrastText},contentCard:{display:"flex",flex:"1 1 100%",flexDirection:"column",backgroundColor:e.palette.background.paper,boxShadow:e.shadows[1],minHeight:0,borderRadius:"8px 8px 0 0"},toolbar:{height:64,minHeight:64,display:"flex",alignItems:"center",borderBottom:"1px solid ".concat(e.palette.divider)},content:{flex:"1 1 auto",height:"100%",overflow:"auto","-webkit-overflow-scrolling":"touch"},sidebarWrapper:{position:"absolute",backgroundColor:"transparent",zIndex:5,overflow:"hidden","&.permanent":Object(n.a)({},e.breakpoints.up("lg"),{zIndex:1,position:"relative"})},sidebar:{position:"absolute","&.permanent":Object(n.a)({},e.breakpoints.up("lg"),{backgroundColor:"transparent",position:"relative",border:"none",overflow:"hidden"}),width:240,height:"100%"},leftSidebar:{},rightSidebar:{},sidebarHeader:{height:200,minHeight:200,color:e.palette.primary.contrastText,backgroundColor:e.palette.primary.dark,"&.permanent":Object(n.a)({},e.breakpoints.up("lg"),{backgroundColor:"transparent"})},sidebarContent:Object(n.a)({display:"flex",flex:"1 1 auto",flexDirection:"column",backgroundColor:e.palette.background.default,color:e.palette.text.primary},e.breakpoints.up("lg"),{overflow:"auto","-webkit-overflow-scrolling":"touch"}),backdrop:{position:"absolute"}}})),y=i.a.forwardRef((function(e,t){var a=Object(l.useRef)(null),n=Object(l.useRef)(null),r=Object(l.useRef)(null),s=x(e),d=e.rightSidebarHeader||e.rightSidebarContent,u=e.leftSidebarHeader||e.leftSidebarContent;return i.a.useImperativeHandle(t,(function(){return{rootRef:r,toggleLeftSidebar:function(){a.current.toggleSidebar()},toggleRightSidebar:function(){n.current.toggleSidebar()}}})),Object(p.a)("div",{className:Object(c.default)(s.root,e.innerScroll&&s.innerScroll),ref:r},Object(p.a)("div",{className:s.topBg}),Object(p.a)("div",{className:"flex container w-full"},u&&Object(p.a)(v,{position:"left",header:e.leftSidebarHeader,content:e.leftSidebarContent,variant:e.leftSidebarVariant||"permanent",innerScroll:e.innerScroll,classes:s,ref:a,rootRef:r}),Object(p.a)("div",{className:Object(c.default)(s.contentWrapper,u&&(void 0===e.leftSidebarVariant||"permanent"===e.leftSidebarVariant)&&"lg:ltr:pl-0 lg:rtl:pr-0",d&&(void 0===e.rightSidebarVariant||"permanent"===e.rightSidebarVariant)&&"lg:pr-0")},Object(p.a)(f,{header:e.header,classes:s}),Object(p.a)("div",{className:Object(c.default)(s.contentCard,e.innerScroll&&"inner-scroll")},e.contentToolbar&&Object(p.a)("div",{className:s.toolbar},e.contentToolbar),e.content&&Object(p.a)(o.a,{className:s.content,enable:e.innerScroll,scrollToTopOnRouteChange:e.innerScroll},e.content))),d&&Object(p.a)(v,{position:"right",header:e.rightSidebarHeader,content:e.rightSidebarContent,variant:e.rightSidebarVariant||"permanent",innerScroll:e.innerScroll,classes:s,ref:n,rootRef:r})))}));y.defaultProps={};var S=i.a.memo(y)},1303:function(e,t,a){"use strict";var n=a(2),o=a(7),r=a(0),c=(a(5),a(3)),l=a(10),i=r.forwardRef((function(e,t){var a=e.classes,l=e.className,i=e.dividers,s=void 0!==i&&i,d=Object(o.a)(e,["classes","className","dividers"]);return r.createElement("div",Object(n.a)({className:Object(c.default)(a.root,l,s&&a.dividers),ref:t},d))}));t.a=Object(l.a)((function(e){return{root:{flex:"1 1 auto",WebkitOverflowScrolling:"touch",overflowY:"auto",padding:"8px 24px","&:first-child":{paddingTop:20}},dividers:{padding:"16px 24px",borderTop:"1px solid ".concat(e.palette.divider),borderBottom:"1px solid ".concat(e.palette.divider)}}}),{name:"MuiDialogContent"})(i)},1317:function(e,t,a){"use strict";var n=a(2),o=a(7),r=a(0),c=(a(5),a(3)),l=a(10),i=r.forwardRef((function(e,t){var a=e.disableSpacing,l=void 0!==a&&a,i=e.classes,s=e.className,d=Object(o.a)(e,["disableSpacing","classes","className"]);return r.createElement("div",Object(n.a)({className:Object(c.default)(i.root,s,!l&&i.spacing),ref:t},d))}));t.a=Object(l.a)({root:{display:"flex",alignItems:"center",padding:8,justifyContent:"flex-end",flex:"0 0 auto"},spacing:{"& > :not(:first-child)":{marginLeft:8}}},{name:"MuiDialogActions"})(i)},2977:function(e,t,a){"use strict";a.r(t);var n,o=a(1246),r=a(258),c=a(0),l=a.n(c),i=a(6),s=a(52),d=a(151),u=a(124),b=a(22),p=a(16),f=a.n(p),O=a(37),j=a(13),m=a(51),g=a.n(m),h=Object(j.b)("todoApp/filters/getFilters",Object(O.a)(f.a.mark((function e(){var t,a;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,g.a.get("/api/todo-app/filters");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),v=Object(j.c)({}),x=v.getSelectors((function(e){return e.todoApp.filters})),y=x.selectAll,S=(x.selectById,Object(j.d)({name:"todoApp/filters",initialState:v.getInitialState({}),reducers:{},extraReducers:Object(b.a)({},h.fulfilled,v.setAll)}).reducer),N=Object(j.b)("todoApp/folders/getFolders",Object(O.a)(f.a.mark((function e(){var t,a;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,g.a.get("/api/todo-app/folders");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),k=Object(j.c)({}),w=k.getSelectors((function(e){return e.todoApp.folders})),D=w.selectAll,C=(w.selectById,Object(j.d)({name:"todoApp/folders",initialState:k.getInitialState({}),reducers:{},extraReducers:Object(b.a)({},N.fulfilled,k.setAll)}).reducer),T=Object(j.b)("todoApp/labels/getLabels",Object(O.a)(f.a.mark((function e(){var t,a;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,g.a.get("/api/todo-app/labels");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),A=Object(j.c)({}),I=A.getSelectors((function(e){return e.todoApp.labels})),R=I.selectAll,E=I.selectEntities,L=(I.selectById,Object(j.d)({name:"todoApp/labels",initialState:A.getInitialState(null),reducers:{},extraReducers:Object(b.a)({},T.fulfilled,A.setAll)}).reducer),B=Object(j.b)("todoApp/todos/getTodos",function(){var e=Object(O.a)(f.a.mark((function e(t,a){var n,o,r;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=a.getState,t=t||n().todoApp.todos.routeParams,e.next=4,g.a.get("/api/todo-app/todos",{params:t});case 4:return o=e.sent,e.next=7,o.data;case 7:return r=e.sent,e.abrupt("return",{data:r,routeParams:t});case 9:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),H=Object(j.b)("todoApp/todos/addTodo",function(){var e=Object(O.a)(f.a.mark((function e(t,a){var n,o,r;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=a.dispatch,a.getState,e.next=3,g.a.post("/api/todo-app/new-todo",t);case 3:return o=e.sent,e.next=6,o.data;case 6:return r=e.sent,n(B()),e.abrupt("return",r);case 9:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),P=Object(j.b)("todoApp/todos/updateTodo",function(){var e=Object(O.a)(f.a.mark((function e(t,a){var n,o,r;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=a.dispatch,a.getState,e.next=3,g.a.post("/api/todo-app/update-todo",t);case 3:return o=e.sent,e.next=6,o.data;case 6:return r=e.sent,n(B()),e.abrupt("return",r);case 9:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),_=Object(j.b)("todoApp/todos/removeTodo",function(){var e=Object(O.a)(f.a.mark((function e(t,a){var n,o,r;return f.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=a.dispatch,a.getState,e.next=3,g.a.post("/api/todo-app/remove-todo",t);case 3:return o=e.sent,e.next=6,o.data;case 6:return r=e.sent,n(B()),e.abrupt("return",r);case 9:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}()),W=Object(j.c)({}),F=W.getSelectors((function(e){return e.todoApp.todos})),M=F.selectAll,U=(F.selectById,Object(j.d)({name:"todoApp/todos",initialState:W.getInitialState({searchText:"",orderBy:"",orderDescending:!1,routeParams:{},todoDialog:{type:"new",props:{open:!1},data:null}}),reducers:{setTodosSearchText:{reducer:function(e,t){e.searchText=t.payload},prepare:function(e){return{payload:e.target.value||""}}},toggleOrderDescending:function(e,t){e.orderDescending=!e.orderDescending},changeOrder:function(e,t){e.orderBy=t.payload},openNewTodoDialog:function(e,t){e.todoDialog={type:"new",props:{open:!0},data:null}},closeNewTodoDialog:function(e,t){e.todoDialog={type:"new",props:{open:!1},data:null}},openEditTodoDialog:function(e,t){e.todoDialog={type:"edit",props:{open:!0},data:t.payload}},closeEditTodoDialog:function(e,t){e.todoDialog={type:"edit",props:{open:!1},data:null}}},extraReducers:(n={},Object(b.a)(n,P.fulfilled,W.upsertOne),Object(b.a)(n,H.fulfilled,W.addOne),Object(b.a)(n,B.fulfilled,(function(e,t){var a=t.payload,n=a.data,o=a.routeParams;W.setAll(e,n),e.routeParams=o,e.searchText=""})),n)})),z=U.actions,V=z.setTodosSearchText,q=z.toggleOrderDescending,Y=z.changeOrder,J=z.openNewTodoDialog,G=z.closeNewTodoDialog,K=z.openEditTodoDialog,Q=z.closeEditTodoDialog,X=U.reducer,Z=Object(u.c)({todos:X,folders:C,labels:L,filters:S}),$=a(20),ee=a(18),te=a(8),ae=a(14),ne=a(34),oe=a(9),re=a(1211),ce=a(1229),le=a(1170),ie=a(1176),se=a(1178),de=a(209),ue=a(481),be=a(1205),pe=a(1317),fe=a(1303),Oe=a(1217),je=a(678),me=a(547),ge=a(399),he=a(1220),ve=a(1173),xe=a(445),ye=a(1167),Se=a(1174),Ne=a(1172),ke=a(169),we=a(120),De=a.n(we),Ce=a(1),Te={id:"",title:"",notes:"",startDate:new Date,dueDate:new Date,completed:!1,starred:!1,important:!1,deleted:!1,labels:[]};var Ae=function(e){var t=Object(i.c)(),a=Object(i.d)((function(e){return e.todoApp.todos.todoDialog})),n=Object(i.d)(R),o=Object(c.useState)(null),r=Object(ae.a)(o,2),l=r[0],s=r[1],u=Object(d.c)(Object(te.a)({},Te)),b=u.form,p=u.handleChange,f=u.setForm,O=De()(b.startDate).format(De.a.HTML5_FMT.DATETIME_LOCAL_SECONDS),j=De()(b.dueDate).format(De.a.HTML5_FMT.DATETIME_LOCAL_SECONDS),m=Object(c.useCallback)((function(){"edit"===a.type&&a.data&&f(Object(te.a)({},a.data)),"new"===a.type&&f(Object(te.a)(Object(te.a)(Object(te.a)({},Te),a.data),{},{id:ne.a.generateGUID()}))}),[a.data,a.type,f]);function g(){return"edit"===a.type?t(Q()):t(G())}function h(e,t){e.stopPropagation(),f(oe.a.set(Object(te.a)(Object(te.a)({},b),{},{labels:b.labels.includes(t)?b.labels.filter((function(e){return e!==t})):[].concat(Object(ee.a)(b.labels),[t])})))}function v(){return b.title.length>0}return Object(c.useEffect)((function(){a.props.open&&m()}),[a.props.open,m]),Object(Ce.a)(be.a,Object($.a)({},a.props,{onClose:g,fullWidth:!0,maxWidth:"sm",classes:{paper:"rounded-8"}}),Object(Ce.a)(re.a,{position:"static",elevation:1},Object(Ce.a)(Ne.a,{className:"flex w-full"},Object(Ce.a)(ke.a,{variant:"subtitle1",color:"inherit"},"new"===a.type?"New Todo":"Edit Todo"))),Object(Ce.a)(fe.a,{classes:{root:"p-0"}},Object(Ce.a)("div",{className:"mb-16"},Object(Ce.a)("div",{className:"flex items-center justify-between p-12"},Object(Ce.a)("div",{className:"flex"},Object(Ce.a)(ie.a,{tabIndex:-1,checked:b.completed,onChange:function(){f(Object(te.a)(Object(te.a)({},b),{},{completed:!b.completed}))},onClick:function(e){return e.stopPropagation()}})),Object(Ce.a)("div",{className:"flex items-center justify-start","aria-label":"Toggle star"},Object(Ce.a)(ge.a,{onClick:function(){f(Object(te.a)(Object(te.a)({},b),{},{important:!b.important}))}},b.important?Object(Ce.a)(me.a,{style:{color:de.a[500]}},"error"):Object(Ce.a)(me.a,null,"error_outline")),Object(Ce.a)(ge.a,{onClick:function(){f(Object(te.a)(Object(te.a)({},b),{},{starred:!b.starred}))}},b.starred?Object(Ce.a)(me.a,{style:{color:ue.a[500]}},"star"):Object(Ce.a)(me.a,null,"star_outline")),Object(Ce.a)("div",null,Object(Ce.a)(ge.a,{"aria-owns":l?"label-menu":null,"aria-haspopup":"true",onClick:function(e){s(e.currentTarget)}},Object(Ce.a)(me.a,null,"label")),Object(Ce.a)(xe.a,{id:"label-menu",anchorEl:l,open:Boolean(l),onClose:function(e){s(null)}},n.length>0&&n.map((function(e){return Object(Ce.a)(ye.a,{onClick:function(t){return h(t,e.id)},key:e.id},Object(Ce.a)(he.a,{className:"min-w-24"},Object(Ce.a)(me.a,{color:"action"},b.labels.includes(e.id)?"check_box":"check_box_outline_blank")),Object(Ce.a)(ve.a,{className:"mx-8",primary:e.title,disableTypography:!0}),Object(Ce.a)(he.a,{className:"min-w-24"},Object(Ce.a)(me.a,{style:{color:e.color},color:"action"},"label")))})))))),Object(Ce.a)(Oe.a,{className:"mx-24"})),b.labels.length>0&&Object(Ce.a)("div",{className:"flex flex-wrap w-full px-12 sm:px-20 mb-16"},b.labels.map((function(e){return Object(Ce.a)(se.a,{avatar:Object(Ce.a)(ce.a,{classes:{colorDefault:"bg-transparent"}},Object(Ce.a)(me.a,{className:"text-20",style:{color:oe.a.find(n,{id:e}).color}},"label")),label:oe.a.find(n,{id:e}).title,onDelete:function(t){return h(t,e)},className:"mx-4 my-4",classes:{label:"px-8"},key:e})}))),Object(Ce.a)("div",{className:"px-16 sm:px-24"},Object(Ce.a)(je.a,{className:"mt-8 mb-16",required:!0,fullWidth:!0},Object(Ce.a)(Se.a,{label:"Title",autoFocus:!0,name:"title",value:b.title,onChange:p,required:!0,variant:"outlined"})),Object(Ce.a)(je.a,{className:"mt-8 mb-16",required:!0,fullWidth:!0},Object(Ce.a)(Se.a,{label:"Notes",name:"notes",multiline:!0,rows:"6",value:b.notes,onChange:p,variant:"outlined"})),Object(Ce.a)("div",{className:"flex -mx-4"},Object(Ce.a)(Se.a,{name:"startDate",label:"Start Date",type:"datetime-local",className:"mt-8 mb-16 mx-4",InputLabelProps:{shrink:!0},inputProps:{max:j},value:O,onChange:p,variant:"outlined"}),Object(Ce.a)(Se.a,{name:"dueDate",label:"Due Date",type:"datetime-local",className:"mt-8 mb-16 mx-4",InputLabelProps:{shrink:!0},inputProps:{min:O},value:j,onChange:p,variant:"outlined"})))),"new"===a.type?Object(Ce.a)(pe.a,{className:"justify-between p-8"},Object(Ce.a)("div",{className:"px-16"},Object(Ce.a)(le.a,{variant:"contained",color:"primary",onClick:function(){t(H(b)).then((function(){g()}))},disabled:!v()},"Add"))):Object(Ce.a)(pe.a,{className:"justify-between p-8"},Object(Ce.a)("div",{className:"px-16"},Object(Ce.a)(le.a,{variant:"contained",color:"primary",onClick:function(){t(P(b)).then((function(){g()}))},disabled:!v()},"Save")),Object(Ce.a)(ge.a,{className:"min-w-auto",onClick:function(){t(_(b.id)).then((function(){g()}))}},Object(Ce.a)(me.a,null,"delete"))))},Ie=a(1177),Re=a(574),Ee=a(221),Le=a(1210),Be=a(27);var He=function(e){var t=Object(i.c)(),a=Object(i.d)((function(e){return e.todoApp.todos.searchText})),n=Object(i.d)(Be.e);return Object(Ce.a)(Le.a,{theme:n},Object(Ce.a)("div",{className:"flex flex-1"},Object(Ce.a)(Ee.a,{className:"flex items-center w-full h-48 sm:h-56 p-16 ltr:pl-4 lg:ltr:pl-16 rtl:pr-4 lg:rtl:pr-16 rounded-8",elevation:1},Object(Ce.a)(Ie.a,{lgUp:!0},Object(Ce.a)(ge.a,{onClick:function(t){return e.pageLayout.current.toggleLeftSidebar()},"aria-label":"open left sidebar"},Object(Ce.a)(me.a,null,"menu"))),Object(Ce.a)(me.a,{color:"action"},"search"),Object(Ce.a)(Re.a,{placeholder:"Search",className:"px-16",disableUnderline:!0,fullWidth:!0,value:a,inputProps:{"aria-label":"Search"},onChange:function(e){return t(V(e))}}))))},Pe=a(129),_e=a(153),We=a(1129),Fe=a(1130),Me=a(1166),Ue=a(3),ze=Object(Me.a)((function(e){return{root:{display:"flex",alignItems:"center",height:21,borderRadius:2,padding:"0 6px",fontSize:11,backgroundColor:"rgba(0,0,0,.08);"},color:{width:8,height:8,marginRight:4,borderRadius:"50%"}}}));var Ve=function(e){var t=ze();return Object(Ce.a)("div",{className:Object(Ue.default)(t.root,e.className)},Object(Ce.a)("div",{className:t.color,style:{backgroundColor:e.color}}),Object(Ce.a)("div",null,e.title))},qe=Object(Me.a)({todoItem:{"&.completed":{background:"rgba(0,0,0,0.03)","& .todo-title, & .todo-notes":{textDecoration:"line-through"}}}});var Ye=function(e){var t=Object(i.c)(),a=Object(i.d)(E),n=qe(e);return Object(Ce.a)(Fe.a,{className:Object(Ue.default)(n.todoItem,{completed:e.todo.completed},"border-solid border-b-1 py-16 px-0 sm:px-8"),onClick:function(a){a.preventDefault(),t(K(e.todo))},dense:!0,button:!0},Object(Ce.a)(ie.a,{tabIndex:-1,disableRipple:!0,checked:e.todo.completed,onChange:function(){return t(P(Object(te.a)(Object(te.a)({},e.todo),{},{completed:!e.todo.completed})))},onClick:function(e){return e.stopPropagation()}}),Object(Ce.a)("div",{className:"flex flex-1 flex-col relative overflow-hidden px-8"},Object(Ce.a)(ke.a,{variant:"subtitle1",className:"todo-title truncate",color:e.todo.completed?"textSecondary":"inherit"},e.todo.title),Object(Ce.a)(ke.a,{color:"textSecondary",className:"todo-notes truncate"},oe.a.truncate(e.todo.notes.replace(/<(?:.|\n)*?>/gm,""),{length:180})),Object(Ce.a)("div",{className:Object(Ue.default)(n.labels,"flex -mx-2")},e.todo.labels.map((function(e){return Object(Ce.a)(Ve,{className:"mx-2 mt-4",title:a[e].title,color:a[e].color,key:e})})))),Object(Ce.a)("div",{className:"px-8"},Object(Ce.a)(ge.a,{onClick:function(a){a.preventDefault(),a.stopPropagation(),t(P(Object(te.a)(Object(te.a)({},e.todo),{},{important:!e.todo.important})))}},e.todo.important?Object(Ce.a)(me.a,{style:{color:de.a[500]}},"error"):Object(Ce.a)(me.a,null,"error_outline")),Object(Ce.a)(ge.a,{onClick:function(a){a.preventDefault(),a.stopPropagation(),t(P(Object(te.a)(Object(te.a)({},e.todo),{},{starred:!e.todo.starred})))}},e.todo.starred?Object(Ce.a)(me.a,{style:{color:ue.a[500]}},"star"):Object(Ce.a)(me.a,null,"star_outline"))))};var Je=function(e){var t=Object(i.d)(M),a=Object(i.d)((function(e){return e.todoApp.todos.searchText})),n=Object(i.d)((function(e){return e.todoApp.todos.orderBy})),o=Object(i.d)((function(e){return e.todoApp.todos.orderDescending})),r=Object(c.useState)(null),l=Object(ae.a)(r,2),s=l[0],d=l[1];return Object(c.useEffect)((function(){var e;t&&d(oe.a.orderBy(0===(e=a).length?t:ne.a.filterArrayByString(t,e),[n],[o?"desc":"asc"]))}),[t,a,n,o]),s?0===s.length?Object(Ce.a)(Pe.a,{delay:100},Object(Ce.a)("div",{className:"flex flex-1 items-center justify-center h-full"},Object(Ce.a)(ke.a,{color:"textSecondary",variant:"h5"},"There are no todos!"))):Object(Ce.a)(We.a,{className:"p-0"},Object(Ce.a)(_e.a,{enter:{animation:"transition.slideUpBigIn"}},s.map((function(e){return Object(Ce.a)(Ye,{todo:e,key:e.id})})))):null},Ge=a(109),Ke=a(1216),Qe=Object(Me.a)((function(e){return{listItem:{color:"inherit!important",textDecoration:"none!important",height:40,width:"calc(100% - 16px)",borderRadius:"0 20px 20px 0",paddingLeft:24,paddingRight:12,"&.active":{backgroundColor:e.palette.secondary.main,color:"".concat(e.palette.secondary.contrastText,"!important"),pointerEvents:"none","& .list-item-icon":{color:"inherit"}},"& .list-item-icon":{fontSize:16,width:16,height:16,marginRight:16}},listSubheader:{paddingLeft:24}}}));var Xe=function(e){var t=Object(i.c)(),a=Object(i.d)(R),n=Object(i.d)(D),o=Object(i.d)(y),r=Qe(e);return Object(Ce.a)(Pe.a,{animation:"transition.slideUpIn",delay:400},Object(Ce.a)("div",{className:"flex-auto border-l-1 border-solid"},Object(Ce.a)("div",{className:"p-24"},Object(Ce.a)(le.a,{onClick:function(){t(J())},variant:"contained",color:"primary",className:"w-full"},"ADD TASK")),Object(Ce.a)("div",{className:r.listWrapper},Object(Ce.a)(We.a,null,n.length>0&&n.map((function(e){return Object(Ce.a)(Fe.a,{button:!0,component:Ge.a,to:"/apps/todo/".concat(e.handle),key:e.id,activeClassName:"active",className:r.listItem},Object(Ce.a)(me.a,{className:"list-item-icon",color:"action"},e.icon),Object(Ce.a)(ve.a,{primary:e.title,disableTypography:!0}))}))),Object(Ce.a)(We.a,null,Object(Ce.a)(Ke.a,{className:r.listSubheader,disableSticky:!0},"FILTERS"),o.length>0&&o.map((function(e){return Object(Ce.a)(Fe.a,{button:!0,component:Ge.a,to:"/apps/todo/filter/".concat(e.handle),activeClassName:"active",className:r.listItem,key:e.id},Object(Ce.a)(me.a,{className:"list-item-icon",color:"action"},e.icon),Object(Ce.a)(ve.a,{primary:e.title,disableTypography:!0}))}))),Object(Ce.a)(We.a,null,Object(Ce.a)(Ke.a,{className:r.listSubheader,disableSticky:!0},"LABELS"),a.length>0&&a.map((function(e){return Object(Ce.a)(Fe.a,{button:!0,component:Ge.a,to:"/apps/todo/label/".concat(e.handle),key:e.id,className:r.listItem},Object(Ce.a)(me.a,{className:"list-item-icon",style:{color:e.color},color:"action"},"label"),Object(Ce.a)(ve.a,{primary:e.title,disableTypography:!0}))}))))))},Ze={creapond:"johndoe@creapond.com",withinpixels:"johndoe@withinpixels.com"};var $e=function(){var e=Object(c.useState)("creapond"),t=Object(ae.a)(e,2),a=t[0],n=t[1];return Object(Ce.a)("div",{className:"flex flex-col justify-center h-full p-24"},Object(Ce.a)("div",{className:"flex items-center flex-1"},Object(Ce.a)(Pe.a,{animation:"transition.expandIn",delay:300},Object(Ce.a)(me.a,{className:"text-32"},"check_box")),Object(Ce.a)(Pe.a,{animation:"transition.slideLeftIn",delay:300},Object(Ce.a)("span",{className:"text-24 mx-16"},"To-Do"))),Object(Ce.a)(Pe.a,{animation:"transition.slideUpIn",delay:300},Object(Ce.a)(Se.a,{id:"account-selection",select:!0,label:a,value:a,onChange:function(e){n(e.target.value)},placeholder:"Select Account",margin:"normal"},Object.keys(Ze).map((function(e,t){return Object(Ce.a)(ye.a,{key:e,value:e},Ze[e])})))))},et=a(685);var tt=function(e){var t=Object(i.c)(),a=Object(i.d)((function(e){return e.todoApp.todos.orderBy})),n=Object(i.d)((function(e){return e.todoApp.todos.orderDescending}));return Object(Ce.a)("div",{className:"flex justify-between w-full"},Object(Ce.a)("div",{className:"flex"}),Object(Ce.a)("div",{className:"flex items-center"},Object(Ce.a)(je.a,{className:""},Object(Ce.a)(et.a,{value:a,onChange:function(e){t(Y(e.target.value))},displayEmpty:!0,name:"filter",className:""},Object(Ce.a)(ye.a,{value:""},Object(Ce.a)("em",null,"Order by")),Object(Ce.a)(ye.a,{value:"startDate"},"Start Date"),Object(Ce.a)(ye.a,{value:"dueDate"},"Due Date"),Object(Ce.a)(ye.a,{value:"title"},"Title"))),Object(Ce.a)(ge.a,{onClick:function(e){return t(q())}},Object(Ce.a)(me.a,{style:{transform:n?"scaleY(-1)":"scaleY(1)"}},"sort"))))};t.default=Object(r.a)("todoApp",Z)((function(e){var t=Object(i.c)(),a=Object(c.useRef)(null),n=Object(s.j)();return Object(c.useEffect)((function(){t(h()),t(N()),t(T())}),[t]),Object(d.b)((function(){t(B(n))}),[t,n]),Object(Ce.a)(l.a.Fragment,null,Object(Ce.a)(o.a,{classes:{root:"w-full",header:"items-center min-h-72 h-72 sm:h-136 sm:min-h-136"},header:Object(Ce.a)(He,{pageLayout:a}),contentToolbar:Object(Ce.a)(tt,null),content:Object(Ce.a)(Je,null),leftSidebarHeader:Object(Ce.a)($e,null),leftSidebarContent:Object(Ce.a)(Xe,null),ref:a,innerScroll:!0}),Object(Ce.a)(Ae,null))}))}}]);