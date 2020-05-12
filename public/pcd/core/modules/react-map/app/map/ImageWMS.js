import { setOptions, extend } from 'leaflet'

import { mix } from '../utils/general'
import { mixinWMS } from './TileWMS'

class ImageWMS extends mix(L.TileLayer.TileWMS) {
    initialize(url, options) {
        this._url = url;

        // Move WMS parameters to params object
        let params = {}, opts = {};
        for (let opt in options) {
            if (opt in this.options) {
                opts[opt] = options[opt];
            } else {
                params[opt] = options[opt];
            }
        }

        setOptions(this, opts);

        this.wmsParams = extend({}, this.defaultWmsParams, params);
    }

    setParams(params) {
        extend(this.wmsParams, params);
        this.update();
    }

    getAttribution() {
        return this.options.attribution;
    }

    onAdd(map) {
        this.update();
        map.on('click', this.getFeatureInfo, this);
    }

    onRemove(map) {
        if (this._currentOverlay) {
            map.removeLayer(this._currentOverlay);
            delete this._currentOverlay;
        }
        if (this._currentUrl) {
            delete this._currentUrl;
        }

        map.off('click', this.getFeatureInfo, this);
    }

    getEvents() {
        return {
            'moveend': this.update
        };
    }

    update() {
        if (!this._map) {
            return;
        }
        // Determine image URL and whether it has changed since last update
        this.updateWmsParams();
        let url = this.getImageUrl();
        if (this._currentUrl == url) {
            return;
        }
        this._currentUrl = url;

        // Keep current image overlay in place until new one loads
        // (inspired by esri.leaflet)
        let bounds = this._map.getBounds();
        let overlay = L.imageOverlay(url, bounds, {'opacity': 0});
        overlay.addTo(this._map);
        overlay.once('load', _swap, this);
        function _swap() {
            if (!this._map) {
                return;
            }
            if (overlay._url != this._currentUrl) {
                this._map.removeLayer(overlay);
                return;
            } else if (this._currentOverlay) {
                this._map.removeLayer(this._currentOverlay);
            }
            this._currentOverlay = overlay;
            overlay.setOpacity(
                this.options.opacity ? this.options.opacity : 1
            );
            if (this.options.isBack === true) {
                overlay.bringToBack();
            }
            if (this.options.isBack === false) {
                overlay.bringToFront();
            }
        }

        if ((this._map.getZoom() < this.options.minZoom) ||
            (this._map.getZoom() > this.options.maxZoom)) {
            this._map.removeLayer(overlay);
        }
    }

    setOpacity(opacity) {
        this.options.opacity = opacity;
        if (this._currentOverlay) {
            this._currentOverlay.setOpacity(opacity);
        }
    }

    bringToBack() {
        this.options.isBack = true;
        if (this._currentOverlay) {
            this._currentOverlay.bringToBack();
        }
    }

    bringToFront() {
        this.options.isBack = false;
        if (this._currentOverlay) {
            this._currentOverlay.bringToFront();
        }
    }

    // See L.TileLayer.WMS: onAdd() & getTileUrl()
    updateWmsParams(map) {
        if (!map) {
            map = this._map;
        }
        // Compute WMS options
        let bounds = map.getBounds();
        let size = map.getSize();
        let wmsVersion = parseFloat(this.wmsParams.version);
        let crs = this.options.crs || map.options.crs;
        let projectionKey = wmsVersion >= 1.3 ? 'crs' : 'srs';
        let nw = crs.project(bounds.getNorthWest());
        let se = crs.project(bounds.getSouthEast());

        // Assemble WMS parameter string
        let params = {
            'width': size.x,
            'height': size.y
        };
        params[projectionKey] = crs.code;
        params.bbox = (
            wmsVersion >= 1.3 && crs === L.CRS.EPSG4326 ?
                [se.y, nw.x, nw.y, se.x] :
                [nw.x, se.y, se.x, nw.y]
        ).join(',');

        L.extend(this.wmsParams, params);
    }

    getImageUrl() {
        let uppercase = this.options.uppercase || false;
        let pstr = L.Util.getParamString(this.wmsParams, this._url, uppercase);
        return this._url + pstr;
    }
}

ImageWMS.prototype.defaultWmsParams = {
    service: 'WMS',
    request: 'GetMap',
    version: '1.1.1',
    layers: '',
    styles: '',
    format: 'image/png',
    transparent: true,
}


ImageWMS.prototype.options = {
    crs: null,
    uppercase: false,
    attribution: '',
    opacity: 1,
    isBack: false,
    minZoom: 0,
    maxZoom: 18
}

L.TileLayer.ImageWMS = ImageWMS
L.tileLayer.imageWMS = function (url, options) {
    return new ImageWMS(url, options)
}

export default L.tileLayer.imageWMS