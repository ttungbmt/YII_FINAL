export * as PropTypes from './types'

export AttributionControl from './AttributionControl'
export BaseTileLayer from './BaseTileLayer'
export CanvasTileLayer from './CanvasTileLayer'
export Circle from './Circle'
export CircleMarker from './CircleMarker'
export FeatureGroup from './FeatureGroup'
export GeoJson from './GeoJson'
export ImageOverlay from './ImageOverlay'
export LayerGroup from './LayerGroup'

export Map from './Map';
export MapComponent from './MapComponent'
export MapControl from './MapControl'
export MapLayer from './MapLayer'
export Marker from './Marker'
export MultiPolygon from './MultiPolygon'
export MultiPolyline from './MultiPolyline'
export Path from './Path'
export Polygon from './Polygon'
export Polyline from './Polyline'
export Popup from './Popup'
export Rectangle from './Rectangle'
export ScaleControl from './ScaleControl'
export TileLayer from './TileLayer'
export WMSTileLayer from './WMSTileLayer'

export LayersControl from './LayersControl'
export ZoomControl from './ZoomControl'
export DrawControl from './DrawControl'
export FullscreenControl from './FullscreenControl'
export LocateControl from './LocateControl'
export LoadingControl from './LoadingControl'
export MeasureControl from './MeasureControl'
export ButtonControl from './ButtonControl'
export FileLoadControl from './FileLoadControl'
export ShpLayer from './ShpLayer'
export ChoroplethLayer from './ChoroplethLayer'
export LegendControl from './LegendControl'

export const setIconDefaultImagePath = path => {
  L.Icon.Default.imagePath = path
}

setIconDefaultImagePath('//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images')
