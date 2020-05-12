/* @flow */

import { PropTypes } from 'react'

import MapControl from './MapControl'

export default class AttributionControl extends MapControl {
  static propTypes = {
    prefix: PropTypes.string,
  };

  componentWillMount () {
    this.leafletElement = L.control.attribution(this.props)
  }
}
