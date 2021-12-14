/* @flow */

import { PropTypes } from 'react';

import MapControl from './MapControl';

export default class LoadingControl extends MapControl {
    static propTypes = {

    };

    static defaultProps = {
        position: 'bottomright',
        separate: false,
        zoomControl: null,
        spinjs: false,
        spin: {
            lines: 7,
            length: 3,
            width: 3,
            radius: 5,
            rotate: 13,
            top: "83%"
        }
    };

    componentWillMount() {
        if(!L.Control.loading){ console.warn('Thư viện leaflet loading chưa được load'); return; }

        this.leafletElement = L.Control.loading(this.props);
    }
}



