import React, {Component, PropTypes} from 'react';
import {render} from 'react-dom'
import {connect} from 'react-redux';
import { context, resolve } from 'react-resolver';
import {head, isEmpty, compact, pick, includes} from 'lodash';
import {Circle, ChoroplethLayer, Marker, Popup, LegendControl, DrawControl, FeatureGroup, LocateControl, MeasureControl, Map, ZoomControl, LayersControl, TileLayer, WMSTileLayer, FullscreenControl} from '../map';
const {BaseLayer, Overlay} = LayersControl;

import PopCabenh from './dichte/PopCabenh';
import {updateSxhModel} from '../actions/sxhActions';
import {arrToCQL, cqlJoin, formatNumber, last3Month, paramJoin} from '../utils';
import {deleteKvSxh} from '../actions/sxhActions';

var formatDate = (date, fromD = 'DD-MM-YYYY', toD = 'YYYY/MM/DD') => {
    return moment(date, fromD).format(toD);
}

class MapLayout extends Component {
    static contextTypes = {
        srvData: PropTypes.object,
    };

    constructor(props, context){
        super(props, context);

        this.settings = context.srvData.settings;
        this.hanhchinh = context.srvData.hanhchinh;
        this.layerUrl = context.srvData.layerUrl;

        this.state = {
            popCabenh: null,
        }


    }

    componentWillMount(){
        this.envCabenh = this.getEnvCabenh();
        this.cqlPhuong = this.getCqlPhuong();
        console.log(this.cqlPhuong)
        this.legendCabenh = this.getLegend();
    }

    componentDidMount(){
        this.map = window.map = this.refs.map.getWrappedInstance().leafletElement;
        setTimeout(::this.initRefs);
    }

    initRefs() {
        const {deleteKvSxh} = this.props;
        const {kvGroup} = this.refs;
        this.kvGroup = kvGroup.leafletElement;

        this.map.on('draw:deleted', e =>  {
            let layers = e.layers,
                IDs = [];
            layers.eachLayer(layer => IDs.push(layer.featureID));
            deleteKvSxh(IDs);
        });
    }

    componentWillReceiveProps(nextProps){
        const {googleAddr, flyTo, sxh_model, sxh_showPopup, sxh_filter, odsxh_flyto} = nextProps;

        if(googleAddr && googleAddr !== this.props.googleAddr){ this.zoomGoogleAddr(googleAddr); }

        if(flyTo && flyTo !== this.props.flyTo){ this.flyToLoc(flyTo); }
        if(odsxh_flyto && odsxh_flyto !== this.props.odsxh_flyto){ this.map.flyToBounds(odsxh_flyto); }
    }

    componentDidUpdate(prevProps, prevState){
        const {sxh_filter} = this.props;
        if(sxh_filter && sxh_filter !== prevProps.sxh_filter){
            const {leafletElement: cabenhWMS} = this.refs.cabenhLayer;
            const {leafletElement: kvWMS} = this.refs.kvLayer;
            cabenhWMS.setParams({cql_filter: this.getCqlCabenh()});
            kvWMS.setParams({cql_filter: this.getCqlCabenh()});
        }
    }

    zoomGoogleAddr(googleAddr){
        const {location, label} = googleAddr;
        this.flyToLoc(location);
        let marker = L.marker(location, {icon: L.icon.wave({heartbeat: 2})})
            .bindPopup(`<b>${label}`, {closeButton: false}).addTo(this.map);
        setTimeout(() => {this.map.removeLayer(marker)}, 15000)
    }

    flyToLoc(location){
        // Kiểm tra nếu tọa độ k nằm TPHCM cảnh báo, k zoom;

        this.map.getZoom() < 12 ? this.map.flyTo(location, 15) : this.map.flyTo(location);
    }

    getLegend(){
        let color = this.settings.map_sxh;

        let legend = `
            <div class="legend-title">Chú giải</div>
            <div class="legend-scale">
                <ul class='legend-labels'>
                    <li> <span class="legCircle" style='background:${color.cb_color_7};'></span> <= 7 </li>
                    <li> <span class="legCircle" style='background:${color.cb_color_814};'></span> 8 - 14</li>
                    <li> <span class="legCircle" style='background:${color.cb_color_1521};'></span> 15 - 21</li>
                    <li> <span class="legCircle" style='background:${color.cb_color_2228};'></span> 22 - 28</li>
                    <li> <span class="legCircle" style='background:${color.cb_color_28};'></span> >= 28</li>
                    <hr>
                    <li> <span class="legCircle" style='background:#aa2672;'></span> Zika</li>
                    <li> <span class="legCircle" style='background:${color.cb_color_sxv};'></span> Sốt</li>
                    <li> <span class="legCircle" style='background:${color.cb_color_khac};'></span> Khác</li>
                </ul>
            </div>
        `;
        return legend;
    }

