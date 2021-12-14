(this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[]).push([[174],{2922:function(e,a,t){"use strict";t.r(a);var n=t(140),o=t(169),c=t(0),s=t.n(c),r=t(1);a.default=function(){return Object(r.a)(s.a.Fragment,null,Object(r.a)(o.a,{variant:"h4",className:"mb-24"},"Code Splitting"),Object(r.a)(o.a,{className:"mb-16",component:"p"},"Code-splitting your app can help you \u201clazy-load\u201d just the things that are currently needed by the user, which can dramatically improve the performance of your app. While you haven\u2019t reduced the overall amount of code in your app, you\u2019ve avoided loading code that the user may never need, and reduced the amount of code needed during the initial load."),Object(r.a)(o.a,{className:"mt-32 mb-8",variant:"h5"},"Route-based code splitting"),Object(r.a)(o.a,{className:"mb-16",component:"p"},"We are using ",Object(r.a)("b",null,"React.lazy")," function to dynamically import component.",Object(r.a)("br",null),Object(r.a)("b",null,"FuseSuspense")," component is created to avoid the repetition of ",Object(r.a)("b",null,"React.Suspense "),"component defaults, which is used in the theme layouts.",Object(r.a)("br",null),"Check out the examples below to see dynamically or regular way of importing the components."),Object(r.a)("div",{className:"flex flex-wrap lg:-mx-4"},Object(r.a)("div",{className:"w-full lg:w-1/2 lg:px-4"},Object(r.a)(o.a,{className:"mt-32 mb-8",variant:"h6"},"Lazy Loaded Component:"),Object(r.a)(n.a,{component:"pre",className:"language-jsx my-16"},"\n                            import React from 'react';\n\n                            export const AnalyticsDashboardAppConfig = {\n                                settings: {\n                                    layout: {\n                                        config: {}\n                                    }\n                                },\n                                routes  : [\n                                    {\n                                        path     : '/apps/dashboards/analytics',\n                                        component: React.lazy(() => import('./AnalyticsDashboardApp'))\n                                    }\n                                ]\n                            };\n                            ")),Object(r.a)("div",{className:"w-full lg:w-1/2 lg:px-4"},Object(r.a)(o.a,{className:"mt-32 mb-8",variant:"h6"},"Regular Loaded Component:"),Object(r.a)(n.a,{component:"pre",className:"language-jsx my-16"},"\n                                    import AnalyticsDashboardApp from './AnalyticsDashboardApp';\n\n                                    export const AnalyticsDashboardAppConfig = {\n                                        settings: {\n                                            layout: {\n                                                config: {}\n                                            }\n                                        },\n                                        routes  : [\n                                            {\n                                                path     : '/apps/dashboards/analytics',\n                                                component: AnalyticsDashboardApp\n                                            }\n                                        ]\n                                    };\n                                  "))),Object(r.a)(o.a,{className:"mt-32 mb-8",variant:"h5"},"Code splitting the Redux reducers (Dynamically loaded reducers)"),Object(r.a)(o.a,{className:"mb-16",component:"p"},"We created Higher Order Component ",Object(r.a)("code",null,"withReducer")," to load redux reducer before the component render.",Object(r.a)("br",null),"You just need to pass the ",Object(r.a)("b",null,"key")," and the ",Object(r.a)("b",null,"reducer")," to the component."),Object(r.a)(n.a,{component:"pre",className:"language-jsx my-16"},"\n                              import withReducer from 'app/store/withReducer';\n                              import reducer from './store';\n                              .\n                              .\n                              export default withReducer('analyticsDashboardApp', reducer)(AnalyticsDashboardApp);\n                            "))}}}]);