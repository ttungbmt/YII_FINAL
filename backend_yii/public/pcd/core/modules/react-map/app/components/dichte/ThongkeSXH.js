import React, {Component, PropTypes} from 'react';
import axios from 'axios';

var geojson;
var info = L.control();
var legend;

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function (props) {
    this._div.innerHTML = `<b>SỐT XUẤT HUYẾT 2016</b> <br>` + (props ? `<b>${props.ten_phuong}</b> <br /> ${props.total} ca bệnh SXH` : `Di chuyển để xem chi tiết`);
};



function getColor(d) {
    return  d > 50 ? '#800026' :
            d > 40  ? '#BD0026' :
            d > 30  ? '#E31A1C' :
            d > 20  ? '#FC4E2A' :
            d > 15   ? '#FD8D3C' :
            d > 10   ? '#FEB24C' :
            d > 5   ? '#FED976' : '#FFEDA0';
}

function style(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(feature.properties.total)
    };
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 3,
        color: '#38a9dc',
        dashArray: '',
        fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

var geojson;

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function onEachFeature(feature, layer) {
    layer.srvData = feature.properties;

    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: showChartSXH
    });
}

function showChartSXH(e) {
    $.post(url_home('maps/chart-phuong'), e.target.srvData).then(res => {
            AmCharts.makeChart("chartdiv",
                {
                    "type": "serial",
                    "categoryField": "thang",
                    "colors": [
                        "#DA1F3C",
                        "#FCD202"
                    ],
                    "startDuration": 1,
                    "theme": "default",
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]: [[value]]",
                            "columnWidth": 0.5,
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "SXH",
                            "type": "column",
                            "valueField": "sxh_total"
                        },
                        {
                            "balloonText": "[[title]]: [[value]]",
                            "columnWidth": 0.5,
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "SXV",
                            "type": "column",
                            "valueField": "sxv_total"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "axisFrequency": 0,
                            "id": "ValueAxis-1",
                            "stackType": "regular",
                            "title": "Số ca"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "enabled": true,
                        "useGraphSettings": true
                    },
                    "titles": [
                        {
                            "color": "#FF8000",
                            "id": "Title-1",
                            "size": 15,
                            "text": "DỊCH BỆNH SXH THEO THÁNG"
                        }
                    ],
                    "dataProvider": res
                }
            );

    })
}

export default class ThongkeSXH extends Component {
    constructor(props, context){
        super(props, context);
        this.state = {
            ck_mapsxh: false
        }
    }

    componentWillMount(){

    }

    componentDidMount(){

    }

    componentDidUpdate(prevProps, prevState){
        const {ck_mapsxh} = this.state;
        if(ck_mapsxh & ck_mapsxh != prevState.ck_mapsxh){
            axios.get('maps/geo-hc-phuong').then(res => {
                geojson = L.geoJson(res.data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);

                info.addTo(map);

                legend = L.control({position: 'bottomleft'});

                legend.onAdd = function (map) {
                    var div = L.DomUtil.create('div', 'info legend'),
                        grades = [0, 5 , 10 , 15 , 20 , 25 , 30 , 40 , 50],
                        labels = [],
                        from, to;

                    for (var i = 0; i < grades.length; i++) {
                        from = grades[i];
                        to = grades[i + 1];

                        labels.push(
                            '<i style="background:' + getColor(from + 1) + '"></i> ' +
                            from + (to ? '&ndash;' + to : '+'));
                    }

                    div.innerHTML = labels.join('<br>');
                    return div;
                };

                legend.addTo(map);
            })
        } else {
            map.removeLayer(geojson);
            map.removeControl(legend);
            map.removeControl(info);
        }
    }

    render(){
        const {ck_mapsxh} = this.state;

        return (
            <div id="tk-sxh" className="m-10">
                <div className="form-group">
                    <label className="display-block">Bản đồ:</label>
                    <label className="checkbox-inline">
                        <input id="ck-mapsxh" type="checkbox" value="sxh" defaultChecked={ck_mapsxh} onClick={()=>this.setState({ck_mapsxh: !ck_mapsxh})}/>
                        SXH
                    </label>
                </div>
                <div id="chartdiv" style={{width: '100%', height: 400, backgroundColor: '#FFFFFF'}} />
            </div>
        )
    }
}
