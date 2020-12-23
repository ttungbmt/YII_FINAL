(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[160],{1524:function(e,a,t){"use strict";t.d(a,"a",(function(){return b}));var c=t(14),s=t(169),n=t(3),r=t(120),l=t.n(r),i=t(0),o=t.n(i),u=t(1);function m(e){var a=e.onComplete,t=Object(i.useState)(l.a.isMoment(e.endDate)?e.endDate:l()(e.endDate)),r=Object(c.a)(t,1)[0],o=Object(i.useState)({days:0,hours:0,minutes:0,seconds:0}),m=Object(c.a)(o,2),b=m[0],d=m[1],f=Object(i.useRef)(),j=Object(i.useCallback)((function(){window.clearInterval(f.current),a&&a()}),[a]),O=Object(i.useCallback)((function(){var e=l()(),a=r.diff(e,"seconds");if(a<0)j();else{var t=l.a.duration(a,"seconds");d({days:t.asDays().toFixed(0),hours:t.hours(),minutes:t.minutes(),seconds:t.seconds()})}}),[j,r]);return Object(i.useEffect)((function(){return f.current=setInterval(O,1e3),function(){clearInterval(f.current)}}),[O]),Object(u.a)("div",{className:Object(n.default)("flex items-center",e.className)},Object(u.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(u.a)(s.a,{variant:"h4",className:"mb-4"},b.days),Object(u.a)(s.a,{variant:"caption",color:"textSecondary"},"days")),Object(u.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(u.a)(s.a,{variant:"h4",className:"mb-4"},b.hours),Object(u.a)(s.a,{variant:"caption",color:"textSecondary"},"hours")),Object(u.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(u.a)(s.a,{variant:"h4",className:"mb-4"},b.minutes),Object(u.a)(s.a,{variant:"caption",color:"textSecondary"},"minutes")),Object(u.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(u.a)(s.a,{variant:"h4",className:"mb-4"},b.seconds),Object(u.a)(s.a,{variant:"caption",color:"textSecondary"},"seconds")))}m.defaultProps={endDate:l()().add(15,"days")};var b=o.a.memo(m)},2936:function(e,a,t){"use strict";t.r(a);var c=t(129),s=t(1524),n=t(151),r=t(1170),l=t(1218),i=t(1222),o=t(1217),u=t(1166),m=t(94),b=t(1174),d=t(169),f=t(3),j=(t(0),t(1)),O=Object(u.a)((function(e){return{root:{background:"radial-gradient(".concat(Object(m.darken)(e.palette.primary.dark,.5)," 0%, ").concat(e.palette.primary.dark," 80%)"),color:e.palette.primary.contrastText}}}));a.default=function(){var e=O(),a=Object(n.c)({email:""}),t=a.form,u=a.handleChange,m=a.resetForm;return Object(j.a)("div",{className:Object(f.default)(e.root,"flex flex-col flex-auto flex-shrink-0 items-center justify-center p-32")},Object(j.a)("div",{className:"flex flex-col items-center justify-center w-full"},Object(j.a)(c.a,{animation:"transition.expandIn"},Object(j.a)(l.a,{className:"w-full max-w-384 rounded-8"},Object(j.a)(i.a,{className:"flex flex-col items-center justify-center p-32 text-center"},Object(j.a)("img",{className:"w-128 m-32",src:"assets/images/logos/fuse.svg",alt:"logo"}),Object(j.a)(d.a,{variant:"subtitle1",className:"mb-16"},"Hey! Thank you for checking out our app."),Object(j.a)(d.a,{color:"textSecondary",className:"max-w-288"},"It\u2019s not quite ready yet, but we are working hard and it will be ready in approximately:"),Object(j.a)(s.a,{endDate:"2023-07-28",className:"my-48"}),Object(j.a)(o.a,{className:"w-48"}),Object(j.a)(d.a,{className:"font-bold my-32 w-full"},"If you would like to be notified when the app is ready, you can subscribe to our e-mail list."),Object(j.a)("form",{name:"subscribeForm",noValidate:!0,className:"flex flex-col justify-center w-full",onSubmit:function(e){e.preventDefault(),m()}},Object(j.a)(b.a,{className:"mb-16",label:"Email",autoFocus:!0,type:"email",name:"email",value:t.email,onChange:u,variant:"outlined",required:!0,fullWidth:!0}),Object(j.a)(r.a,{variant:"contained",color:"primary",className:"w-224 mx-auto my-16","aria-label":"Subscribe",disabled:!(t.email.length>0),type:"submit"},"SUBSCRIBE")))))))}}}]);