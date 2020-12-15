<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Fuse React - Material design admin template with pre-built apps and pages">
    <meta name="keywords"
          content="React,Redux,Material UI Next,Material,Material Design,Google Material Design,HTML,CSS,Firebase,Authentication,Material Redux Theme,Material Redux Template">
    <meta name="author" content="Withinpixels">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <base href="/">
    <!--
      manifest.json provides metadata used when your web app is added to the
      homescreen on Android. See https://developers.google.com/web/fundamentals/engage-and-retain/web-app-manifest/
    -->
    <link rel="manifest" href="/projects/gsnc/map/manifest.json">
    <link rel="shortcut icon" href="/projects/gsnc/map/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=vietnamese" rel="stylesheet">

    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

    <!--        You can choose main icon from variety of the material ui icon fonts-->
    <link href="/projects/gsnc/map/assets/fonts/material-design-icons/MaterialIconsOutlined.css" rel="stylesheet">
    <!--        <link href="/projects/gsnc/map/assets/fonts/material-design-icons/MaterialIcons.css" rel="stylesheet">-->
    <!--        <link href="/projects/gsnc/map/assets/fonts/material-design-icons/MaterialIconsRound.css" rel="stylesheet">-->
    <!--        <link href="/projects/gsnc/map/assets/fonts/material-design-icons/MaterialIconsSharp.css" rel="stylesheet">-->
    <!--        <link href="/projects/gsnc/map/assets/fonts/material-design-icons/MaterialIconsTwoTone.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/gh/ttungbmt/fontawesome-pro/css/all.min.css" rel="stylesheet">

    <link href="/projects/gsnc/map/assets/fonts/meteocons/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

    <noscript id="jss-insertion-point"></noscript>
    <!--
      Notice the use of /projects/gsnc/map in the tags above.
      It will be replaced with the URL of the `public` folder during the build.
      Only files inside the `public` folder can be referenced from the HTML.

      Unlike "/favicon.ico" or "favicon.ico", "/projects/gsnc/map/favicon.ico" will
      work correctly both with client-side routing and a non-root public URL.
      Learn how to configure a non-root public URL by running `npm run build`.
    -->
    <title>Fuse React - Material Design Admin Template</title>

    <!-- FUSE Splash Screen CSS -->
    <style type="text/css">
        #fuse-splash-screen {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #F7F7F7;
            z-index: 99999;
            pointer-events: none;
        }

        #fuse-splash-screen .center {
            display: block;
            width: 100%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        #fuse-splash-screen .logo {
            width: 128px;
            margin: 0 auto;
        }

        #fuse-splash-screen .logo img {
            filter: drop-shadow(0px 10px 6px rgba(0, 0, 0, 0.2))
        }

        #fuse-splash-screen .spinner-wrapper {
            display: block;
            position: relative;
            width: 100%;
            min-height: 100px;
            height: 100px;
        }

        #fuse-splash-screen .spinner-wrapper .spinner {
            position: absolute;
            overflow: hidden;
            left: 50%;
            margin-left: -50px;
            animation: outer-rotate 2.91667s linear infinite;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner {
            width: 100px;
            height: 100px;
            position: relative;
            animation: sporadic-rotate 5.25s cubic-bezier(0.35, 0, 0.25, 1) infinite;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .gap {
            position: absolute;
            left: 49px;
            right: 49px;
            top: 0;
            bottom: 0;
            border-top: 10px solid;
            box-sizing: border-box;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .left,
        #fuse-splash-screen .spinner-wrapper .spinner .inner .right {
            position: absolute;
            top: 0;
            height: 100px;
            width: 50px;
            overflow: hidden;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .left .half-circle,
        #fuse-splash-screen .spinner-wrapper .spinner .inner .right .half-circle {
            position: absolute;
            top: 0;
            width: 100px;
            height: 100px;
            box-sizing: border-box;
            border: 10px solid #61DAFB;
            border-bottom-color: transparent;
            border-radius: 50%;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .left {
            left: 0;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .left .half-circle {
            left: 0;
            border-right-color: transparent;
            animation: left-wobble 1.3125s cubic-bezier(0.35, 0, 0.25, 1) infinite;
            -webkit-animation: left-wobble 1.3125s cubic-bezier(0.35, 0, 0.25, 1) infinite;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .right {
            right: 0;
        }

        #fuse-splash-screen .spinner-wrapper .spinner .inner .right .half-circle {
            right: 0;
            border-left-color: transparent;
            animation: right-wobble 1.3125s cubic-bezier(0.35, 0, 0.25, 1) infinite;
            -webkit-animation: right-wobble 1.3125s cubic-bezier(0.35, 0, 0.25, 1) infinite;
        }

        @keyframes outer-rotate {
            0% {
                transform: rotate(0deg) scale(0.5);
            }
            100% {
                transform: rotate(360deg) scale(0.5);
            }
        }

        @keyframes left-wobble {
            0%, 100% {
                transform: rotate(130deg);
            }
            50% {
                transform: rotate(-5deg);
            }
        }

        @keyframes right-wobble {
            0%, 100% {
                transform: rotate(-130deg);
            }
            50% {
                transform: rotate(5deg);
            }
        }

        @keyframes sporadic-rotate {
            12.5% {
                transform: rotate(135deg);
            }
            25% {
                transform: rotate(270deg);
            }
            37.5% {
                transform: rotate(405deg);
            }
            50% {
                transform: rotate(540deg);
            }
            62.5% {
                transform: rotate(675deg);
            }
            75% {
                transform: rotate(810deg);
            }
            87.5% {
                transform: rotate(945deg);
            }
            100% {
                transform: rotate(1080deg);
            }
        }
    </style>
    <!-- / FUSE Splash Screen CSS -->
    <link href="/projects/gsnc/map/static/css/71.chunk.css" rel="stylesheet"><link href="/projects/gsnc/map/static/css/26.chunk.css" rel="stylesheet"><link href="/projects/gsnc/map/static/css/34.chunk.css" rel="stylesheet"><link href="/projects/gsnc/map/static/css/30.chunk.css" rel="stylesheet"><link href="/projects/gsnc/map/static/css/main~970f9218.chunk.css" rel="stylesheet"></head>
<body>
<noscript>
    You need to enable JavaScript to run this app.
</noscript>
<div id="root" class="flex">
    <!-- FUSE Splash Screen -->
    <div id="fuse-splash-screen">

        <div class="center">

            <div class="logo">
                <img width="128" src="assets/images/logos/fuse.svg" alt="logo">
            </div>

            <!-- Material Design Spinner -->
            <div class="spinner-wrapper">
                <div class="spinner">
                    <div class="inner">
                        <div class="gap"></div>
                        <div class="left">
                            <div class="half-circle"></div>
                        </div>
                        <div class="right">
                            <div class="half-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Material Design Spinner -->

        </div>

    </div>
    <!-- / FUSE Splash Screen -->
</div>
<!--
  This HTML file is a template.
  If you open it directly in the browser, you will see an empty page.

  You can add webfonts, meta tags, or analytics to this file.
  The build step will place the bundled scripts into the <body> tag.

  To begin the development, run `npm start` or `yarn start`.
  To create a production bundle, use `npm run build` or `yarn build`.
-->
<script>!function(e){function t(t){for(var n,o,i=t[0],c=t[1],s=t[2],l=0,p=[];l<i.length;l++)o=i[l],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&p.push(a[o][0]),a[o]=0;for(n in c)Object.prototype.hasOwnProperty.call(c,n)&&(e[n]=c[n]);for(f&&f(t);p.length;)p.shift()();return u.push.apply(u,s||[]),r()}function r(){for(var e,t=0;t<u.length;t++){for(var r=u[t],n=!0,o=1;o<r.length;o++){var c=r[o];0!==a[c]&&(n=!1)}n&&(u.splice(t--,1),e=i(i.s=r[0]))}return e}var n={},o={14:0},a={14:0},u=[];function i(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.e=function(e){var t=[];o[e]?t.push(o[e]):0!==o[e]&&{24:1}[e]&&t.push(o[e]=new Promise((function(t,r){for(var n="static/css/"+({}[e]||e)+".chunk.css",a=i.p+n,u=document.getElementsByTagName("link"),c=0;c<u.length;c++){var s=(f=u[c]).getAttribute("data-href")||f.getAttribute("href");if("stylesheet"===f.rel&&(s===n||s===a))return t()}var l=document.getElementsByTagName("style");for(c=0;c<l.length;c++){var f;if((s=(f=l[c]).getAttribute("data-href"))===n||s===a)return t()}var p=document.createElement("link");p.rel="stylesheet",p.type="text/css",p.onload=t,p.onerror=function(t){var n=t&&t.target&&t.target.src||a,u=new Error("Loading CSS chunk "+e+" failed.\n("+n+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=n,delete o[e],p.parentNode.removeChild(p),r(u)},p.href=a,document.getElementsByTagName("head")[0].appendChild(p)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)t.push(r[2]);else{var n=new Promise((function(t,n){r=a[e]=[t,n]}));t.push(r[2]=n);var u,c=document.createElement("script");c.charset="utf-8",c.timeout=120,i.nc&&c.setAttribute("nonce",i.nc),c.src=function(e){return i.p+"static/js/"+({}[e]||e)+".chunk.js"}(e);var s=new Error;u=function(t){c.onerror=c.onload=null,clearTimeout(l);var r=a[e];if(0!==r){if(r){var n=t&&("load"===t.type?"missing":t.type),o=t&&t.target&&t.target.src;s.message="Loading chunk "+e+" failed.\n("+n+": "+o+")",s.name="ChunkLoadError",s.type=n,s.request=o,r[1](s)}a[e]=void 0}};var l=setTimeout((function(){u({type:"timeout",target:c})}),12e4);c.onerror=c.onload=u,document.head.appendChild(c)}return Promise.all(t)},i.m=e,i.c=n,i.d=function(e,t,r){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},i.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)i.d(r,n,function(t){return e[t]}.bind(null,n));return r},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="/projects/gsnc/map/",i.oe=function(e){throw console.error(e),e};var c=this["webpackJsonpfuse-react-app"]=this["webpackJsonpfuse-react-app"]||[],s=c.push.bind(c);c.push=t,c=c.slice();for(var l=0;l<c.length;l++)t(c[l]);var f=s;r()}([]);</script><script src="/projects/gsnc/map/static/js/29.chunk.js"></script><script src="/projects/gsnc/map/static/js/124.chunk.js"></script><script src="/projects/gsnc/map/static/js/17.chunk.js"></script><script src="/projects/gsnc/map/static/js/151.chunk.js"></script><script src="/projects/gsnc/map/static/js/25.chunk.js"></script><script src="/projects/gsnc/map/static/js/83.chunk.js"></script><script src="/projects/gsnc/map/static/js/19.chunk.js"></script><script src="/projects/gsnc/map/static/js/166.chunk.js"></script><script src="/projects/gsnc/map/static/js/21.chunk.js"></script><script src="/projects/gsnc/map/static/js/44.chunk.js"></script><script src="/projects/gsnc/map/static/js/36.chunk.js"></script><script src="/projects/gsnc/map/static/js/33.chunk.js"></script><script src="/projects/gsnc/map/static/js/71.chunk.js"></script><script src="/projects/gsnc/map/static/js/43.chunk.js"></script><script src="/projects/gsnc/map/static/js/16.chunk.js"></script><script src="/projects/gsnc/map/static/js/55.chunk.js"></script><script src="/projects/gsnc/map/static/js/26.chunk.js"></script><script src="/projects/gsnc/map/static/js/34.chunk.js"></script><script src="/projects/gsnc/map/static/js/20.chunk.js"></script><script src="/projects/gsnc/map/static/js/30.chunk.js"></script><script src="/projects/gsnc/map/static/js/main~24120820.chunk.js"></script><script src="/projects/gsnc/map/static/js/main~f71cff67.chunk.js"></script><script src="/projects/gsnc/map/static/js/main~970f9218.chunk.js"></script></body>
</html>
