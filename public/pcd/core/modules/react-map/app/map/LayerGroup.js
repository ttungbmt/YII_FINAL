/* @flow */


import layerContainerType from './types/layerContainer'
import MapLayer from './MapLayer'

export default class LayerGroup extends MapLayer {
  static childContextTypes = {
    layerContainer: layerContainerType,
  };

  getChildContext () {
    return {
      layerContainer: this.leafletElement,
    }
  }

  componentWillMount () {
    super.componentWillMount()
    this.leafletElement = L.layerGroup()
  }
}
