/* @flow */

import { PropTypes } from 'react'

import MapControl from './MapControl'

export default class FullscreenControl extends MapControl {
    static propTypes = {
        position: PropTypes.string,
        title: PropTypes.string,
        titleCancel: PropTypes.string,
        content: PropTypes.node,
        forceSeparateButton: PropTypes.bool,
        forcePseudoFullscreen: PropTypes.bool,
        fullscreenElement: PropTypes.bool
    };

    static defaultProps = {
        // position: 'bottomright',
        title: 'Toàn màn hình',
        titleCancel: 'Thu nhỏ',
        content: null,
        forceSeparateButton: false,
        forcePseudoFullscreen: false,
    }

    componentWillMount () {
        if(!L.control.fullscreen){ console.warn('Thư viện leaflet fullscreen chưa được load'); return; }

        this.leafletElement = L.control.fullscreen(this.props)
    }
}
