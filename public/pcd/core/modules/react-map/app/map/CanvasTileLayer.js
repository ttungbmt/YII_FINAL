/* @flow */

import BaseTileLayer from './BaseTileLayer'

export default class CanvasTileLayer extends BaseTileLayer {
  componentWillMount () {
    super.componentWillMount()
    this.leafletElement = L.tileLayer.canvas(this.props)
  }
}
