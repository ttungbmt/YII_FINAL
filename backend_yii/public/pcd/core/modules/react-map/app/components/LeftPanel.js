import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';
import axios from 'axios';




class LeftPanel extends Component {
    static defaultProps = {id: 'leftPanel'}

    render() {
        const {children, id} = this.props;

        return (
            <div id={id}>
                {children}
            </div>
        );
    }
}

const mapStateToProps = (state) => {
    return {

    };
}

export default connect(mapStateToProps)(LeftPanel);

// class LeftPanel extends Component {
//     constructor(){
//         super();
//         this.state = {
//             tksxh: null
//         };
//     }
//
//     componentDidMount() {
//         $('.i-datepicker').datepicker({
//             format: "dd/mm/yyyy",
//             todayBtn: "linked",
//             language: "vi",
//             calendarWeeks: true,
//             todayHighlight: true,
//             autoclose: true,
//         });
//     }
//
//     onFilterCabenh(e){
//         e.preventDefault();
//
//         let datafrm = $(this.refs.frmFilterCabenh).serializeObject();
//         this.props.dispatch({type: 'FILTER', payload: datafrm});
//
//         $.post(url_home('maps/filter-sxh'), datafrm).then(res => {
//             this.setState({tksxh: (
//                 <tr>
//                     <td>{res.sxh}</td>
//                     <td>{res.sxv}</td>
//                 </tr>
//             )})
//         })
//     }
//
//     componentDidUpdate(prevProps, prevState){
//         // console.log(this.props);
//         // if(this.props.filterCQL != prevProps.filterCQL){
//         //
//         // }
//     }
//
//     render(){
//         return (
//             <div id="leftPanel">
//                 <div className="tabbable" id="tb-dichte">
//                     <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
//                         <li className="active"><a href="#tb-cabenh" data-toggle="tab">Ca bệnh</a></li>
//                         <li><a href="#tb-khoanhvung" data-toggle="tab">Khoanh vùng</a></li>
//                         <li><a href="#tb-odich" data-toggle="tab">Ổ dịch</a></li>
//                         <li><a href="#tb-tksxh" data-toggle="tab">Thống kê</a></li>
//                     </ul>
//                     <div className="tab-content">
//                         <div className="tab-pane active" id="tb-cabenh">
//                             <Cabenh html="CABENH_HTML" url="/dichte/cabenh/index?partial=true"></Cabenh>
//                         </div>
//                         <div className="tab-pane" id="tb-khoanhvung">
//                             <form ref="frmFilterCabenh" id="loccabenh" action="#">
//                                 <div className="panel-group">
//                                     <div className="panel panel-white">
//                                         <div className="panel-heading">
//                                             <h6 className="panel-title">
//                                                 <a data-toggle="collapse" href="#collapse-group1" aria-expanded="true"><i className="icon-filter4"></i> <span>Lọc ca bệnh</span></a>
//                                             </h6>
//                                         </div>
//                                         <div id="collapse-group1" className="panel-collapse collapse in">
//                                             <div className="panel-body">
//                                                 <label className="col-lg-12 control-label">Thời gian:</label>
//                                                 <div className="col-lg-6">
//                                                     <div className="form-group">
//                                                         <input type="text" name="datefrom" className="form-control i-datepicker" placeholder="Từ ngày" />
//                                                     </div>
//                                                 </div>
//                                                 <div className="col-lg-6">
//                                                     <div className="form-group">
//                                                         <input type="text" name="dateto"className="form-control i-datepicker" placeholder="Đến ngày" />
//                                                     </div>
//                                                 </div>
//                                                 <div className="col-lg-6">
//                                                     <div className="form-group">
//                                                         <label className="display-block">Loại bệnh:</label>
//                                                         <label className="checkbox-inline">
//                                                             <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sxh'}/> SXH
//                                                         </label>
//                                                         <label className="checkbox-inline">
//                                                             <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sxv'}/> SXV
//                                                         </label>
//                                                         <label className="checkbox-inline">
//                                                             <input type="checkbox" name="loaibenh[]" value={'khac'}/> Khác
//                                                         </label>
//                                                     </div>
//                                                 </div>
//                                                 <div className="col-lg-6">
//                                                     <div className="form-group">
//                                                         <label className="display-block">Bệnh nhân:</label>
//                                                         <label className="checkbox-inline">
//                                                             <input type="checkbox" name="benhnhan[]" defaultChecked="checked" value={'on'}/> Có
//                                                         </label>
//                                                         <label className="checkbox-inline">
//                                                             <input type="checkbox" name="benhnhan[]" value={'off'}/> Không
//                                                         </label>
//                                                     </div>
//                                                 </div>
//                                                 <div style={{margin: 15, float: 'right'}}>
//                                                     <button type="submit" onClick={::this.onFilterCabenh} className="btn border-primary text-primary-800 btn-flat">Lọc ca</button>
//                                                 </div>
//                                                 <div className="clearfix"></div>
//
//                                                 <table className="table table-bordered table-hover">
//                                                     <tbody>
//                                                     <tr>
//                                                         <td><b>SXH</b></td>
//                                                         <td><b>SXV</b></td>
//                                                     </tr>
//                                                     {this.state.tksxh}
//                                                     </tbody>
//                                                 </table>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div className="panel panel-white">
//                                         <div className="panel-heading">
//                                             <h6 className="panel-title">
//                                                 <a className="collapsed" data-toggle="collapse" href="#collapse-settings"><i className="icon-gear"></i> <span>Thiết lập</span></a>
//                                             </h6>
//                                         </div>
//                                         <div id="collapse-settings" className="panel-collapse collapse">
//                                             <div className="panel-body">
//                                                 <div className="col-lg-6">
//                                                     <div className="form-group">
//                                                         <label>Bán kính:</label>
//                                                         <input id="radiusKV" type="text" className="form-control" defaultValue={200} placeholder="Nhập bán kính" />
//                                                     </div>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//
//                                     <OdichInfo />
//                                 </div>
//                             </form>
//                         </div>
//                         <div className="tab-pane" id="tb-odich">
//                             <Odich html="ODICH_HTML" url="/dichte/odich-sxh/index?partial=true"/>
//                         </div>
//                         <div className="tab-pane" id="tb-tksxh">
//                             <ThongkeSXH />
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         )
//     }
// }
//
// const mapState = (state) => {
//     return {
//         // filterCQL: state.dichte
//     };
// }
//
// export default connect(mapState)(LeftPanel);