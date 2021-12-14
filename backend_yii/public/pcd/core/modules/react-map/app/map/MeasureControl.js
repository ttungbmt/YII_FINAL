/* @flow */

import { PropTypes } from 'react';

import MapControl from './MapControl';

export default class MeasureControl extends MapControl {
    static propTypes = {
        position: PropTypes.string
    };

    static defaultProps = {
        position: 'topright'
    }

    componentWillMount() {
        if(!L.control.measure){ console.warn('Thư viện leaflet measure chưa được load'); return; }

        this.leafletElement = L.control.measure(this.props);
    }
}



