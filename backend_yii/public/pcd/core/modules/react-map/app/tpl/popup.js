import React from 'react';
import renderJSX from 'react-element-to-jsx-string';

var convGeoDate = (dateInp) =>{
    if(!dateInp) return;

    let dateStr = dateInp.match(/[0-9]*-[0-9]*-[0-9]*/).shift().toString();
    return moment(dateStr, 'YYYY-MM-DD').format('DD/MM/YYYY');
}

export const popCabenh = (props) => {


    return renderJSX(
        <div class="pop-wrapper">
            <div class="pop-title text-uppercase">{props.hoten}</div>
            <div class="pop-body">
                <ul class="list-props mb-10">
                    <li><b>Phái: </b> {props.phai}</li>
                    <li><b>Ngày mắc bệnh: </b> {convGeoDate(props.ngaymacbenh)}</li>
                    <li><b>Ngày nhập viện: </b> {convGeoDate(props.ngaynhapvien)}</li>
                </ul>

                <ul class="list-actions">
                    <li><a href={props.ma_dt_sxh?"/dieutra/sxh/update?ma_dt_sxh=" + props.ma_dt_sxh: ""} target="_blank">Chi tiết</a></li> |
                    <li><a class="btn-kvCabenh"> Khoanh vùng</a></li> |
                    <li><a> Thêm vào ổ dịch</a></li>
                </ul>
            </div>
        </div>
    )
}