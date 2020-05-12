<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" href="/favicon.ico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="Web site created using create-react-app"/>
    <link rel="manifest" href="<?= asset('/assets/map/v2/manifest.json') ?>"/>
    <title>React App</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=url('/themes/admin/main/css/icons/icomoon/styles.css')?>">
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
    <script src="<?=url('/themes/admin/main/js/main/jquery.min.js')?>"></script>
    <script
        src="<?=url('/themes/admin/main/js/main/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=url('/themes/admin/main/js/plugins/ui/ripple.min.js')?>"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>


    <link href="<?= asset('/assets/map/v2/static/css/2.chunk.css') ?>" rel="stylesheet">
    <link href="<?= asset('/assets/map/v2/static/css/main.chunk.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuex@3.1.2/dist/vuex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-freeze-table@1.3.0/dist/js/freeze-table.min.js"></script>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="app"></div>
<div id="root"></div>
<script>
    let url = '<?=asset('/assets/map/v2/')?>'

    !function (l) {
        function e(e) {
            for (var r, t, n = e[0], o = e[1], u = e[2], a = 0, p = []; a < n.length; a++) t = n[a], Object.prototype.hasOwnProperty.call(i, t) && i[t] && p.push(i[t][0]), i[t] = 0;
            for (r in o) Object.prototype.hasOwnProperty.call(o, r) && (l[r] = o[r]);
            for (s && s(e); p.length;) p.shift()();
            return c.push.apply(c, u || []), f()
        }

        function f() {
            for (var e, r = 0; r < c.length; r++) {
                for (var t = c[r], n = !0, o = 1; o < t.length; o++) {
                    var u = t[o];
                    0 !== i[u] && (n = !1)
                }
                n && (c.splice(r--, 1), e = a(a.s = t[0]))
            }
            return e
        }

        var t = {}, i = {1: 0}, c = [];

        function a(e) {
            if (t[e]) return t[e].exports;
            var r = t[e] = {i: e, l: !1, exports: {}};
            return l[e].call(r.exports, r, r.exports, a), r.l = !0, r.exports
        }

        a.m = l, a.c = t, a.d = function (e, r, t) {
            a.o(e, r) || Object.defineProperty(e, r, {
                enumerable: !0,
                get: t
            })
        }, a.r = function (e) {"undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})}, a.t = function (r, e) {
            if (1 & e && (r = a(r)), 8 & e) return r;
            if (4 & e && "object" == typeof r && r && r.__esModule) return r;
            var t = Object.create(null);
            if (a.r(t), Object.defineProperty(t, "default", {
                enumerable: !0,
                value: r
            }), 2 & e && "string" != typeof r) for (var n in r) a.d(t, n, function (e) {return r[e]}.bind(null, n));
            return t
        }, a.n = function (e) {
            var r = e && e.__esModule ? function () {return e.default} : function () {return e};
            return a.d(r, "a", r), r
        }, a.o = function (e, r) {return Object.prototype.hasOwnProperty.call(e, r)}, a.p = url;
        var r = this["webpackJsonpreact-app"] = this["webpackJsonpreact-app"] || [], n = r.push.bind(r);
        r.push = e, r = r.slice();
        for (var o = 0; o < r.length; o++) e(r[o]);
        var s = n;
        f()
    }([])
</script>
<script src="<?= asset('/assets/map/v2/static/js/2.chunk.js') ?>"></script>
<script src="<?= asset('/assets/map/v2/static/js/main.chunk.js') ?>"></script>
</body>
</html>