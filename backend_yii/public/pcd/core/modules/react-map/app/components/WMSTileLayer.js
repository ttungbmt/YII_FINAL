/* @flow */

import {tileLayer, Layer, GridLayer, setOptions, extend} from 'leaflet'
import {isEqual, omit, isUndefined} from 'lodash'
import PropTypes from 'prop-types'

// import childrenType from 'react-leaflet/src/types/children'
// import GridLayer from 'react-leaflet'
import {WMSTileLayer as BaseWMSTileLayer} from 'react-leaflet'
import { mix } from '../utils/general'
import imageWMS from '../map/ImageWMS'
import tileWMS from '../map/TileWMS'

export default class WMSTileLayer extends BaseWMSTileLayer {
    static propTypes = {
        // children: childrenType,
        // opacity: PropTypes.number,
        // url: PropTypes.string.isRequired,
        // zIndex: PropTypes.number,
    };

    static defaultProps = {
        format: 'image/png',
        transparent: true,
    };


    createLeafletElement(props: Object): Object {
        const {url, layerID, ...options} = this.props

        let WMSLayer = (options.tiled == false) ? imageWMS : tileWMS

        let leafletElement = WMSLayer(url, this.getOptions(options))

        leafletElement.showGetFeatureInfo = options.showGetFeatureInfo ? options.showGetFeatureInfo : leafletElement.showGetFeatureInfo;
        leafletElement.layerID = layerID ? layerID : null;

        return leafletElement
    }

    updateLeafletElement(fromProps: Object, toProps: Object) {
        super.updateLeafletElement(fromProps, toProps)

        const {url: prevUrl, opacity: _po, zIndex: _pz, ...prevParams} = fromProps
        const {url, opacity: _o, zIndex: _z, ...params} = toProps

        if (url !== prevUrl) {
            this.leafletElement.setUrl(url)
        }
        if (!isEqual(params, prevParams)) {
            this.leafletElement.setParams(params)
        }
    }
}
