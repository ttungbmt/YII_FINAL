(this["webpackJsonpreact-app"]=this["webpackJsonpreact-app"]||[]).push([[12],{1176:function(e,t,a){"use strict";var n=a(17),r=a(50),c=a.n(r),l=a(48),o=a(1),i=a.n(o),u=a(1210),m=a(1178),s=(a(1182),function(e){return e?Object(n.k)(e)?e:Object(n.u)(e,(function(e,t){return{value:t,label:e}})):[]}),d=function(e){var t=e.url,a=e.depends,r=e.ajaxSettings,i=e.placeholder,u=void 0===i?"Ch\u1ecdn...":i,s=e.name,d=(Object(l.a)(e,["url","depends","ajaxSettings","placeholder","name"]),Object(m.c)().control);Object(o.useEffect)((function(){if(t&&a){var e=Object(n.h)(d,"fieldsRef.current.".concat(s,".ref"));c()(e).depdrop({depends:a,url:t,loadingText:"\u0110ang t\u1ea3i ...",placeholder:u,emptyMsg:"Kh\xf4ng c\xf3 d\u1eef li\u1ec7u",ajaxSettings:r})}}),[])};var f=Object(o.memo)((function(e){var t=e.register,a=e.children,r=e.options,c=Object(l.a)(e,["register","children","options"]);d(c);var o=s(r),m=Object(n.x)(c,["ajaxSettings"]);return i.a.createElement(u.a.Control,Object.assign({as:"select",ref:t},m,{defaultValue:c.selected}),o.length>1&&i.a.createElement("option",{value:""},c.placeholder),a,Object(n.u)(o,(function(e,t){var a=e.value,n=e.label;return i.a.createElement("option",{key:t,value:a},n)})))}));a(1183),a(1184),a(1185);var b=Object(o.memo)((function(e){var t=e.register,a=(e.children,Object(l.a)(e,["register","children"]));return function(e,t){var a=e.as,r=e.name,l=Object(m.c)(),i=l.control,u=l.setValue;Object(o.useEffect)((function(){if("datepicker"===a){t.current=Object(n.h)(i,"fields.".concat(r,".ref"));c()(t.current).datepicker({format:"dd/mm/yyyy",todayBtn:"linked",clearBtn:!0,language:"vi",autoclose:!0,todayHighlight:!0}).on("changeDate",(function(e){return u(e.target.value)}))}return function(){"datepicker"===a&&c()(t.current).datepicker("destroy")}}),[])}(a,Object(o.useRef)(a)),i.a.createElement(u.a.Control,Object.assign({ref:t},Object(n.x)(a,["as"])))}));var p=Object(o.memo)((function(e){var t=e.children,a=e.label,n=e.as,r=Object(l.a)(e,["children","label","as"]),c=Object(m.c)().register,o=function(){return i.a.createElement(i.a.Fragment,null)};switch(n){case"select":o=f;break;case"datepicker":case"input":default:o=b}return i.a.createElement(u.a.Group,null,i.a.createElement(u.a.Label,null,a),i.a.createElement(o,Object.assign({register:c},r,{as:n}),t))}));a.d(t,"b",(function(){return h})),a.d(t,"c",(function(){return g})),a.d(t,"a",(function(){return p}));var h=function(e,t){var a=t.control,r=t.register,c=t.setValue;Object(n.u)(e,(function(e,t){Object(n.h)(a,"fieldsRef.current.".concat(t,".ref"))||r(t),c(t,e)}))},g=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"#btn-submit-form";return c()(e).trigger("click")}},1177:function(e,t,a){"use strict";a.d(t,"a",(function(){return d}));var n=a(187),r=a(38),c=a(48),l=a(1),o=a.n(l),i=a(136),u=a(17),m=a(232),s=a.n(m),d=o.a.createContext(),f={key:null,url:"",page:1,values:{},data:{},filter:"",fields:[]},b={show:!1,loading:!1,forms:{}},p={setLoading:function(e,t){e.loading=t},createForm:function(e,t){var a=t.key,n=Object(c.a)(t,["key"]);e.forms[a]||(e.forms[a]=Object(r.a)({},f,{key:a},n))},nextPage:function(e,t){var a=t.key;Object(c.a)(t,["key"]);e.forms[a].page=e.forms[a].page+1},prevPage:function(e,t){var a=t.key;Object(c.a)(t,["key"]);e.forms[a].page=1===e.forms[a].page?1:e.forms[a].page-1},setShow:function(e,t){e.show=t},setFormData:function(e,t){var a=t.key,n=t.data;a&&n&&(e.forms[a]=Object(r.a)({},e.forms[a],{},n))},setFormValues:function(e,t){var a=t.key,n=t.values;e.forms[a]?e.forms[a].values=n:e.forms[a]=Object(r.a)({},f,{key:a,values:n})},setFormFields:function(e,t){var a=t.key,n=t.fields;e.forms[a].fields=n},refreshData:function(e,t){var a=t.key;e.forms[a].page=1,e.forms[a].values={}}},h=function(e,t){return p[t.type]&&p[t.type](e,t.payload)};t.b=Object(l.memo)((function(e){var t=e.children,a=Object(i.b)(h,b),c=Object(n.a)(a,2),l=c[0],m=c[1],f=Object(u.v)(p,(function(e,t){return function(e){return m({type:t,payload:e})}})),g=function(e){var t=e.actions,a=function(e){var a=e.form;if(a){t.setLoading(!0);var n=Object(r.a)({},a.values,{page:a.page});s.a.get(a.url,{params:n}).then((function(e){var n=e.data;t.setFormData({key:a.key,data:n}),t.setLoading(!1)}))}};return{fetchColumns:function(e){t.setLoading(!0),s.a.get("".concat(e.url,"?columns")).then((function(a){var n=a.data;t.createForm({key:e.key,url:e.url,columns:n.columns,filter:n.form})}))},fetchData:a,fetchForm:function(e,a,n){var r=e.form,c=e.values;r&&(t.setLoading(!0),s.a.post(r.url,c).then((function(e){var a=e.data;t.setFormData({key:r.key,data:a}),n&&n(a),t.setLoading(!1)})))},refreshData:function(e){return a({form:Object(r.a)({},Object(u.A)(e.form,["key","url"]),{page:1})})}}}({actions:f}),v=Object(r.a)({},l,{actions:Object(r.a)({},f,{},g),getForm:function(e){return Object(u.h)(l,"forms.".concat(e),{})}});return o.a.createElement(d.Provider,{value:v},t)}))},1179:function(e,t,a){"use strict";var n=a(1),r=a.n(n),c=a(152),l=a(1166),o=a(1204),i=a(614),u=a(50),m=a.n(u),s=a(17),d=a(264),f=a(1176),b=a(1177);var p=Object(n.memo)((function(e){var t=e.html,a=e.name,u=e.form,p=e.methods,h=Object(n.useContext)(b.a),g=h.show,v=h.actions,E=function(){return m()("#filterForm").find("form")};return Object(c.b)((function(){u.fields&&u.fields.map((function(e){return p.register(e)}))})),Object(c.c)((function(){g&&Object(s.m)(u.fields)&&v.setFormFields({key:a,fields:Object(s.s)(E().inputValues())})}),[g]),r.a.createElement(l.a,{id:"filterForm",show:g,onHide:function(){return v.setShow(!1)},onEntered:function(){var e=p.getValues();E().inputValues(e),m()("#drop-phuong1").on("depdrop:afterChange",(function(t,a,n,r,c){E().inputValues({maphuong:e.maphuong})}))}},r.a.createElement(l.a.Header,{closeButton:!0,style:{padding:"10px 10px",borderBottom:"1px solid #ddd"}},r.a.createElement(l.a.Title,{className:"font-weight-semibold",style:{fontSize:17}},r.a.createElement("i",{className:"icon-filter4 mr-2"})," B\u1ed9 l\u1ecdc")),r.a.createElement(l.a.Body,null,r.a.createElement(d.f,{html:t})),r.a.createElement(l.a.Footer,null,r.a.createElement(o.a,null,r.a.createElement(i.a,{variant:"light",onClick:function(){var e=m()("#filterForm").find("form").get(0);e&&e.reset(),p.reset(),Object(f.c)(),v.setShow(!1)},size:"sm"},"X\xf3a"),r.a.createElement(i.a,{variant:"primary",onClick:function(){Object(f.b)(E().inputValues(),p),Object(f.c)(),v.setShow(!1)},size:"sm"},"L\u1ecdc"))))})),h=a(1210),g=a(1205),v=a(1190),E=a(265);var j=Object(n.memo)((function(e){var t=e.handleSubmit,a=(e.register,e.onSubmit),n=E.b.getCat("dm_quan"),c=E.b.getCat("dm_phuong"),l=function(e){"maquan"===e.target.name?m()("#drop-phuong").on("depdrop:afterChange",(function(e,t,a,n,r){Object(f.c)()})):Object(f.c)()};return r.a.createElement(h.a,{onSubmit:t(a)},r.a.createElement("div",{style:{padding:"10px 10px 0 10px"}},r.a.createElement(g.a,null,r.a.createElement(v.a,{md:6},r.a.createElement(f.a,{id:"drop-quan",as:"select",label:"Qu\u1eadn huy\u1ec7n",name:"maquan",placeholder:"Ch\u1ecdn qu\u1eadn huy\u1ec7n...",onChange:l,options:n})),r.a.createElement(v.a,{md:6},r.a.createElement(f.a,{id:"drop-phuong",as:"select",label:"Ph\u01b0\u1eddng x\xe3",name:"maphuong",placeholder:"Ch\u1ecdn ph\u01b0\u1eddng x\xe3...",options:c,depends:["drop-quan"],onChange:l,url:"/api/dm/phuong?role=true"})))),r.a.createElement("input",{id:"btn-submit-form",type:"submit",className:"d-none"}))})),O=a(1206);var y=Object(n.memo)((function(e){var t=e.form,a=e.name,c=e.methods,l=e.pageQl,o=Object(n.useContext)(b.a).actions,i=[{title:"\u0110\u1ebfn trang qu\u1ea3n l\xfd",icon:"icon-link2",href:l},{title:"B\u1ed9 l\u1ecdc",icon:"icon-filter4",onClick:function(){return o.setShow(!0)}},{title:"T\u1ea3i l\u1ea1i trang",icon:"icon-reset",onClick:function(){c.reset(),o.refreshData({form:t})}}];return r.a.createElement(r.a.Fragment,null,r.a.createElement(F,{items:i}),r.a.createElement("div",{className:"ml-auto"},r.a.createElement(d.i,{title:"Trang tr\u01b0\u1edbc"},r.a.createElement("button",{onClick:function(){return o.prevPage({key:a})}},r.a.createElement("i",{className:"icon-square-left"})))),r.a.createElement("div",{className:"align-self-center pl-1 pr-1"},r.a.createElement(O.a,{variant:"success"},t.page)),r.a.createElement("div",null,r.a.createElement(d.i,{title:"Trang ti\u1ebfp theo"},r.a.createElement("button",{onClick:function(){return o.nextPage({key:a})}},r.a.createElement("i",{className:"icon-square-right"})))))})),k=a(1167);var x=Object(n.memo)((function(e){var t=e.items;return r.a.createElement(k.a,{display:"flex",width:"100%"},t.map((function(e,t){var a=e.className,n=e.title,c=e.icon,l=e.onClick,o=e.visible;return(void 0===o||o)&&r.a.createElement("div",{key:t,className:a},r.a.createElement(d.i,{title:n,key:t},r.a.createElement("button",{onClick:l},r.a.createElement("i",{className:c}))))})))})),C=a(48),N=a(213);var w=Object(n.memo)((function(e){var t=e.title,a=e.onClick,n=e.icon,c=e.href,l=e.to,o=(e.link,function(e){e.stopPropagation(),a&&a(e)}),i=r.a.createElement("button",{onClick:o},r.a.createElement("i",{className:n}));return l&&(i=r.a.createElement(N.a,{to:l,onClick:o},r.a.createElement("i",{className:n}))),c&&(i=r.a.createElement("button",{onClick:function(){return window.open(c)}},r.a.createElement("i",{className:n}))),t?r.a.createElement(d.i,{title:t},i):i}));var F=Object(n.memo)((function(e){return e.items.map((function(e,t){var a=e.className,n=Object(C.a)(e,["className"]);return r.a.createElement("div",{className:a,key:t},r.a.createElement(w,n))}))}));a.d(t,"b",(function(){return p})),a.d(t,"c",(function(){return j})),a.d(t,"d",(function(){return y})),a.d(t,"e",(function(){return x})),a.d(t,"f",(function(){return F})),a.d(t,"a",(function(){return w}))},1214:function(e,t,a){"use strict";a.r(t);var n=a(38),r=a(48),c=a(164),l=a(1),o=a.n(l),i=a(71),u=a(152),m=a(233),s=a(1178),d=a(17),f=a(1206),b=a(1116),p=a(1167),h=a(84),g=a(39),v=a.n(g),E=a(1179),j=a(1210),O=a(1205),y=a(1190),k=a(1176),x=a(264),C=a(265);var N=Object(l.memo)((function(e){var t=e.handleSubmit,a=(e.register,e.onSubmit),n=e.onReset,r=e.loading,c=C.b.getCat("dm_quan"),l=C.b.getCat("dm_phuong");return o.a.createElement(j.a,{onSubmit:t(a)},o.a.createElement("div",{style:{padding:"10px 10px 0 10px"}},o.a.createElement(O.a,null,o.a.createElement(y.a,{md:6},o.a.createElement(k.a,{id:"drop-quan",as:"select",label:"Qu\u1eadn huy\u1ec7n",name:"maquan",placeholder:"Ch\u1ecdn qu\u1eadn huy\u1ec7n...",options:c})),o.a.createElement(y.a,{md:6},o.a.createElement(k.a,{id:"drop-phuong",as:"select",label:"Ph\u01b0\u1eddng x\xe3",name:"maphuong",placeholder:"Ch\u1ecdn ph\u01b0\u1eddng x\xe3...",options:l,depends:["drop-quan"],url:"/api/dm/phuong?role=true"}))),o.a.createElement(O.a,null,o.a.createElement(y.a,{md:6},o.a.createElement(k.a,{as:"datepicker",label:"Th\u1eddi gian",name:"date_from",placeholder:"T\u1eeb ng\xe0y"})),o.a.createElement(y.a,{md:6},o.a.createElement(k.a,{as:"datepicker",label:"\xa0",name:"date_to",placeholder:"\u0110\u1ebfn ng\xe0y"}))),o.a.createElement("div",{className:"text-right"},o.a.createElement(x.e,{variant:"contained",className:"mr-1",onClick:n},"X\xf3a"),o.a.createElement(x.d,{id:"btn-submit-form",type:"submit",loading:r},"T\xecm ki\u1ebfm"))),o.a.createElement("div",{className:"clearfix"}),o.a.createElement("hr",{className:"m-2"}))})),w=a(1177),F=a(302);function _(){var e=Object(c.a)(["\n    .row-item {\n        cursor: pointer;\n        border-bottom: 1px solid #dfdfdf;\n        &:hover {background: hsla(0, 0%, 92%, 0.8)};\n        &.active {background: #ffeee8}\n        > div {\n            padding: 10px 7px;\n        }\n        .divider { padding: 10px 0; }\n        .info-soca { width: 32px;};\n    }\n"]);return _=function(){return e},e}var S=h.b.div(_()),q=Object(l.memo)((function(e){var t=e.id,a=e.selected,c=e.cabenhs,l=(Object(r.a)(e,["id","selected","cabenhs"]),Object(i.useDispatch)()),u=Object(d.i)(c)||{},s=Object(d.t)(c)||{},b=function(e){return Object(n.a)({},e,{id:t,props:{soca:c.length,ngaymacbenh_1:Object(d.h)(Object(d.i)(c),"ngaymacbenh_nv"),ngaymacbenh_last:Object(d.h)(Object(d.t)(c),"ngaymacbenh_nv")}})};return o.a.createElement(p.a,{display:"flex",className:v()("row-item",{active:a}),onClick:function(){return l(m.a.clickOdich(b()))}},o.a.createElement(p.a,null,o.a.createElement(f.a,{variant:"primary"},t)),o.a.createElement(p.a,null,o.a.createElement(E.a,{title:"Xem chi ti\u1ebft",icon:"icon-eye8",onClick:function(){return l(m.a.clickOdich(b({redirect:"/maps/odich/view/"+t})))}})),o.a.createElement(p.a,{display:"flex"},o.a.createElement(p.a,null,o.a.createElement("div",{className:"info-soca"},o.a.createElement(f.a,{pill:!0,variant:"success"},c.length))),o.a.createElement(p.a,null,o.a.createElement("div",{className:"font-weight-semibold"},u.hoten),o.a.createElement("div",{className:"text-muted"},u.ngaymacbenh_nv))),o.a.createElement(p.a,{className:"divider"},"|"),o.a.createElement(p.a,null,o.a.createElement("div",null,s.hoten),o.a.createElement("div",{className:"text-muted"},s.ngaymacbenh_nv)))})),D="odich_auto";t.default=Object(l.memo)((function(e){var t=e.SidebarLayout,a=e.defaultValues,r=Object(i.useDispatch)(),c=Object(l.useContext)(w.a),d=c.getForm,f=c.actions,p=c.loading,h=d(D),g=(Object(i.useSelector)(m.c.getOdich)||[]).filter((function(e){return e.id})),v=Object(s.b)({defaultValues:Object(n.a)({},a,{date_from:Object(F.a)().subtract(3,"months").format("L"),date_to:Object(F.a)().format("L")})});return Object(u.b)((function(){h.values&&Object(k.b)(h.values,v)})),o.a.createElement(s.a,v,o.a.createElement(t,{title:"Danh s\xe1ch \u1ed5 d\u1ecbch (".concat(g.length,")"),icon:"icon-list-numbered",content:o.a.createElement(o.a.Fragment,null,o.a.createElement(S,null,o.a.createElement(N,Object.assign({form:h},v,{onSubmit:function(e){f.setFormValues({key:D,values:e}),f.fetchForm({form:{url:"/api/odich/tim-odich?table=cabenh_sxh"},values:Object(n.a)({},e,{ngmacbenh_from:e.date_from,ngmacbenh_to:e.date_to,distance:200,day1:14,day2:30,table:"cabenh_sxh"})},{},(function(e){r(m.a.createAutoOD(e))}))},onReset:function(){r(m.a.removeAll())},loading:p})),p?o.a.createElement(b.a,{className:"m-2",animated:!0,now:100}):g.map((function(e,t){return o.a.createElement(q,Object.assign({key:t},e))}))))}))}))}}]);
//# sourceMappingURL=12.chunk.js.map