import { mix } from '../utils/general'
import { isUndefined } from 'lodash'

export const mixinWMS = (superclass) => class extends superclass {
    getFeatureInfo(evt) {
        // Make an AJAX request to the server and hope for the best
        let url = this.getFeatureInfoUrl(evt.latlng),
            showResults = L.Util.bind(this.showGetFeatureInfo, this);

        store.dispatch({type: '@LAYERS/SEND_WMS', payload: {latlng: evt.latlng}})

        $.ajax({
            url: url,
            success: function (data, status, xhr) {
                let err = typeof data === 'string' ? null : data;
                showResults(err, evt.latlng, data);
            },
            error: function (xhr, status, error) {
                showResults(error);
            }
        })
    }

    getFeatureInfoUrl(latlng){
        let point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
            size = this._map.getSize(),

            params = {
                request: 'GetFeatureInfo',
                service: 'WMS',
                srs: 'EPSG:4326',
                styles: this.wmsParams.styles,
                transparent: this.wmsParams.transparent,
                version: this.wmsParams.version,
                format: this.wmsParams.format,
                bbox: this._map.getBounds().toBBoxString(),
                height: size.y,
                width: size.x,
                layers: this.wmsParams.layers,
                query_layers: this.wmsParams.layers,
                // cql_filter: this.wmsParams.cql_filter,
                env: this.wmsParams.env,
                viewparams: this.wmsParams.viewparams,
                info_format: 'application/json'
            };

        if (!isUndefined(this.wmsParams.cql_filter)) {
            params.cql_filter = this.wmsParams.cql_filter;
        }


        params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
        params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;

        return this._url + L.Util.getParamString(params, this._url, true);
    }

    showGetFeatureInfo(err, latlng, data){
        console.log(data, 111);
    }
}

class TileWMS extends mix(L.TileLayer.WMS).with(mixinWMS) {
    getTileUrl(coords) {
        const {lat, lng} = this._map.getBounds().getSouthWest()

        return super.getTileUrl(coords)+`&tilesorigin=${lng},${lat}&tilesize=256`
    }

    onAdd(map){
        super.onAdd(map)
        map.on('click', this.getFeatureInfo, this);
    }

    onRemove(map){
        super.onRemove(map)
        map.off('click', this.getFeatureInfo, this);
    }

}

L.TileLayer.TileWMS = TileWMS

L.tileLayer.tileWMS = function (url, options) {
    return new L.TileLayer.TileWMS(url, options);
}

export default L.tileLayer.tileWMS