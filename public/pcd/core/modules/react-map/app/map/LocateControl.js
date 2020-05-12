/* @flow */
import { PropTypes } from 'react';

import MapControl from './MapControl';

export default class LocateControl extends MapControl {
    static propTypes = {

    };

    static defaultProps = {
        position: 'bottomright',
        strings: {
            title: "Vị trí của tôi",
            metersUnit: "meters",
            feetUnit: "feet",
            popup: "Bạn đang ở trong phạm vi {distance} {unit}",
            outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
        },
    }

    componentWillMount() {
        if(!L.control.locate){ console.warn('Thư viện leaflet locate chưa được load'); return; }

        this.leafletElement = L.control.locate(this.props);
    }
}



