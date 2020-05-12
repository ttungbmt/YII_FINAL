/* @flow */
import {Children, PropTypes} from 'react'
import {render, unmountComponentAtNode} from 'react-dom'

import latlngType from './types/latlng'
import mapType from './types/map'
import MapComponent from './MapComponent'

export default class Popup extends MapComponent {
    static propTypes = {
        children: PropTypes.node,
        position: latlngType,
    };

    static contextTypes = {
        map: mapType,
        popupContainer: PropTypes.object,
    };

    componentWillMount() {
        super.componentWillMount()
        const {children: _children, ...props} = this.props;

        this.leafletElement = L.popup(props, this.context.popupContainer);
        this.leafletElement.on('add', ::this.renderPopupContent);
        // this.leafletElement.on('remove', ::this.removePopupContent)
    }

    componentDidMount() {
        const {position, open} = this.props
        const {map, popupContainer} = this.context;

        const el = this.leafletElement

        if (popupContainer) {
            // Attach to container component
            let pop = popupContainer.bindPopup(el);

            !open || setTimeout(() => pop.openPopup());
        } else {
            // Attach to a Map
            if (position) {
                el.setLatLng(position)
            }
            el.openOn(map)
        }
    }

    openPopup() {
        this.leafletElement.openOn(this.context.map);
    }

    componentDidUpdate(prevProps:Object) {
        const {position, open} = this.props;
        const {map, popupContainer} = this.context;

        if (position !== prevProps.position) {
            let el = this.leafletElement.setLatLng(position);

            // !open || el.openOn(map);
            if(open){
                this.renderPopupContent();
                el.openOn(map);
            }
        }


        if (this.leafletElement._isOpen) {
            this.renderPopupContent();
        }
    }

    componentWillUnmount() {
        super.componentWillUnmount()
        this.removePopupContent()
        this.context.map.removeLayer(this.leafletElement)
    }

    renderPopupContent() {
        if (this.props.children) {
            render(
                Children.only(this.props.children),
                this.leafletElement._contentNode
            )

            this.leafletElement._updateLayout()
            this.leafletElement._updatePosition()
            this.leafletElement._adjustPan()
        } else {
            this.removePopupContent()
        }
    }

    removePopupContent() {
        if (this.leafletElement._contentNode) {
            unmountComponentAtNode(this.leafletElement._contentNode)
        }
    }

    render() {
        return null;
    }
}
