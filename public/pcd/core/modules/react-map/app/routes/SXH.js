import React, {Component, PropTypes} from 'react';
import {Cabenh, OdichSXH, SxhFilterForm, OdichInfo} from '../components';

export default class SXH extends Component {

    render(){
        return (
            <div id="sxh-wrapper">
                <div className="tabbable" id="tb-dichte">
                    <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li className="active"><a href="#tb-cabenh" data-toggle="tab">Ca bệnh</a></li>
                        <li><a href="#tb-khoanhvung" data-toggle="tab">Khoanh vùng</a></li>
                        <li><a href="#tb-odich" data-toggle="tab">Ổ dịch</a></li>
                    </ul>
                    <div className="tab-content">
                        <div className="tab-pane active" id="tb-cabenh">
                            <Cabenh actionType="SXH_HTML" url="/dichte/cabenh/index?partial=true"></Cabenh>
                        </div>
                        <div className="tab-pane" id="tb-khoanhvung">
                            <SxhFilterForm />
                        </div>
                        <div className="tab-pane" id="tb-odich">
                            <OdichSXH actionType="ODICH_SXH_HTML" url="/dichte/odich-sxh/index?partial=true"/>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}