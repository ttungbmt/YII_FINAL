/* @flow */
/* eslint-disable react/no-did-mount-set-state */


import {isUndefined, omit, uniqueId} from 'lodash';
import React, {PropTypes} from 'react';
import {connect} from 'react-redux';

import boundsType from './types/bounds';
import childrenType from './types/children';
import latlngType from './types/latlng';

import {mapOptions} from './settings/index';
import {invertBound} from './utils';


import MapComponent from './MapComponent';

type LatLngType = L.LatLng | Array<number> | Object;
type LatLngBoundsType = L.LatLngBounds | Array<LatLngType>;

const normalizeCenter = (pos:LatLngType):Array<number> => {
    return Array.isArray(pos) ? pos : [pos.lat, pos.lon ? pos.lon : pos.lng]
}


class Map extends MapComponent {
    state:{
        id: string,
        map?: L.Map,
    };

    static propTypes = {
        animate: PropTypes.bool,
        bounds: boundsType,
        boundsOptions: PropTypes.object,
        center: latlngType,
        children: childrenType,
        className: PropTypes.string,
        id: PropTypes.string,
        maxBounds: boundsType,
        maxZoom: PropTypes.number,
        minZoom: PropTypes.number,
        style: PropTypes.object,
        zoom: PropTypes.number,
        invertBound: PropTypes.oneOfType([
            PropTypes.string, PropTypes.bool, PropTypes.object
        ]),
    };

    static defaultProps = mapOptions;

    static childContextTypes = {
        map: PropTypes.instanceOf(L.Map),
    };

    getChildContext() {
        return {
            map: this.leafletElement,
        }
    }

    constructor(props:Object, context:Object) {
        super(props, context)
        this.state = {
            id: props.id || uniqueId('map'),
        }
    }

    componentDidMount() {
        const props = omit(this.props, ['children', 'className', 'id', 'style', 'dispatch'])
        this.leafletElement = L.map(this.state.id, props)
        super.componentDidMount();
        this.setState({map: this.leafletElement})
        if (!isUndefined(props.bounds)) {
            this.leafletElement.fitBounds(props.bounds, props.boundsOptions)
        }

        if(props.invertBound) this.invertBound(props.clipBound);
    }

    componentDidUpdate(prevProps:Object) {
        const {bounds, boundsOptions, center, maxBounds, zoom, animate} = this.props
        if (center && this.shouldUpdateCenter(center, prevProps.center)) {
            this.leafletElement.setView(center, zoom, {animate})
        } else if (zoom && zoom !== prevProps.zoom) {
            this.leafletElement.setZoom(zoom)
        }
        if (maxBounds && this.shouldUpdateBounds(maxBounds, prevProps.maxBounds)) {
            this.leafletElement.setMaxBounds(maxBounds)
        }
        if (bounds && (
                this.shouldUpdateBounds(bounds, prevProps.bounds) ||
                boundsOptions !== prevProps.boundsOptions
            )) {
            this.leafletElement.fitBounds(bounds, boundsOptions)
        }
    }

    componentWillUnmount() {
        super.componentWillUnmount()
        this.leafletElement.remove()
    }

    invertBound(url){
        const map = this.leafletElement;

        let geoBound = L.geoJson.ajax(url,{ middleware: data =>{ return invertBound(data); }, fillOpacity: 1, fillColor: '#fff', weight: 0});
        map .addLayer(geoBound)
            // .on('dragend', () => { geoBound.refresh() })

    }

    shouldUpdateCenter(next:LatLngType, prev:LatLngType) {
        if (!prev) return true
        next = normalizeCenter(next)
        prev = normalizeCenter(prev)
        return next[0] !== prev[0] || next[1] !== prev[1]
    }

    shouldUpdateBounds(next:LatLngBoundsType, prev:LatLngBoundsType) {
        if (!prev) return true
        next = L.latLngBounds(next)
        prev = L.latLngBounds(prev)
        return !next.equals(prev)
    }

    render() {
        const map = this.leafletElement
        const children = map ? React.Children.map(this.props.children, child => {
            return child ? React.cloneElement(child, {map, layerContainer: map}) : null
        }) : null


        return (
            <div
                className={this.props.className}
                id={this.state.id}
                style={this.props.style}>
                {children}
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {} }

export default connect(mapStateToProps, null, null, { withRef: true })(Map);