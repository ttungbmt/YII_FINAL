(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[116],{1246:function(e,t,a){"use strict";a.d(t,"a",(function(){return S}));var r=a(22),n=a(35),c=a(1166),o=a(3),i=a(0),l=a.n(i),s=a(47),d=a(1210),u=a(27),p=a(6),b=a(1);var m=function(e){var t=Object(s.a)(),a=Object(p.d)(Object(u.c)(t.palette.primary.main));return Object(b.a)("div",{className:e.classes.header},e.header&&Object(b.a)(d.a,{theme:a},e.header))},f=a(14),g=a(116),O=a(1177),j=a(1230);var h=function(e){var t=Object(s.a)(),a=Object(p.d)(Object(u.c)(t.palette.primary.main)),r=e.classes;return Object(b.a)(l.a.Fragment,null,e.header&&Object(b.a)(d.a,{theme:a},Object(b.a)("div",{className:Object(o.default)(r.sidebarHeader,e.variant)},e.header)),e.content&&Object(b.a)(n.a,{className:r.sidebarContent,enable:e.innerScroll},e.content))};var x=l.a.forwardRef((function(e,t){var a=Object(i.useState)(!1),r=Object(f.a)(a,2),n=r[0],c=r[1],s=e.classes;Object(i.useImperativeHandle)(t,(function(){return{toggleSidebar:d}}));var d=function(){c(!n)};return Object(b.a)(l.a.Fragment,null,Object(b.a)(O.a,{lgUp:"permanent"===e.variant},Object(b.a)(j.a,{variant:"temporary",anchor:e.position,open:n,onOpen:function(e){},onClose:function(e){return d()},disableSwipeToOpen:!0,classes:{root:Object(o.default)(s.sidebarWrapper,e.variant),paper:Object(o.default)(s.sidebar,e.variant,"left"===e.position?s.leftSidebar:s.rightSidebar)},ModalProps:{keepMounted:!0},container:e.rootRef.current,BackdropProps:{classes:{root:s.backdrop}},style:{position:"absolute"}},Object(b.a)(h,e))),"permanent"===e.variant&&Object(b.a)(O.a,{mdDown:!0},Object(b.a)(g.a,{variant:"permanent",className:Object(o.default)(s.sidebarWrapper,e.variant),open:n,classes:{paper:Object(o.default)(s.sidebar,e.variant,"left"===e.position?s.leftSidebar:s.rightSidebar)}},Object(b.a)(h,e))))})),v=Object(c.a)((function(e){return{root:{display:"flex",flexDirection:"row",minHeight:"100%",position:"relative",flex:"1 0 auto",height:"auto",backgroundColor:e.palette.background.default},innerScroll:{flex:"1 1 auto",height:"100%"},topBg:{position:"absolute",left:0,right:0,top:0,height:200,background:"linear-gradient(to left, ".concat(e.palette.primary.dark," 0%, ").concat(e.palette.primary.main," 100%)"),backgroundSize:"cover",pointerEvents:"none"},contentWrapper:Object(r.a)({display:"flex",flexDirection:"column",padding:"0 3.2rem",flex:"1 1 100%",zIndex:2,maxWidth:"100%",minWidth:0,minHeight:0},e.breakpoints.down("xs"),{padding:"0 1.6rem"}),header:{height:136,minHeight:136,maxHeight:136,display:"flex",color:e.palette.primary.contrastText},headerSidebarToggleButton:{color:e.palette.primary.contrastText},contentCard:{display:"flex",flex:"1 1 100%",flexDirection:"column",backgroundColor:e.palette.background.paper,boxShadow:e.shadows[1],minHeight:0,borderRadius:"8px 8px 0 0"},toolbar:{height:64,minHeight:64,display:"flex",alignItems:"center",borderBottom:"1px solid ".concat(e.palette.divider)},content:{flex:"1 1 auto",height:"100%",overflow:"auto","-webkit-overflow-scrolling":"touch"},sidebarWrapper:{position:"absolute",backgroundColor:"transparent",zIndex:5,overflow:"hidden","&.permanent":Object(r.a)({},e.breakpoints.up("lg"),{zIndex:1,position:"relative"})},sidebar:{position:"absolute","&.permanent":Object(r.a)({},e.breakpoints.up("lg"),{backgroundColor:"transparent",position:"relative",border:"none",overflow:"hidden"}),width:240,height:"100%"},leftSidebar:{},rightSidebar:{},sidebarHeader:{height:200,minHeight:200,color:e.palette.primary.contrastText,backgroundColor:e.palette.primary.dark,"&.permanent":Object(r.a)({},e.breakpoints.up("lg"),{backgroundColor:"transparent"})},sidebarContent:Object(r.a)({display:"flex",flex:"1 1 auto",flexDirection:"column",backgroundColor:e.palette.background.default,color:e.palette.text.primary},e.breakpoints.up("lg"),{overflow:"auto","-webkit-overflow-scrolling":"touch"}),backdrop:{position:"absolute"}}})),w=l.a.forwardRef((function(e,t){var a=Object(i.useRef)(null),r=Object(i.useRef)(null),c=Object(i.useRef)(null),s=v(e),d=e.rightSidebarHeader||e.rightSidebarContent,u=e.leftSidebarHeader||e.leftSidebarContent;return l.a.useImperativeHandle(t,(function(){return{rootRef:c,toggleLeftSidebar:function(){a.current.toggleSidebar()},toggleRightSidebar:function(){r.current.toggleSidebar()}}})),Object(b.a)("div",{className:Object(o.default)(s.root,e.innerScroll&&s.innerScroll),ref:c},Object(b.a)("div",{className:s.topBg}),Object(b.a)("div",{className:"flex container w-full"},u&&Object(b.a)(x,{position:"left",header:e.leftSidebarHeader,content:e.leftSidebarContent,variant:e.leftSidebarVariant||"permanent",innerScroll:e.innerScroll,classes:s,ref:a,rootRef:c}),Object(b.a)("div",{className:Object(o.default)(s.contentWrapper,u&&(void 0===e.leftSidebarVariant||"permanent"===e.leftSidebarVariant)&&"lg:ltr:pl-0 lg:rtl:pr-0",d&&(void 0===e.rightSidebarVariant||"permanent"===e.rightSidebarVariant)&&"lg:pr-0")},Object(b.a)(m,{header:e.header,classes:s}),Object(b.a)("div",{className:Object(o.default)(s.contentCard,e.innerScroll&&"inner-scroll")},e.contentToolbar&&Object(b.a)("div",{className:s.toolbar},e.contentToolbar),e.content&&Object(b.a)(n.a,{className:s.content,enable:e.innerScroll,scrollToTopOnRouteChange:e.innerScroll},e.content))),d&&Object(b.a)(x,{position:"right",header:e.rightSidebarHeader,content:e.rightSidebarContent,variant:e.rightSidebarVariant||"permanent",innerScroll:e.innerScroll,classes:s,ref:r,rootRef:c})))}));w.defaultProps={};var S=l.a.memo(w)},1322:function(e,t,a){"use strict";a.d(t,"b",(function(){return d})),a.d(t,"c",(function(){return b})),a.d(t,"d",(function(){return f}));var r=a(22),n=a(16),c=a.n(n),o=a(37),i=a(13),l=a(51),s=a.n(l),d=Object(i.b)("eCommerceApp/orders/getOrders",Object(o.a)(c.a.mark((function e(){var t,a;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.a.get("/api/e-commerce-app/orders");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),u=Object(i.c)({}),p=u.getSelectors((function(e){return e.eCommerceApp.orders})),b=p.selectAll,m=(p.selectById,Object(i.d)({name:"eCommerceApp/orders",initialState:u.getInitialState({searchText:""}),reducers:{setOrdersSearchText:{reducer:function(e,t){e.searchText=t.payload},prepare:function(e){return{payload:e.target.value||""}}}},extraReducers:Object(r.a)({},d.fulfilled,u.setAll)})),f=m.actions.setOrdersSearchText;t.a=m.reducer},1323:function(e,t,a){"use strict";a.d(t,"b",(function(){return d})),a.d(t,"c",(function(){return b})),a.d(t,"d",(function(){return f}));var r=a(22),n=a(16),c=a.n(n),o=a(37),i=a(13),l=a(51),s=a.n(l),d=Object(i.b)("eCommerceApp/products/getProducts",Object(o.a)(c.a.mark((function e(){var t,a;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.a.get("/api/e-commerce-app/products");case 2:return t=e.sent,e.next=5,t.data;case 5:return a=e.sent,e.abrupt("return",a);case 7:case"end":return e.stop()}}),e)})))),u=Object(i.c)({}),p=u.getSelectors((function(e){return e.eCommerceApp.products})),b=p.selectAll,m=(p.selectById,Object(i.d)({name:"eCommerceApp/products",initialState:u.getInitialState({searchText:""}),reducers:{setProductsSearchText:{reducer:function(e,t){e.searchText=t.payload},prepare:function(e){return{payload:e.target.value||""}}}},extraReducers:Object(r.a)({},d.fulfilled,u.setAll)})),f=m.actions.setProductsSearchText;t.a=m.reducer},1335:function(e,t,a){"use strict";a.d(t,"b",(function(){return p})),a.d(t,"d",(function(){return b})),a.d(t,"c",(function(){return f}));var r,n=a(22),c=a(16),o=a.n(c),i=a(37),l=a(13),s=a(51),d=a.n(s),u=a(34),p=Object(l.b)("eCommerceApp/product/getProduct",function(){var e=Object(i.a)(o.a.mark((function e(t){var a,r;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,d.a.get("/api/e-commerce-app/product",{params:t});case 2:return a=e.sent,e.next=5,a.data;case 5:return r=e.sent,e.abrupt("return",r);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),b=Object(l.b)("eCommerceApp/product/saveProduct",function(){var e=Object(i.a)(o.a.mark((function e(t){var a,r;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,d.a.post("/api/e-commerce-app/product/save",t);case 2:return a=e.sent,e.next=5,a.data;case 5:return r=e.sent,e.abrupt("return",r);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),m=Object(l.d)({name:"eCommerceApp/product",initialState:null,reducers:{newProduct:{reducer:function(e,t){return t.payload},prepare:function(e){return{payload:{id:u.a.generateGUID(),name:"",handle:"",description:"",categories:[],tags:[],images:[],priceTaxExcl:0,priceTaxIncl:0,taxRate:0,comparedPrice:0,quantity:0,sku:"",width:"",height:"",depth:"",weight:"",extraShippingFee:0,active:!0}}}}},extraReducers:(r={},Object(n.a)(r,p.fulfilled,(function(e,t){return t.payload})),Object(n.a)(r,b.fulfilled,(function(e,t){return t.payload})),r)}),f=m.actions.newProduct;t.a=m.reducer},1336:function(e,t,a){"use strict";a.d(t,"b",(function(){return u}));var r,n=a(22),c=a(16),o=a.n(c),i=a(37),l=a(13),s=a(51),d=a.n(s),u=Object(l.b)("eCommerceApp/order/getOrder",function(){var e=Object(i.a)(o.a.mark((function e(t){var a,r;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,d.a.get("/api/e-commerce-app/order",{params:t});case 2:return a=e.sent,e.next=5,a.data;case 5:return r=e.sent,e.abrupt("return",r);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),p=Object(l.b)("eCommerceApp/order/saveOrder",function(){var e=Object(i.a)(o.a.mark((function e(t){var a,r;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,d.a.post("/api/e-commerce-app/order/save",t);case 2:return a=e.sent,e.next=5,a.data;case 5:return r=e.sent,e.abrupt("return",r);case 7:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),b=Object(l.d)({name:"eCommerceApp/order",initialState:null,reducers:{},extraReducers:(r={},Object(n.a)(r,u.fulfilled,(function(e,t){return t.payload})),Object(n.a)(r,p.fulfilled,(function(e,t){return t.payload})),r)});t.a=b.reducer},1346:function(e,t,a){"use strict";var r=a(124),n=a(1336),c=a(1322),o=a(1335),i=a(1323),l=Object(r.c)({products:i.a,product:o.a,orders:c.a,order:n.a});t.a=l},2986:function(e,t,a){"use strict";a.r(t);var r=a(1246),n=a(258),c=a(0),o=a(1346),i=a(129),l=a(1170),s=a(547),d=a(574),u=a(221),p=a(1210),b=a(169),m=a(6),f=a(31),g=a(27),O=a(1323),j=a(1);var h=function(e){var t=Object(m.c)(),a=Object(m.d)((function(e){return e.eCommerceApp.products.searchText})),r=Object(m.d)(g.e);return Object(j.a)("div",{className:"flex flex-1 w-full items-center justify-between"},Object(j.a)("div",{className:"flex items-center"},Object(j.a)(i.a,{animation:"transition.expandIn",delay:300},Object(j.a)(s.a,{className:"text-32"},"shopping_basket")),Object(j.a)(i.a,{animation:"transition.slideLeftIn",delay:300},Object(j.a)(b.a,{className:"hidden sm:flex mx-0 sm:mx-12",variant:"h6"},"Products"))),Object(j.a)("div",{className:"flex flex-1 items-center justify-center px-12"},Object(j.a)(p.a,{theme:r},Object(j.a)(i.a,{animation:"transition.slideDownIn",delay:300},Object(j.a)(u.a,{className:"flex items-center w-full max-w-512 px-8 py-4 rounded-8",elevation:1},Object(j.a)(s.a,{color:"action"},"search"),Object(j.a)(d.a,{placeholder:"Search",className:"flex flex-1 mx-8",disableUnderline:!0,fullWidth:!0,value:a,inputProps:{"aria-label":"Search"},onChange:function(e){return t(Object(O.d)(e))}}))))),Object(j.a)(i.a,{animation:"transition.slideRightIn",delay:300},Object(j.a)(l.a,{component:f.a,to:"/apps/e-commerce/products/new",className:"whitespace-no-wrap normal-case",variant:"contained",color:"secondary"},Object(j.a)("span",{className:"hidden sm:flex"},"Add New Product"),Object(j.a)("span",{className:"flex sm:hidden"},"New"))))},x=a(14),v=a(35),w=a(9),S=a(1176),k=a(1318),y=a(1321),C=a(1306),N=a(1525),P=a(1320),I=a(3),T=a(52),A=a(441),R=a(399),H=a(1220),B=a(1173),W=a(445),q=a(1167),D=a(1128),z=a(1166),V=a(1319),E=a(1643),L=a(1171),M=[{id:"image",align:"left",disablePadding:!0,label:"",sort:!1},{id:"name",align:"left",disablePadding:!1,label:"Name",sort:!0},{id:"categories",align:"left",disablePadding:!1,label:"Category",sort:!0},{id:"priceTaxIncl",align:"right",disablePadding:!1,label:"Price",sort:!0},{id:"quantity",align:"right",disablePadding:!1,label:"Quantity",sort:!0},{id:"active",align:"right",disablePadding:!1,label:"Active",sort:!0}],_=Object(z.a)((function(e){return{actionsButtonWrapper:{background:e.palette.background.paper}}}));var F=function(e){var t=_(e),a=Object(c.useState)(null),r=Object(x.a)(a,2),n=r[0],o=r[1];function i(){o(null)}return Object(j.a)(V.a,null,Object(j.a)(P.a,{className:"h-64"},Object(j.a)(C.a,{padding:"none",className:"w-40 md:w-64 text-center z-99"},Object(j.a)(S.a,{indeterminate:e.numSelected>0&&e.numSelected<e.rowCount,checked:e.numSelected===e.rowCount,onChange:e.onSelectAllClick}),e.numSelected>0&&Object(j.a)("div",{className:Object(I.default)("flex items-center justify-center absolute w-64 top-0 ltr:left-0 rtl:right-0 mx-56 h-64 z-10 border-b-1",t.actionsButtonWrapper)},Object(j.a)(R.a,{"aria-owns":n?"selectedProductsMenu":null,"aria-haspopup":"true",onClick:function(e){o(e.currentTarget)}},Object(j.a)(s.a,null,"more_horiz")),Object(j.a)(W.a,{id:"selectedProductsMenu",anchorEl:n,open:Boolean(n),onClose:i},Object(j.a)(D.a,null,Object(j.a)(q.a,{onClick:function(){i()}},Object(j.a)(H.a,{className:"min-w-40"},Object(j.a)(s.a,null,"delete")),Object(j.a)(B.a,{primary:"Remove"})))))),M.map((function(t){return Object(j.a)(C.a,{className:"p-4 md:p-16",key:t.id,align:t.align,padding:t.disablePadding?"none":"default",sortDirection:e.order.id===t.id&&e.order.direction},t.sort&&Object(j.a)(L.a,{title:"Sort",placement:"right"===t.align?"bottom-end":"bottom-start",enterDelay:300},Object(j.a)(E.a,{active:e.order.id===t.id,direction:e.order.direction,onClick:(a=t.id,function(t){e.onRequestSort(t,a)})},t.label)));var a}),this)))};var U=Object(T.k)((function(e){var t=Object(m.c)(),a=Object(m.d)(O.c),r=Object(m.d)((function(e){return e.eCommerceApp.products.searchText})),n=Object(c.useState)(!0),o=Object(x.a)(n,2),i=o[0],l=o[1],d=Object(c.useState)([]),u=Object(x.a)(d,2),p=u[0],b=u[1],f=Object(c.useState)(a),g=Object(x.a)(f,2),h=g[0],T=g[1],R=Object(c.useState)(0),H=Object(x.a)(R,2),B=H[0],W=H[1],q=Object(c.useState)(10),D=Object(x.a)(q,2),z=D[0],V=D[1],E=Object(c.useState)({direction:"asc",id:null}),L=Object(x.a)(E,2),M=L[0],_=L[1];return Object(c.useEffect)((function(){t(Object(O.b)()).then((function(){return l(!1)}))}),[t]),Object(c.useEffect)((function(){0!==r.length?(T(w.a.filter(a,(function(e){return e.name.toLowerCase().includes(r.toLowerCase())}))),W(0)):T(a)}),[a,r]),i?Object(j.a)(A.a,null):Object(j.a)("div",{className:"w-full flex flex-col"},Object(j.a)(v.a,{className:"flex-grow overflow-x-auto"},Object(j.a)(k.a,{stickyHeader:!0,className:"min-w-xl","aria-labelledby":"tableTitle"},Object(j.a)(F,{numSelected:p.length,order:M,onSelectAllClick:function(e){e.target.checked?b(h.map((function(e){return e.id}))):b([])},onRequestSort:function(e,t){var a=t,r="desc";M.id===t&&"desc"===M.direction&&(r="asc"),_({direction:r,id:a})},rowCount:h.length}),Object(j.a)(y.a,null,w.a.orderBy(h,[function(e){switch(M.id){case"categories":return e.categories[0];default:return e[M.id]}}],[M.direction]).slice(B*z,B*z+z).map((function(t){var a=-1!==p.indexOf(t.id);return Object(j.a)(P.a,{className:"h-64 cursor-pointer",hover:!0,role:"checkbox","aria-checked":a,tabIndex:-1,key:t.id,selected:a,onClick:function(a){return r=t,void e.history.push("/apps/e-commerce/products/".concat(r.id,"/").concat(r.handle));var r}},Object(j.a)(C.a,{className:"w-40 md:w-64 text-center",padding:"none"},Object(j.a)(S.a,{checked:a,onClick:function(e){return e.stopPropagation()},onChange:function(e){return function(e,t){var a=p.indexOf(t),r=[];-1===a?r=r.concat(p,t):0===a?r=r.concat(p.slice(1)):a===p.length-1?r=r.concat(p.slice(0,-1)):a>0&&(r=r.concat(p.slice(0,a),p.slice(a+1))),b(r)}(0,t.id)}})),Object(j.a)(C.a,{className:"w-52 px-4 md:px-0",component:"th",scope:"row",padding:"none"},t.images.length>0&&t.featuredImageId?Object(j.a)("img",{className:"w-full block rounded",src:w.a.find(t.images,{id:t.featuredImageId}).url,alt:t.name}):Object(j.a)("img",{className:"w-full block rounded",src:"assets/images/ecommerce/product-image-placeholder.png",alt:t.name})),Object(j.a)(C.a,{className:"p-4 md:p-16",component:"th",scope:"row"},t.name),Object(j.a)(C.a,{className:"p-4 md:p-16 truncate",component:"th",scope:"row"},t.categories.join(", ")),Object(j.a)(C.a,{className:"p-4 md:p-16",component:"th",scope:"row",align:"right"},Object(j.a)("span",null,"$"),t.priceTaxIncl),Object(j.a)(C.a,{className:"p-4 md:p-16",component:"th",scope:"row",align:"right"},t.quantity,Object(j.a)("i",{className:Object(I.default)("inline-block w-8 h-8 rounded mx-8",t.quantity<=5&&"bg-red",t.quantity>5&&t.quantity<=25&&"bg-orange",t.quantity>25&&"bg-green")})),Object(j.a)(C.a,{className:"p-4 md:p-16",component:"th",scope:"row",align:"right"},t.active?Object(j.a)(s.a,{className:"text-green text-20"},"check_circle"):Object(j.a)(s.a,{className:"text-red text-20"},"remove_circle")))}))))),Object(j.a)(N.a,{className:"flex-shrink-0 border-t-1",component:"div",count:h.length,rowsPerPage:z,page:B,backIconButtonProps:{"aria-label":"Previous Page"},nextIconButtonProps:{"aria-label":"Next Page"},onChangePage:function(e,t){W(t)},onChangeRowsPerPage:function(e){V(e.target.value)}}))}));t.default=Object(n.a)("eCommerceApp",o.a)((function(){return Object(j.a)(r.a,{classes:{content:"flex",contentCard:"overflow-hidden",header:"min-h-72 h-72 sm:h-136 sm:min-h-136"},header:Object(j.a)(h,null),content:Object(j.a)(U,null),innerScroll:!0})}))}}]);