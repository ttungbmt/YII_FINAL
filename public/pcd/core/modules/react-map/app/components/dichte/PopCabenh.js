import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';
import {Popup, Marker} from '../../map';
import {pick, compact, values, isEmpty} from 'lodash';
import {filter} from 'lodash';

import {addKvSxh, updateKvSxh} from '../../actions/sxhActions';

class PopCabenh extends Component {
    constructor(props){
        super(props);
    }

    getDiachi(data, type = null){
        let vtri = compact(values(pick(data, ['sonha1', 'duong1']))).join(' ');
        let phuongquan = values(pick(data, ['ten_phuong', 'ten_quan'])).join(', ');
        if(type == 'diachi'){
            return vtri;
        } else if(type == 'phuongquan'){
            return phuongquan;
        }

        return compact([vtri, phuongquan]).join(', ')
    }

    getRadius(){
        let valRad = !isEmpty($('#radiusKV').val()) ? $('#radiusKV').val() : settings.map_sxh.cb_radius;
        return parseFloat(valRad);
    }

    render() {
        const {data, addKvSxh, updateKvSxh, settings} = this.props;

        return (
            <Marker position={[data.lat, data.lng]} icon={L.icon.wave({style: '02'})}>
                <Popup position={[data.lat, data.lng]} ref="pop" autoPan={false} open>
                    <div className="pop-wrapper">
                        <div className="pop-title text-uppercase">{data.hoten}</div>
                        <div className="pop-body">
                            <ul className="list-data mb-10">
                                <li><b>Tuổi: </b> {data.tuoi}</li>
                                <li><b>Đia chỉ: </b> {this.getDiachi(data, 'diachi')}</li>
                                <li><b>Tổ - khu phố: </b> {data.to1} - {data.khupho1}</li>
                                <li><b>Phường - Quận: </b> {this.getDiachi(data, 'phuongquan')}</li>
                                <li><b>Ngày mắc bệnh: </b> {data.ngaymacbenh}</li>
                                <li><b>Ngày nhập viện: </b> {data.ngaynhapvien}</li>
                            </ul>
                            <ul className="list-actions">
                                <li><a href={data.ma_dt_sxh ? url_home(`dieutra/sxh/update?ma_dt_sxh=${data.ma_dt_sxh}`): ""} target="_blank">Chi tiết</a></li> |
                                <li><a onClick={() => addKvSxh(data, this.getRadius())}> Khoanh vùng</a></li> |
                                <li><a onClick={() => updateKvSxh(data, this.getRadius())}> Thêm vào ổ dịch</a></li>
                            </ul>
                        </div>
                    </div>
                </Popup>
            </Marker>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        settings: state.server.settings
    };
}

export default connect(mapStateToProps, {addKvSxh, updateKvSxh})(PopCabenh);