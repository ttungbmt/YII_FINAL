/* @flow */

import { isFunction } from 'lodash'
import { PropTypes } from 'react'

import Path from './Path'

export default class ShpLayer extends Path {
    static propTypes = {
        file: PropTypes.string,
        onLoaded: PropTypes.func,
    };

    static defaultProps = {
        file: '/data/ranhTP_pl.zip'
    }

    componentWillMount () {
        super.componentWillMount();
        // const { map } = this.context;
        const { file, ...props } = this.props;
        this.leafletElement = new L.Shapefile(file, props);

        !this.onLoaded || this.leafletElement.once("data:loaded", ::this.onLoaded);
    }

    componentDidUpdate (prevProps: Object) {
        if (isFunction(this.props.style)) {
            this.setStyle(this.props.style)
        } else {
            this.setStyleIfChanged(prevProps, this.props)
        }
    }
}
