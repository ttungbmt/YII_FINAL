<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" href="/favicon.ico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="Web site created using create-react-app"/>
    <link rel="manifest" href="<?= asset('/assets/map/v2/manifest.json') ?>"/>
    <title>Hệ thống quản lý bệnh truyền nhiễm</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= url('/themes/admin/main/css/icons/icomoon/styles.css') ?>">
    <link rel="stylesheet"
          href="<?= url('/themes/admin/main/css/bootstrap.min.css') ?>">
    <link rel="stylesheet"
          href="<?= url('/themes/admin/main/css/bootstrap_limitless.min.css') ?>">
    <link rel="stylesheet"
          href="<?= url('/themes/admin/main/css/layout.min.css') ?>">
    <link rel="stylesheet"
          href="<?= url('/themes/admin/main/css/components.min.css') ?>">
    <link rel="stylesheet"
          href="<?= url('/themes/admin/main/css/colors.min.css') ?>">
    <script src="<?= url('/themes/admin/main/js/main/jquery.min.js') ?>"></script>
    <script
            src="<?= url('/themes/admin/main/js/main/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= url('/themes/admin/main/js/plugins/ui/ripple.min.js') ?>"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>


    <link href="<?= asset('/assets/map/v2/static/css/5.chunk.css?v='.params('map_version')) ?>" rel="stylesheet">
    <link href="<?= asset('/assets/map/v2/static/css/main.chunk.css?v='.params('map_version')) ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuex@3.1.2/dist/vuex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-freeze-table@1.3.0/dist/js/freeze-table.min.js"></script>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="app"></div>
<div id="root"></div>
<script>
    let url = '<?=url('/pcd/assets/map/v2/')?>'

    !function (c) {
        function e(e) {
            for (var t, r, n = e[0], o = e[1], a = e[2], u = 0, i = []; u < n.length; u++) r = n[u], Object.prototype.hasOwnProperty.call(p, r) && p[r] && i.push(p[r][0]), p[r] = 0;
            for (t in o) Object.prototype.hasOwnProperty.call(o, t) && (c[t] = o[t]);
            for (h && h(e); i.length;) i.shift()();
            return l.push.apply(l, a || []), s()
        }

        function s() {
            for (var e, t = 0; t < l.length; t++) {
                for (var r = l[t], n = !0, o = 1; o < r.length; o++) {
                    var a = r[o];
                    0 !== p[a] && (n = !1)
                }
                n && (l.splice(t--, 1), e = d(d.s = r[0]))
            }
            return e
        }

        var r = {}, f = {3: 0}, p = {3: 0}, l = [];

        function d(e) {
            if (r[e]) return r[e].exports;
            var t = r[e] = {i: e, l: !1, exports: {}};
            return c[e].call(t.exports, t, t.exports, d), t.l = !0, t.exports
        }

        d.e = function (l) {
            var e = [];
            f[l] ? e.push(f[l]) : 0 !== f[l] && {0: 1}[l] && e.push(f[l] = new Promise(function (e, n) {
                for (var t = "static/css/" + ({4: "xlsx"}[l] || l) + ".chunk.css", o = d.p + t, r = document.getElementsByTagName("link"), a = 0; a < r.length; a++) {
                    var u = (c = r[a]).getAttribute("data-href") || c.getAttribute("href");
                    if ("stylesheet" === c.rel && (u === t || u === o)) return e()
                }
                var i = document.getElementsByTagName("style");
                for (a = 0; a < i.length; a++) {
                    var c;
                    if ((u = (c = i[a]).getAttribute("data-href")) === t || u === o) return e()
                }
                var s = document.createElement("link");
                s.rel = "stylesheet", s.type = "text/css", s.onload = e, s.onerror = function (e) {
                    var t = e && e.target && e.target.src || o,
                        r = new Error("Loading CSS chunk " + l + " failed.\n(" + t + ")");
                    r.code = "CSS_CHUNK_LOAD_FAILED", r.request = t, delete f[l], s.parentNode.removeChild(s), n(r)
                }, s.href = o, document.getElementsByTagName("head")[0].appendChild(s)
            }).then(function () {
                f[l] = 0
            }));
            var r = p[l];
            if (0 !== r) if (r) e.push(r[2]); else {
                var t = new Promise(function (e, t) {
                    r = p[l] = [e, t]
                });
                e.push(r[2] = t);
                var n, o = document.createElement("script");
                o.charset = "utf-8", o.timeout = 120, d.nc && o.setAttribute("nonce", d.nc), o.src = d.p + "static/js/" + ({4: "xlsx"}[l] || l) + ".chunk.js";
                var a = new Error;
                n = function (e) {
                    o.onerror = o.onload = null, clearTimeout(u);
                    var t = p[l];
                    if (0 !== t) {
                        if (t) {
                            var r = e && ("load" === e.type ? "missing" : e.type), n = e && e.target && e.target.src;
                            a.message = "Loading chunk " + l + " failed.\n(" + r + ": " + n + ")", a.name = "ChunkLoadError", a.type = r, a.request = n, t[1](a)
                        }
                        p[l] = void 0
                    }
                };
                var u = setTimeout(function () {
                    n({type: "timeout", target: o})
                }, 12e4);
                o.onerror = o.onload = n, document.head.appendChild(o)
            }
            return Promise.all(e)
        }, d.m = c, d.c = r, d.d = function (e, t, r) {
            d.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: r})
        }, d.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
        }, d.t = function (t, e) {
            if (1 & e && (t = d(t)), 8 & e) return t;
            if (4 & e && "object" == typeof t && t && t.__esModule) return t;
            var r = Object.create(null);
            if (d.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t) for (var n in t) d.d(r, n, function (e) {
                return t[e]
            }.bind(null, n));
            return r
        }, d.n = function (e) {
            var t = e && e.__esModule ? function () {
                return e.default
            } : function () {
                return e
            };
            return d.d(t, "a", t), t
        }, d.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, d.p = url, d.oe = function (e) {
            throw console.error(e), e
        };
        var t = this["webpackJsonpreact-app"] = this["webpackJsonpreact-app"] || [], n = t.push.bind(t);
        t.push = e, t = t.slice();
        for (var o = 0; o < t.length; o++) e(t[o]);
        var h = n;
        s()
    }([])
</script>
<script src="<?= asset('/assets/map/v2/static/js/5.chunk.js?v='.params('map_version')) ?>"></script>
<script src="<?= asset('/assets/map/v2/static/js/main.chunk.js?v='.params('map_version')) ?>"></script>
</body>
</html>