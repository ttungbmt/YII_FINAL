/* @flow */

// https://github.com/OpenGov/react-leaflet-cluster-layer
// https://github.com/Leaflet/Leaflet.markercluster

import { PropTypes } from 'react'

import layerContainerType from './types/layerContainer'
import Path from './Path'

export default class ClusterGroup extends Path {
    static childContextTypes = {
        layerContainer: layerContainerType,
        popupContainer: PropTypes.object,
    };

    getChildContext () {
        return {
            layerContainer: this.leafletElement,
            popupContainer: this.leafletElement,
        }
    }

    componentWillMount () {
        this.leafletElement = L.featureGroup()
    }

    componentDidMount () {
        super.componentDidMount()
        this.setStyle(this.props)
    }

    componentDidUpdate (prevProps: Object) {
        this.setStyleIfChanged(prevProps, this.props)
    }
}
