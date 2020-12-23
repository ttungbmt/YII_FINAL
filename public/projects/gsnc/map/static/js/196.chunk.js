(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[196],{2914:function(t,a,e){"use strict";e.r(a);var n=e(140),s=e(169),o=e(0),c=e.n(o),l=e(1);a.default=function(){return Object(l.a)(c.a.Fragment,null,Object(l.a)(s.a,{variant:"h4",className:"mb-24"},"Changing default font"),Object(l.a)(s.a,{className:"mb-16",component:"p"},"There is two way to inject font-family."),Object(l.a)("ul",{className:"list-decimal ml-16"},Object(l.a)("li",null,Object(l.a)(s.a,{className:"mb-24"},"You can add the font link inside head of the public/index.html."),Object(l.a)(n.a,{component:"pre",className:"language-html mb-24"},'\n                          <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=vietnamese" rel="stylesheet">\n                        ')),Object(l.a)("li",null,Object(l.a)(s.a,{className:"mb-24"},"You can install typeface font package and import like we do at src/index.js"),Object(l.a)(n.a,{component:"pre",className:"language-jsx mb-24"},"\n                            import 'typeface-roboto';\n                        "))),Object(l.a)(s.a,{className:"mt-16 mb-8",component:"p"},"You need to add ",Object(l.a)("code",null,"typography.fontFamily")," values into the desired theme config at"," ",Object(l.a)("code",null,"src/app/fuse-configs/themesConfig")),Object(l.a)(n.a,{component:"pre",className:"language-jsx mb-24"},"\n\t\t\t\t\tdefault    : {\n\t\t\t\t\t  typography: {\n\t\t\t\t\t\tfontFamily: [\n\t\t\t\t\t\t\t'Roboto',\n\t\t\t\t\t\t\t'\"Helvetica\"',\n\t\t\t\t\t\t\t'Arial',\n\t\t\t\t\t\t\t'sans-serif'\n\t\t\t\t\t\t].join(','),\n\t\t\t\t"),Object(l.a)(s.a,{className:"mt-16 mb-8",component:"p"},"There is also font-family assignment at ",Object(l.a)("code",null,"src/styles/index.css")),Object(l.a)(n.a,{component:"pre",className:"language-css mb-24"},"\n\t\t\t\t\thtml {\n\t\t\t\t\t\tfont-size: 62.5%;\n\t\t\t\t\t\tfont-family: Roboto, Helvetica Neue, Arial, sans-serif;\n\t\t\t\t\t\tbackground-color: #121212;\n\t\t\t\t\t}\n\t\t\t\t"))}}}]);