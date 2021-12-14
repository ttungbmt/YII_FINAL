import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';

class Home extends Component {
    componentDidMount(){

    }

    render(){
        const {chuadt, dadt, chuaxv, dangdt} = this.props.thongke;

        return (
            <div id="dashboard-wrapper">
                <div className="panel panel-flat">
                    <div className="panel-body">
                        <div className="row" id="counter-sxh">
                            <div className="col-sm-4">
                                <div className="media-left media-middle">
                                    <a href={url_home('dichte/cabenh/index?Cabenh1Search[xmcabenh]=0')} target="_blank" className="btn border-primary-400 text-primary-400 btn-flat btn-rounded btn-xs btn-icon"><i className="icon-alarm-add" /></a>
                                </div>
                                <div className="media-left">
                                    <h5 className="text-semibold no-margin">
                                        {chuadt} <small className="display-block no-margin">Chưa điều tra</small>
                                    </h5>
                                </div>
                            </div>
                            <div className="col-sm-4">
                                <div className="media-left media-middle">
                                    <a href={url_home('dichte/cabenh/index?Cabenh1Search[xmcabenh]=1')} target="_blank" className="btn border-success-400 text-success-400 btn-flat btn-rounded btn-xs btn-icon"><i className="icon-spinner11" /></a>
                                </div>
                                <div className="media-left">
                                    <h5 className="text-semibold no-margin">
                                        {dangdt}<small className="display-block no-margin">Đang điều tra</small>
                                    </h5>
                                </div>
                            </div>

                            <div className="col-sm-4">
                                <div className="media-left media-middle">
                                    <a href={url_home('dichte/cabenh/index?Cabenh1Search[xmcabenh]=3')} target="_blank" className="btn border-pink-400 text-pink-400 btn-flat btn-rounded btn-xs btn-icon"><i className="icon-statistics" /></a>
                                </div>
                                <div className="media-left">
                                    <h5 className="text-semibold no-margin">
                                        {dadt} <small className="display-block no-margin">Đã điều tra</small>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div className="tabbable">
                            <ul className="nav nav-tabs nav-tabs-top nav-justified">
                                <li><a href="#top-justified-tab1" data-toggle="tab">Tuần</a></li>
                                <li><a href="#top-justified-tab2" data-toggle="tab">3 Tháng</a></li>
                                <li className="active"><a href="#top-justified-tab3" data-toggle="tab">Tháng</a></li>
                            </ul>
                            <div className="tab-content">
                                <div className="tab-pane" id="top-justified-tab1">
                                </div>
                                <div className="tab-pane" id="top-justified-tab2">
                                </div>
                                <div className="tab-pane active" id="top-justified-tab3">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        thongke: state.server.thongke
    };
}

export default connect(mapStateToProps)(Home);
