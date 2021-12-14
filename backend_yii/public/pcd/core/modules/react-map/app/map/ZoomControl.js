/* @flow */

import { PropTypes } from 'react';

import MapControl from './MapControl';

export default class ZoomControl extends MapControl {
  static propTypes = {
    zoomInText: PropTypes.string,
    zoomInTitle: PropTypes.string,
    zoomOutText: PropTypes.string,
    zoomOutTitle: PropTypes.string,
  };

  static defaultProps = {
    position: 'bottomright',
    zoomInTitle: 'Phóng to',
    zoomOutTitle: 'Thu nhỏ',
  };

  componentWillMount () {
    this.leafletElement = L.control.zoom(this.props)
  }
}
