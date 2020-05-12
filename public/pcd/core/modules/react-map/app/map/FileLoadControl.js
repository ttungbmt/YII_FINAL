/* @flow */

import { PropTypes } from 'react';

import MapControl from './MapControl';

export default class FileLoadControl extends MapControl {
    static propTypes = {

    };

    static defaultProps = {

    };

    componentWillMount () {
        if(!L.Control.FileLayerLoad){ console.warn('Thư viện leaflet measure chưa được load'); return; }

        var style = {
            color: 'red',
            dashArray: '5 5'
        };

        L.Control.FileLayerLoad.LABEL = '<i class="fa fa-folder-open-o"></i>';

        this.leafletElement  = L.Control.fileLayerLoad({
            fitBounds: true,
            fileSizeLimit: 10240,
            layerOptions: {style: style,
                pointToLayer: function (data, latlng) {
                    return L.circleMarker(latlng, {style: style});
                }},
        });
    }
}
