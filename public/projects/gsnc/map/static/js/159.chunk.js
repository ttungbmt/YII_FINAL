(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[159],{1524:function(e,a,t){"use strict";t.d(a,"a",(function(){return b}));var c=t(14),s=t(169),n=t(3),o=t(120),r=t.n(o),l=t(0),u=t.n(l),i=t(1);function m(e){var a=e.onComplete,t=Object(l.useState)(r.a.isMoment(e.endDate)?e.endDate:r()(e.endDate)),o=Object(c.a)(t,1)[0],u=Object(l.useState)({days:0,hours:0,minutes:0,seconds:0}),m=Object(c.a)(u,2),b=m[0],d=m[1],j=Object(l.useRef)(),O=Object(l.useCallback)((function(){window.clearInterval(j.current),a&&a()}),[a]),f=Object(l.useCallback)((function(){var e=r()(),a=o.diff(e,"seconds");if(a<0)O();else{var t=r.a.duration(a,"seconds");d({days:t.asDays().toFixed(0),hours:t.hours(),minutes:t.minutes(),seconds:t.seconds()})}}),[O,o]);return Object(l.useEffect)((function(){return j.current=setInterval(f,1e3),function(){clearInterval(j.current)}}),[f]),Object(i.a)("div",{className:Object(n.default)("flex items-center",e.className)},Object(i.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(i.a)(s.a,{variant:"h4",className:"mb-4"},b.days),Object(i.a)(s.a,{variant:"caption",color:"textSecondary"},"days")),Object(i.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(i.a)(s.a,{variant:"h4",className:"mb-4"},b.hours),Object(i.a)(s.a,{variant:"caption",color:"textSecondary"},"hours")),Object(i.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(i.a)(s.a,{variant:"h4",className:"mb-4"},b.minutes),Object(i.a)(s.a,{variant:"caption",color:"textSecondary"},"minutes")),Object(i.a)("div",{className:"flex flex-col items-center justify-center px-12"},Object(i.a)(s.a,{variant:"h4",className:"mb-4"},b.seconds),Object(i.a)(s.a,{variant:"caption",color:"textSecondary"},"seconds")))}m.defaultProps={endDate:r()().add(15,"days")};var b=u.a.memo(m)},2839:function(e,a,t){"use strict";t.r(a);var c=t(1524),s=t(140),n=t(169),o=t(0),r=t.n(o),l=t(31),u=t(1);a.default=function(){return Object(u.a)(r.a.Fragment,null,Object(u.a)(n.a,{variant:"h4",className:"mb-24"},"FuseCountdown"),Object(u.a)(n.a,{className:"mb-16",component:"p"},Object(u.a)("code",null,"FuseCountdown")," is a custom-built Fuse component that allows you to create countdowns."),Object(u.a)(n.a,{className:"mt-32 mb-8",variant:"h5"},"Usage"),Object(u.a)(s.a,{component:"pre",className:"language-jsx"},'\n                              <FuseCountdown endDate="2020-07-28" className="my-48"/>\n                            '),Object(u.a)(n.a,{className:"mt-32 mb-8",variant:"h5"},"Preview"),Object(u.a)(c.a,{endDate:"2020-07-28",className:"my-48"}),Object(u.a)(n.a,{className:"mt-32 mb-8",variant:"h5"},"Demos"),Object(u.a)("ul",null,Object(u.a)("li",{className:"mb-8"},Object(u.a)(l.a,{to:"/pages/coming-soon"},"Coming Soon"))))}}}]);