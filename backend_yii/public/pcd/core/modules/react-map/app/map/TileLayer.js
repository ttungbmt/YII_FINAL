/* @flow */

import {PropTypes} from 'react';

import BaseTileLayer from './BaseTileLayer';

export default class TileLayer extends BaseTileLayer {
    static propTypes = {
        url: PropTypes.string.isRequired,
    };

    static defaultProps = {
        attribution: 'Map | © HCMGIS contributors'
    };

    componentWillMount() {
        super.componentWillMount();
        const {url, ...props} = this.props;
        this.leafletElement = L.tileLayer(url, props);
        this.tung = 5;
    }

    componentDidUpdate(prevProps:Object) {
        super.componentDidUpdate(prevProps)
        const {url} = this.props
        if (url !== prevProps.url) {
            this.leafletElement.setUrl(url)
        }
    }
}
