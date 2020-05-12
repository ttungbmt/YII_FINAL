(function (window, document){
    L.legendVersion = '0.1';

    L.Control.Legend = L.Control.extend({
        options: {
            position: 'bottomleft',
            html: ''
        },
        onAdd() {
            let container = L.DomUtil.create('div', 'leaflet-control-legend');
            container.innerHTML = this.options.html;
            return container;
        }
    })

    L.control.legend = function (options) {
        return new L.Control.Legend(options);
    }
})();