/* @flow */

import {PropTypes} from 'react'
import {defaults} from 'lodash';

import latlngType from './types/latlng'
import MapLayer from './MapLayer'

export default class Marker extends MapLayer {
    static propTypes = {
        icon: PropTypes.instanceOf(L.Icon),
        opacity: PropTypes.number,
        position: latlngType.isRequired,
        zIndexOffset: PropTypes.number,
    };

    get icon() {
        if (!L.ExtraMarkers.icon) { console.warn('Thư viện leaflet ExtraMarkers chưa được load'); return new L.Icon.Default(); }

        if(this.props.type == 'maki'){
            L.MakiMarkers.accessToken = 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw';

            return L.MakiMarkers.icon({
                icon: L.MakiMarkers.defaultIcon,
                color: '#1087BF',
                size: 'm'
            });
        }

        return L.ExtraMarkers.icon({
            icon: 'fa-circle-o',
            markerColor: 'cyan',
            shape: 'circle', // 'circle', 'square', 'star', or 'penta'
            prefix: 'fa'
        });
    }

    static childContextTypes = {
        popupContainer: PropTypes.object,
    };

    getChildContext() {
        return {
            popupContainer: this.leafletElement,
        }
    }

    componentWillMount() {
        super.componentWillMount()
        const {position, ...props} = this.props;

        this.leafletElement = L.marker(position, defaults(props, {icon: this.icon}));
    }

    componentDidUpdate(prevProps:Object) {
        if (this.props.position !== prevProps.position) {
            this.leafletElement.setLatLng(this.props.position)
        }
        if (this.props.icon !== prevProps.icon) {
            this.leafletElement.setIcon(this.props.icon)
        }
        if (this.props.zIndexOffset !== prevProps.zIndexOffset) {
            this.leafletElement.setZIndexOffset(this.props.zIndexOffset)
        }
        if (this.props.opacity !== prevProps.opacity) {
            this.leafletElement.setOpacity(this.props.opacity)
        }
        if (this.props.draggable !== prevProps.draggable) {
            if (this.props.draggable) {
                this.leafletElement.dragging.enable()
            } else {
                this.leafletElement.dragging.disable()
            }
        }
    }

    render() {
        return this.props.children || null
    }
}