    getCqlPhuong(field = 'ma_phuong') {
        const {ma_phuong, ma_quan, giapranh} =  this.hanhchinh;
        let res = [];
        if (ma_phuong && giapranh) res.push([`(${giapranh})`]);

        return arrToCQL(res);
    }


    getCqlCabenh() {
        let res = [], resOr = [];
        let {datefrom, dateto, benhnhan, loaibenh} = this.props.sxh_filter;

        const {ma_phuong, ma_quan, giapranh} =  this.hanhchinh;
        // Xét thời gian hiển thị ca bệnh
        let timeShowCB = this.settings.map_sxh.cb_during;
        let last3Month = moment().add(-1 * timeShowCB, 'months').format('DD/MM/YYYY');

        if (ma_phuong) {
            res.push(['ma_phuong', 'IN', `(${giapranh})`])
        }
        if (ma_quan) {
            res.push(['ma_quan', 'IN', `(${giapranh})`])
        }


        if (datefrom) {
            dateto = dateto ? dateto : moment().format('DD/MM/YYYY');

            res.push(['ngaymacbenh_nv', '>=', `'${formatDate(datefrom)}'`]);
            res.push(['ngaymacbenh_nv', '<=', `'${formatDate(dateto)}'`]);
        } else {
            res.push(['ngaymacbenh_nv', '>=', `'${formatDate(last3Month)}'`])
        }

        if (loaibenh && includes(loaibenh, 'sxh')) resOr.push(['cdc_cbn_sxh', '>', 0]);
        if (loaibenh && includes(loaibenh, 'sot')) resOr.push(['cdc_cbn_sot', '>', 0]);
        if (loaibenh && includes(loaibenh, 'khac')) resOr.push(['cdc_cbn_benhkhac', '>', 0]);
        // if(has(benhnhan, 'on')) res.push(['cdc_cbn_benhkhac', '>', 0]);
        // if(has(benhnhan, 'off')) res.push(['cdc_cbn_benhkhac', '>', 0]);

        return cqlJoin([arrToCQL(res), arrToCQL(resOr, 'or')], ' and ', '1=1');
    }

    getViewParams() {
        const {ma_phuong, ma_quan, giapranh} =  this.hanhchinh;
        let params = [
            ['ngaymacbenh', `${last3Month(6)}`],
        ]

        if (ma_phuong) {
            params.push(['ma_phuong', `and ma_phuong in (${giapranh.split(',').map(val => val.trim()).join('\\,')})`])
        }

        if (ma_quan) {
            params.push(['ma_quan', `and ma_quan in (${giapranh.split(',').map(val => val.trim()).join('\\,')})`])
        }

        return paramJoin(params);
    }

    showGetFeatureInfo = (err, latlng, content) => {
        if (!content.features.length) { return; };
        let model = head(content.features).properties;


        this.props.updateSxhModel({...model, from: 'map'});
    }

    getEnvCabenh() {
        let color = this.settings.map_sxh;
        let env = [
            ['cnull', '8C8C8C'],
            ['c7', color.cb_color_7],
            ['c7-14', color.cb_color_814],
            ['c14-21', color.cb_color_1521],
            ['c21-28', color.cb_color_2228],
            ['c28', color.cb_color_28],
            ['csxv', color.cb_color_sxv],
            ['ckhac', color.cb_color_khac],
        ];
        return env.map(v => v.join(':')).join(';')
    }

    showPopup = (model, pin = false) => {
        this.setState({
            popCabenh: (
                <PopCabenh pin={pin} data={model}/>
            )
        })
    }


