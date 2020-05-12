import { PropTypes } from 'react';
import {defaultsDeep} from 'lodash';

import LayersControl from './LayersControl';

import {drawOptions} from './settings/index';

const {locale: drawLocale, shape} = drawOptions;

export default class DrawControl extends LayersControl {
    static propTypes = {
        onCreated: PropTypes.func,
        onEdited: PropTypes.func,
        onDeleted: PropTypes.func,
        onMounted: PropTypes.func,
        draw: PropTypes.object,
        position: PropTypes.string
    };

    static defaultProps = {
        style: {
            def: {
                color: '#f06eaa'
            },
            highlight : {
                color: '#23aee0'
            }
        }

    }

    componentWillMount() {
        const {
            onCreated,
            onDeleted,
            onMounted,
            onEdited,
            draw,
            position
        } = this.props;

        const { map, layerContainer } = this.context;

        let options = defaultsDeep({
            edit: {
                featureGroup: layerContainer
            },

        }, shape);

        if(draw) options.draw = Object.assign({}, options.draw, draw);
        if(position) options.position = position;

        L.drawLocal = drawLocale;
        this.leafletElement = new L.Control.Draw(options);

        if(typeof onMounted === "function") {
            onMounted(this.leafletElement);
        }

        map.on('draw:created', (e) => {
            layerContainer.addLayer(e.layer);
            // onCreated && onCreated.call(null, e);
        });


        // map.on('draw:edited', onEdited);
        // map.on('draw:deleted', onDeleted);

        layerContainer.on('click', e => {
            const {layer} = e;
            const {def, highlight} = this.props.style;

            if (e.originalEvent.ctrlKey) {
                if(layer.style == highlight){
                    layer.style = def;
                    layer.setStyle(def);
                    return;
                }

                layer.style = highlight;
                layer.setStyle(highlight);
            }
        })


    }
}