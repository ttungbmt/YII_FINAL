/* @flow */

import { PropTypes } from 'react';
import {isObject} from 'lodash';

import MapControl from './MapControl';

export default class ButtonControl extends MapControl {
    static propTypes = {
        states: PropTypes.object,
        icon: PropTypes.string,
        onClick: PropTypes.func,
    };

    static defaultProps = {
        icon: 'fa-location-arrow',
        title: 'Easy button',
    };

    componentWillMount () {
        if(!L.easyButton){ console.warn('Thư viện leaflet loading chưa được load'); return; }
        const {icon, onClick, title, id, states} = this.props;

        this.leafletElement = isObject(states) ? L.easyButton(states) : L.easyButton(icon, onClick, title, id);
    }
}