    render(){
        const {sxh_showPopup, sxh_model, sxh_khoanhvung, odsxh_sxh, odsxh_model} = this.props;

        const {gisnen, ranhphuong, ranhquan, ranhto, cabenh, kvsxh, test_kvsxh, geo_odsxh} = this.layerUrl;


        return (
            <Map
                zoomControl={false}
                ref="map"
            >
                <ZoomControl/>
                <LocateControl />
                <LayersControl position='topright' filterLayers>
                    <BaseLayer name='GIS nền' checked>
                        <WMSTileLayer url={gisnen} layers='hcm_map:hcm_map'/>
                    </BaseLayer>
                    <BaseLayer name='Google'>
                        <TileLayer url='http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
                                   subdomains={['mt0', 'mt1', 'mt2', 'mt3']}/>
                    </BaseLayer>
                    <BaseLayer name='Mapbox'>
                        <TileLayer
                            url='https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}'
                            id="mapbox.streets"
                            accessToken="pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw"
                            attribution='Map data &copy; <a href="http://mapbox.com">Mapbox</a>'/>
                    </BaseLayer>
                    <BaseLayer name='OSM'>
                        <TileLayer url='http://{s}.tile.osm.org/{z}/{x}/{y}.png'
                                   attribution='&copy <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'/>
                    </BaseLayer>
                    <BaseLayer name='Ảnh vệ tinh'>
                        <TileLayer url='http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
                                   subdomains={['mt0', 'mt1', 'mt2', 'mt3']}/>
                    </BaseLayer>
                    <BaseLayer name='Ảnh hàng không'>
                        <TileLayer url='http://hcmgisportal.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg'/>
                    </BaseLayer>

                    <Overlay name='Ranh thửa đất'>
                        <WMSTileLayer url='http://pcd.hcmgis.vn/geoserver/hcm_map/ows?' layers='hcm_map:pg_ranhthua' transparent='true'/>
                    </Overlay>
                    <Overlay name='Ranh tổ'>
                        <WMSTileLayer url={ranhto} layers='dichte:ranh_to' tiled={false} transparent='true'/>
                    </Overlay>
                    <Overlay name='Ranh phường'>
                        <WMSTileLayer
                            url={ranhphuong}
                            layers='dichte:dm_phuong_new'
                            cql_filter={this.cqlPhuong ? `ma_phuong IN ${this.cqlPhuong}` : '1=1'}
                            tiled={false}
                            transparent='true'/>
                    </Overlay>
                    <Overlay name='Ranh quận'>
                        <WMSTileLayer
                            url={ranhquan}
                            layers='dichte:dm_quan'
                            transparent='true'/>
                    </Overlay>

                    <Overlay name='Ca bệnh' checked>
                        <WMSTileLayer
                            layerID="cabenh"
                            ref="cabenhLayer"
                            url={cabenh}
                            layers='dichte:v_cbsxh'
                            transparent='true'
                            cql_filter={this.getCqlCabenh()}
                            env={this.envCabenh}
                            showGetFeatureInfo={this.showGetFeatureInfo}
                            time="2013-03-10T00:00:00.000Z"
                        />
                    </Overlay>
                    <Overlay name='Khoanh vùng'>
                        <WMSTileLayer
                            ref="kvLayer"
                            url={kvsxh}
                            layers='dichte:v_kvsxh'
                            transparent='true'
                            cql_filter={this.getCqlCabenh()}
                        />
                    </Overlay>
                    <Overlay name='Khoanh vùng (Điều kiện)'>
                        <WMSTileLayer
                            url={test_kvsxh}
                            layers='dichte:test_kvsxh'
                            transparent='true'
                            viewparams={this.getViewParams()}
                        />
                    </Overlay>
                    <Overlay name='Ổ dịch SXH'>
                        <WMSTileLayer
                            url={geo_odsxh}
                            layers='dichte:geo_odsxh'
                            transparent='true'
                        />
                    </Overlay>
                </LayersControl>


                <MeasureControl position="topleft"/>
                <FullscreenControl position="bottomright"/>
                <LegendControl html={this.legendCabenh} />

                <FeatureGroup ref="kvGroup">
                    <DrawControl
                        draw={{marker:false, polyline: false, rectangle: false, polygon: false}}
                    />


                    {sxh_khoanhvung.map(val => (
                        <Circle id={val.id} key={val.id} center={val.center} radius={val.radius} color={val.color ? val.color : '#67c3e5'} ></Circle>
                    ))}
                </FeatureGroup>

                    {odsxh_sxh.map(val => (
                        <Circle id={val.macabenh} key={val.macabenh} center={[val.lat, val.lng]} radius={200} color="#f69a33" >
                            <Popup minWidth={200}>
                                <div className="pop-wrapper">
                                    <div className="pop-title text-uppercase">Ổ dịch #{odsxh_model.id}</div>
                                    <div className="pop-body">
                                        <ul className="list-data mb-10">
                                            <li><b>Tổng số ca: </b> {odsxh_sxh.length}</li>
                                            <li><b>Tổ ảnh hưởng: </b> </li>
                                            <li><b>Diện tích: </b> {formatNumber(odsxh_model.dientichdk)} m²</li>
                                            <li><b>Ca đầu tiên: </b> </li>
                                            <li><b>Ca gần nhất: </b> </li>
                                        </ul>
                                    </div>
                                </div>
                            </Popup>
                        </Circle>
                    ))}


                {sxh_showPopup ? <PopCabenh pin={sxh_showPopup} data={sxh_model}/> : null}
            </Map>
        );
    }
}

const mapStateToProps = (state) => {
    const {googleAddr, flyTo} = state.map;
    const {model, showPopup, filter, khoanhvung} = state.sxh;
    const {sxhs, flytoBounds} = state.sxhOdich;

    return {
        googleAddr, flyTo,
        sxh_model: model,
        sxh_showPopup: showPopup,
        sxh_filter: filter,
        sxh_khoanhvung: khoanhvung,

        odsxh_model: state.sxhOdich.model,
        odsxh_sxh: sxhs,
        odsxh_flyto: flytoBounds,
    };
}

export default connect(mapStateToProps, {updateSxhModel, deleteKvSxh})(MapLayout);