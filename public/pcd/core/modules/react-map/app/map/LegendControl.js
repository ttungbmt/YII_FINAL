/* @flow */

import {PropTypes} from 'react';

import MapControl from './MapControl';

export default class LegendControl extends MapControl {
    static propTypes = {
        position: PropTypes.string,
        html: PropTypes.string,
    };

    static defaultProps = {
        html: ''
    };

    componentWillMount() {
        this.leafletElement = L.control.legend(this.props);
    }
}
