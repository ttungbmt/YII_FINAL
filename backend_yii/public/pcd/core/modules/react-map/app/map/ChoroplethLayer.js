/* @flow */

import { isFunction } from 'lodash'
import { PropTypes } from 'react'

import Path from './Path'

export default class ChoroplethLayer extends Path {
    static propTypes = {
        data: PropTypes.oneOfType([PropTypes.array, PropTypes.object]).isRequired,
        valueProperty: PropTypes.oneOfType([PropTypes.string, PropTypes.func]).isRequired,
        scale: PropTypes.array,
        steps: PropTypes.number,
        mode: PropTypes.string,
        style: PropTypes.object,
        onEachFeature: PropTypes.func,
    };

    static defaultProps = {
        scale: ['white', 'red'], // chroma.js scale - include as many as you like
        steps: 3, // number of breaks or steps in range
        mode: 'q', // q for quantile, e for equidistant, k for k-means
        style: {
            color: '#FFE17E', // border color
            weight: 1.5,
            fillOpacity: 1,
            dashArray: '5, 5'
        },
    }

    componentWillMount () {
        super.componentWillMount()
        const { data, ...props } = this.props
        this.leafletElement = L.choropleth(data, props)
    }

    componentDidUpdate (prevProps: Object) {
        if (isFunction(this.props.style)) {
            this.setStyle(this.props.style)
        } else {
            this.setStyleIfChanged(prevProps, this.props)
        }
    }
}
