import React, {Component, PropTypes} from 'react';
import axios from 'axios';
import { connect } from 'react-redux';
import { render } from 'react-dom';
import {pick, keyBy, map, isEmpty} from 'lodash';

import {cir2poly, mergePoly, geoJSON2WKT} from '../../utils/geom';

class OdichInfo extends Component {

    constructor(props){
        super(props);
        this.kvCabenh = props.kvCabenh;

        this.state = {
            cbTotal: null,
            areaTo: null,
            dsTo: null,
        }
    }

    componentDidUpdate(prevProps, prevState){
        const {sxh_khoanhvung} = this.props;

        if(sxh_khoanhvung !== prevProps.sxh_khoanhvung){

            !$('#list-kvcabenh').length || this.renderContent();

            if(isEmpty(sxh_khoanhvung)) {

                this.setState({
                    dsTo: null,
                    areaTo: null,
                    cbTotal: null
                })
            } else {
                let cirKV = sxh_khoanhvung.map(val => cir2poly(val.center, val.radius).toGeoJSON());
                let mergeCir = mergePoly(cirKV);
                let areaCir = turf.area(mergeCir);

                $.post(url_home('maps/ranhto'), {wkt: geoJSON2WKT(mergeCir)}).then(resp => {
                    const {totiepgiap, viewto} = resp;
                    this.setState({
                        dsTo: <div dangerouslySetInnerHTML={{__html: viewto}} />,
                        areaTo: turf.area(mergeCir),
                        cbTotal: sxh_khoanhvung.length
                    })
                })
            }

        }
    }

    showListCabenh = () => {
        $.jsPanel({
            id: 'panel-kvcabenh',
            contentSize: {width: 830, height: 300},
            headerTitle: '<b class="text-uppercase">Danh sách ca bệnh - ổ dịch SXH</b>',
            theme: 'crimson',
            content: `<div id="list-kvcabenh"></div>`,
            callback: () => {
                this.renderContent();
            }
        }).content.css('overflow', 'auto');
    }

    renderContent = () => {
         let cabenhs = this.props.sxh_khoanhvung;

        render((
            <div className="table-responsive">
                <table className="table table-hover dskvcabenh">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Tuổi</th>
                        <th>Tổ</th>
                        <th>Khu phố</th>
                        <th>PX</th>
                        <th>QH</th>
                        <th>Ngày mắc bệnh</th>
                    </tr>
                    </thead>
                    <tbody>
                        {cabenhs ? cabenhs.map((val, i) => (
                        <tr key={i}>
                            <td>{i+1}</td>
                            <td>{val.model.hoten}</td>
                            <td>{val.model.tuoi}</td>
                            <td>{val.model.to1}</td>
                            <td>{val.model.khupho1}</td>
                            <td>{val.model.ten_phuong}</td>
                            <td>{val.model.ten_quan}</td>
                            <td>{val.model.ngaymacbenh_nv}</td>
                        </tr>
                        )) : null}
                    </tbody>
                </table>
            </div>
        ), document.getElementById('list-kvcabenh'))
    }

    render(){
        const {cbTotal, areaTo, dsTo} = this.state;

        return (
            <div className="panel panel-white">
                <div className="panel-heading">
                    <h6 className="panel-title">
                        <a className="collapsed" data-toggle="collapse" href="#collapse-kvcabenh" aria-expanded="true">
                            <i className="icon-feed"></i>
                            <span className="ml-5">Ổ dịch</span>
                        </a>
                        <button onClick={this.showListCabenh} style={{padding: 0, float: 'right'}} type="button" className="btn btn-link mr-10"><i className="icon-list2" /></button>
                    </h6>
                </div>
                <div id="collapse-kvcabenh" className="panel-collapse collapse in">
                    <div className="panel-body">
                        <table className="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>Tổng số ca</td>
                                <td>{cbTotal}</td>
                            </tr>
                            <tr>
                                <td>Diện tích tổ</td>
                                <td>{parseFloat(areaTo) ? parseFloat(areaTo).toFixed(2) + ' m²': null} </td>
                            </tr>
                            </tbody>
                        </table>
                        <p className="mt-5"><b>Lưu ý</b>: Lớp Khoanh vùng (điều kiện): khoanh vùng tự động áp dụng 2 điều kiện (200m, 30 ngày) theo khoảng thời gian 3 tháng</p>
                        <h6 className="mt-5 text-center text-bold"> Danh sách tổ ảnh hưởng</h6>
                        {dsTo}
                    </div>
                </div>
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        sxh_khoanhvung: state.sxh.khoanhvung
    };
}

export default connect(mapStateToProps)(OdichInfo);
