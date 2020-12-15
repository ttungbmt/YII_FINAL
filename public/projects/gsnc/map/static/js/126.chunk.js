(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[126],{1310:function(t,e,a){"use strict";a.d(e,"f",(function(){return k})),a.d(e,"m",(function(){return A})),a.d(e,"l",(function(){return C})),a.d(e,"g",(function(){return S})),a.d(e,"h",(function(){return D})),a.d(e,"k",(function(){return B})),a.d(e,"i",(function(){return N})),a.d(e,"b",(function(){return T})),a.d(e,"e",(function(){return L})),a.d(e,"c",(function(){return z})),a.d(e,"j",(function(){return U})),a.d(e,"n",(function(){return J})),a.d(e,"a",(function(){return F}));var r,n=a(22),c=a(18),s=a(16),i=a.n(s),d=a(37),o=a(13),u=a(51),p=a.n(u),b=a(34),l=a(181),f=a(9),m=a(48),h=a(86),j=function t(e){Object(h.a)(this,t);var a=e||{};this.id=a.id||b.a.generateGUID(),this.name=a.name||"",this.description=a.description||"",this.idAttachmentCover=a.idAttachmentCover||"",this.idMembers=a.idMembers||[],this.idLabels=a.idLabels||[],this.attachments=a.attachments||[],this.subscribed=a.subscribed||!0,this.checklists=a.checklists||[],this.checkItems=a.checkItems||0,this.checkItemsChecked=a.checkItemsChecked||0,this.comments=a.comments||[],this.activities=a.activities||[],this.due=a.due||""},O=function t(e){Object(h.a)(this,t);var a=e||{};this.id=a.id||b.a.generateGUID(),this.name=a.name||"",this.idCards=[]},v=a(14),x=function(t,e,a){var r=Array.from(t),n=r.splice(e,1),c=Object(v.a)(n,1)[0];return r.splice(a,0,c),r},g=x,w=function(t,e,a){var r=f.a.find(t,{id:e.droppableId}),n=f.a.find(t,{id:a.droppableId}),c=r.idCards[e.index];if(e.droppableId===a.droppableId){var s=x(r.idCards,e.index,a.index);return t.map((function(t){return t.id===e.droppableId&&(t.idCards=s),t}))}return r.idCards.splice(e.index,1),n.idCards.splice(a.index,0,c),t.map((function(t){return t.id===e.droppableId?r:t.id===a.droppableId?n:t}))},y=a(1382),I=a(1338),k=Object(o.b)("scrumboardApp/board/getBoard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=a.dispatch,t.prev=1,t.next=4,p.a.get("/api/scrumboard-app/board",{params:e});case 4:return n=t.sent,t.next=7,n.data;case 7:return c=t.sent,t.abrupt("return",c);case 11:return t.prev=11,t.t0=t.catch(1),r(Object(m.c)({message:t.t0.response.data,autoHideDuration:2e3,anchorOrigin:{vertical:"top",horizontal:"right"}})),l.a.push({pathname:"/apps/scrumboard/boards"}),t.abrupt("return",null);case 16:case"end":return t.stop()}}),t,null,[[1,11]])})));return function(e,a){return t.apply(this,arguments)}}()),A=Object(o.b)("scrumboardApp/board/reorderList",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s,d,o,u;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=a.dispatch,n=a.getState,c=n().scrumboardApp.board,s=c.lists,d=g(f.a.merge([],s),e.source.index,e.destination.index),t.next=6,p.a.post("/api/scrumboard-app/list/order",{boardId:c.id,lists:d});case 6:return o=t.sent,t.next=9,o.data;case 9:return u=t.sent,r(Object(m.c)({message:"List Order Saved",autoHideDuration:2e3,anchorOrigin:{vertical:"top",horizontal:"right"}})),t.abrupt("return",u);case 12:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),C=Object(o.b)("scrumboardApp/board/reorderCard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s,d,o,u,b,l;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.source,n=e.destination,c=a.dispatch,s=a.getState,d=s().scrumboardApp.board,o=d.lists,u=w(f.a.merge([],o),r,n),t.next=7,p.a.post("/api/scrumboard-app/card/order",{boardId:d.id,lists:u});case 7:return b=t.sent,t.next=10,b.data;case 10:return l=t.sent,c(Object(m.c)({message:"Card Order Saved",autoHideDuration:2e3,anchorOrigin:{vertical:"top",horizontal:"right"}})),t.abrupt("return",l);case 13:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),S=Object(o.b)("scrumboardApp/board/newCard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s,d;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.listId,c=e.cardTitle,a.dispatch,a.getState,t.next=4,p.a.post("/api/scrumboard-app/card/new",{boardId:r,listId:n,data:new j({name:c})});case 4:return s=t.sent,t.next=7,s.data;case 7:return d=t.sent,t.abrupt("return",d);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),D=Object(o.b)("scrumboardApp/board/newList",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.listTitle,a.dispatch,a.getState,t.next=4,p.a.post("/api/scrumboard-app/list/new",{boardId:r,data:new O({name:n})});case 4:return c=t.sent,t.next=7,c.data;case 7:return s=t.sent,t.abrupt("return",s);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),B=Object(o.b)("scrumboardApp/board/renameList",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s,d;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.listId,c=e.listTitle,a.dispatch,a.getState,t.next=4,p.a.post("/api/scrumboard-app/list/rename",{boardId:r,listId:n,listTitle:c});case 4:return s=t.sent,t.next=7,s.data;case 7:return d=t.sent,t.abrupt("return",d);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),N=Object(o.b)("scrumboardApp/board/removeList",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.listId,a.dispatch,a.getState,t.next=4,p.a.post("/api/scrumboard-app/list/remove",{boardId:r,listId:n});case 4:return c=t.sent,t.next=7,c.data;case 7:return s=t.sent,t.abrupt("return",s);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),T=Object(o.b)("scrumboardApp/board/changeBoardSettings",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s,d;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return a.dispatch,r=a.getState,n=r().scrumboardApp.board,c=f.a.merge({},n.settings,e),t.next=5,p.a.post("/api/scrumboard-app/board/settings/update",{boardId:n.id,settings:c});case 5:return s=t.sent,t.next=8,s.data;case 8:return d=t.sent,t.abrupt("return",d);case 10:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),L=Object(o.b)("scrumboardApp/board/deleteBoard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return a.dispatch,a.getState,t.next=3,p.a.post("/api/scrumboard-app/board/delete",{boardId:e});case 3:return r=t.sent,l.a.push({pathname:"/apps/scrumboard/boards"}),t.next=7,r.data;case 7:return n=t.sent,t.abrupt("return",n);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),z=Object(o.b)("scrumboardApp/board/copyBoard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=a.dispatch,a.getState,n=f.a.merge({},e,{id:b.a.generateGUID(),name:"".concat(e.name," (Copied)"),uri:"".concat(e.uri,"-copied")}),r(Object(y.c)(n)),t.abrupt("return",n);case 4:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),U=Object(o.b)("scrumboardApp/board/renameBoard",function(){var t=Object(d.a)(i.a.mark((function t(e,a){var r,n,c,s;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.boardTitle,a.dispatch,a.getState,t.next=4,p.a.post("/api/scrumboard-app/board/rename",{boardId:r,boardTitle:n});case 4:return c=t.sent,t.next=7,c.data;case 7:return s=t.sent,t.abrupt("return",s);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),H=Object(o.d)({name:"scrumboardApp/boards",initialState:null,reducers:{resetBoard:function(t,e){return null},addLabel:function(t,e){t.labels=[].concat(Object(c.a)(t.labels),[e.payload])}},extraReducers:(r={},Object(n.a)(r,k.fulfilled,(function(t,e){return e.payload})),Object(n.a)(r,A.fulfilled,(function(t,e){t.lists=e.payload})),Object(n.a)(r,C.fulfilled,(function(t,e){t.lists=e.payload})),Object(n.a)(r,D.fulfilled,(function(t,e){t.lists=e.payload})),Object(n.a)(r,S.fulfilled,(function(t,e){return e.payload})),Object(n.a)(r,B.fulfilled,(function(t,e){var a=e.payload,r=a.listId,n=a.listTitle;t.lists=t.lists.map((function(t){return t.id===r&&(t.name=n),t}))})),Object(n.a)(r,N.fulfilled,(function(t,e){t.lists=f.a.reject(t.lists,{id:e.payload})})),Object(n.a)(r,T.fulfilled,(function(t,e){t.settings=e.payload})),Object(n.a)(r,L.fulfilled,(function(t,e){({})})),Object(n.a)(r,U.fulfilled,(function(t,e){t.name=e.payload})),Object(n.a)(r,I.e.fulfilled.type,(function(t,e){t.cards=t.cards.map((function(t){return t.id===e.payload.id?e.payload:t}))})),Object(n.a)(r,I.d.fulfilled,(function(t,e){var a=e.payload;t.cards=f.a.reject(t.cards,{id:a}),t.lists=t.lists.map((function(t){return f.a.set(t,"idCards",f.a.reject(t.idCards,(function(t){return t===a}))),t}))})),r)}),G=H.actions,J=G.resetBoard,F=G.addLabel;e.d=H.reducer},1338:function(t,e,a){"use strict";a.d(e,"e",(function(){return p})),a.d(e,"d",(function(){return b})),a.d(e,"c",(function(){return m})),a.d(e,"a",(function(){return h}));var r=a(22),n=a(16),c=a.n(n),s=a(37),i=a(13),d=a(51),o=a.n(d),u=a(48),p=Object(i.b)("scrumboardApp/card/updateCard",function(){var t=Object(s.a)(c.a.mark((function t(e,a){var r,n,s,i,d;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.card,s=a.dispatch,t.next=4,o.a.post("/api/scrumboard-app/card/update",{boardId:r,card:n});case 4:return i=t.sent,t.next=7,i.data;case 7:return d=t.sent,s(Object(u.c)({message:"Card Saved",autoHideDuration:2e3,anchorOrigin:{vertical:"top",horizontal:"right"}})),t.abrupt("return",d);case 10:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),b=Object(i.b)("scrumboardApp/card/removeCard",function(){var t=Object(s.a)(c.a.mark((function t(e,a){var r,n,s,i,d;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=e.boardId,n=e.cardId,s=a.dispatch,t.next=4,o.a.post("/api/scrumboard-app/card/remove",{boardId:r,cardId:n});case 4:return i=t.sent,t.next=7,i.data;case 7:return d=t.sent,s(h()),t.abrupt("return",d);case 10:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),l=Object(i.d)({name:"scrumboardApp/card",initialState:{dialogOpen:!1,data:null},reducers:{openCardDialog:function(t,e){t.dialogOpen=!0,t.data=e.payload},closeCardDialog:function(t,e){t.dialogOpen=!1,t.data=null}},extraReducers:Object(r.a)({},p.fulfilled,(function(t,e){t.data=e.payload}))}),f=l.actions,m=f.openCardDialog,h=f.closeCardDialog;e.b=l.reducer},1382:function(t,e,a){"use strict";a.d(e,"b",(function(){return h})),a.d(e,"c",(function(){return j})),a.d(e,"e",(function(){return x})),a.d(e,"d",(function(){return w}));var r=a(22),n=a(16),c=a.n(n),s=a(37),i=a(13),d=a(51),o=a.n(d),u=a(181),p=a(86),b=a(34),l=[{id:"26022e4129ad3a5sc28b36cd",name:"High Priority",class:"bg-red text-white"},{id:"56027e4119ad3a5dc28b36cd",name:"Design",class:"bg-orange text-white"},{id:"5640635e19ad3a5dc21416b2",name:"App",class:"bg-blue text-white"},{id:"6540635g19ad3s5dc31412b2",name:"Feature",class:"bg-green text-white"}],f=[{id:"56027c1930450d8bf7b10758",name:"Alice Freeman",avatar:"assets/images/avatars/alice.jpg"},{id:"26027s1930450d8bf7b10828",name:"Danielle Obrien",avatar:"assets/images/avatars/danielle.jpg"},{id:"76027g1930450d8bf7b10958",name:"James Lewis",avatar:"assets/images/avatars/james.jpg"},{id:"36027j1930450d8bf7b10158",name:"John Doe",avatar:"assets/images/avatars/Velazquez.jpg"}],m=function t(e){Object(p.a)(this,t);var a=e||{};this.name=a.name||"Untitled Board",this.uri=a.uri||"untitled-board",this.id=a.id||b.a.generateGUID(),this.settings=a.settings||{color:"",subscribed:!0,cardCoverImages:!0},this.lists=[],this.cards=[],this.members=a.members||f,this.labels=a.labels||l},h=Object(i.b)("scrumboardApp/boards/getBoards",Object(s.a)(c.a.mark((function t(){var e,a;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,o.a.get("/api/scrumboard-app/boards");case 2:return e=t.sent,t.next=5,e.data;case 5:return a=t.sent,t.abrupt("return",a);case 7:case"end":return t.stop()}}),t)})))),j=Object(i.b)("scrumboardApp/boards/newBoard",function(){var t=Object(s.a)(c.a.mark((function t(e,a){var r,n;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return a.dispatch,t.next=3,o.a.post("/api/scrumboard-app/board/new",{board:e||new m});case 3:return r=t.sent,t.next=6,r.data;case 6:return n=t.sent,u.a.push({pathname:"/apps/scrumboard/boards/".concat(n.id,"/").concat(n.handle)}),t.abrupt("return",n);case 9:case"end":return t.stop()}}),t)})));return function(e,a){return t.apply(this,arguments)}}()),O=Object(i.c)({}),v=O.getSelectors((function(t){return t.scrumboardApp.boards})),x=v.selectAll,g=(v.selectById,Object(i.d)({name:"scrumboardApp/boards",initialState:O.getInitialState({}),reducers:{resetBoards:function(t,e){}},extraReducers:Object(r.a)({},h.fulfilled,O.setAll)})),w=g.actions.resetBoards;e.a=g.reducer},1476:function(t,e,a){"use strict";var r=a(124),n=a(1310),c=a(1382),s=a(1338),i=Object(r.c)({boards:c.a,board:n.d,card:s.b});e.a=i},2821:function(t,e,a){"use strict";a.r(e);var r=a(129),n=a(153),c=a(547),s=a(1166),i=a(94),d=a(169),o=a(258),u=a(3),p=a(0),b=a(6),l=a(31),f=a(1476),m=a(1382),h=a(1),j=Object(s.a)((function(t){return{root:{background:t.palette.primary.main,color:t.palette.getContrastText(t.palette.primary.main)},board:{cursor:"pointer",boxShadow:t.shadows[0],transitionProperty:"box-shadow border-color",transitionDuration:t.transitions.duration.short,transitionTimingFunction:t.transitions.easing.easeInOut,background:t.palette.primary.dark,color:t.palette.getContrastText(t.palette.primary.dark),"&:hover":{boxShadow:t.shadows[6]}},newBoard:{borderWidth:2,borderStyle:"dashed",borderColor:Object(i.fade)(t.palette.getContrastText(t.palette.primary.main),.6),"&:hover":{borderColor:Object(i.fade)(t.palette.getContrastText(t.palette.primary.main),.8)}}}}));e.default=Object(o.a)("scrumboardApp",f.a)((function(t){var e=Object(b.c)(),a=Object(b.d)(m.e),s=j(t);return Object(p.useEffect)((function(){return e(Object(m.b)()),function(){e(Object(m.d)())}}),[e]),Object(h.a)("div",{className:Object(u.default)(s.root,"flex flex-grow flex-shrink-0 flex-col items-center")},Object(h.a)("div",{className:"flex flex-grow flex-shrink-0 flex-col items-center container px-16 md:px-24"},Object(h.a)(r.a,null,Object(h.a)(d.a,{className:"mt-44 sm:mt-88 sm:py-24 text-32 sm:text-40 font-300",color:"inherit"},"Scrumboard App")),Object(h.a)("div",null,Object(h.a)(n.a,{className:"flex flex-wrap w-full justify-center py-32 px-16",enter:{animation:"transition.slideUpBigIn",duration:300}},a.map((function(t){return Object(h.a)("div",{className:"w-224 h-224 p-16",key:t.id},Object(h.a)(l.a,{to:"/apps/scrumboard/boards/".concat(t.id,"/").concat(t.uri),className:Object(u.default)(s.board,"flex flex-col items-center justify-center w-full h-full rounded py-24"),role:"button"},Object(h.a)(c.a,{className:"text-56"},"assessment"),Object(h.a)(d.a,{className:"text-16 font-300 text-center pt-16 px-32",color:"inherit"},t.name)))})),Object(h.a)("div",{className:"w-224 h-224 p-16"},Object(h.a)("div",{className:Object(u.default)(s.board,s.newBoard,"flex flex-col items-center justify-center w-full h-full rounded py-24"),onClick:function(){return e(Object(m.c)())},onKeyDown:function(){return e(Object(m.c)())},role:"button",tabIndex:0},Object(h.a)(c.a,{className:"text-56"},"add_circle"),Object(h.a)(d.a,{className:"text-16 font-300 text-center pt-16 px-32",color:"inherit"},"Add new board")))))))}))}}]);