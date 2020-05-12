import React, { Component, PropTypes } from 'react';
import {connect} from 'react-redux';

import {OdichInfo} from '../../components';
import {filterSxh} from '../../actions/sxhActions';

class SxhFilterForm extends Component {
    state = {
        tkSXH: null
    }

    constructor(){
        super();
        this.today = moment().format('DD/MM/YYYY');
        this.last3Month = moment().add(-1 * 3, 'months').format('DD/MM/YYYY');

    }

    componentDidMount() {
        $('.i-datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            language: "vi",
            calendarWeeks: true,
            todayHighlight: true,
            autoclose: true,
        });
    }

    handleSubmit(e){
        const {filterSxh} = this.props;
        e.preventDefault();
        let dataFrm = $(this.refs.frmFilterCabenh).serializeObject();

        filterSxh(dataFrm);

        dataFrm = Object.assign({
            'datefrom': dataFrm.datefrom ? dataFrm.datefrom : this.last3Month,
            'dateto': dataFrm.dateto ? dataFrm.dateto : this.today,
            'loaibenh': dataFrm.loaibenh,
        }, dataFrm);

        $.post(url_home('maps/filter-sxh'), dataFrm).then(res => {
            console.log(res);
            this.setState({
                tkSXH: (
                    <tr>
                        <td>{res.sxh}</td>
                        <td>{res.sot}</td>
                        <td>{res.khac}</td>
                    </tr>
                )
            })
        })
    }

    render(){


        return (
            <form ref="frmFilterCabenh" id="loccabenh" action="#">
                <div className="panel-group">
                    <div className="panel panel-white">
                        <div className="panel-heading">
                            <h6 className="panel-title">
                                <a data-toggle="collapse" href="#collapse-group1" aria-expanded="true"><i className="icon-filter4"></i> <span>Lọc ca bệnh</span></a>
                            </h6>
                        </div>
                        <div id="collapse-group1" className="panel-collapse collapse in">
                            <div className="panel-body">
                                <label className="col-lg-12 control-label">Thời gian:</label>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <input type="text" name="datefrom" className="form-control i-datepicker" placeholder="Từ ngày" defaultValue={this.last3Month}/>
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <input type="text" name="dateto"className="form-control i-datepicker" placeholder="Đến ngày" defaultValue={this.today}/>
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <label className="display-block">Loại bệnh:</label>
                                        <label className="checkbox-inline">
                                            <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sxh'}/> SXH
                                        </label>
                                        <label className="checkbox-inline">
                                            <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sot'}/> Sốt
                                        </label>
                                        <label className="checkbox-inline">
                                            <input type="checkbox" name="loaibenh[]" value={'khac'}/> Khác
                                        </label>
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <label className="display-block">Bệnh nhân:</label>
                                        <label className="checkbox-inline">
                                            <input type="checkbox" name="benhnhan[]" defaultChecked="checked" value={'on'}/> Có
                                        </label>
                                        <label className="checkbox-inline">
                                            <input type="checkbox" name="benhnhan[]" value={'off'}/> Không
                                        </label>
                                    </div>
                                </div>
                                <div style={{margin: 15, float: 'right'}}>
                                    <button type="button" onClick={::this.handleSubmit} className="btn border-primary text-primary-800 btn-flat">Lọc ca</button>
                                </div>
                                <div className="clearfix"></div>

                                <table className="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>SXH</b></td>
                                        <td><b>Sốt</b></td>
                                        <td><b>Khác</b></td>
                                    </tr>
                                    {this.state.tkSXH}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div className="panel panel-white">
                        <div className="panel-heading">
                            <h6 className="panel-title">
                                <a className="collapsed" data-toggle="collapse" href="#collapse-settings"><i className="icon-gear"></i> <span>Thiết lập</span></a>
                            </h6>
                        </div>
                        <div id="collapse-settings" className="panel-collapse collapse">
                            <div className="panel-body">
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <label>Bán kính:</label>
                                        <input id="radiusKV" type="text" className="form-control" defaultValue={200} placeholder="Nhập bán kính" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <OdichInfo />
                </div>
            </form>
        );
    }
}

const mapStateToProps = (state) => {
    return {
    };
}

export default connect(mapStateToProps, {filterSxh})(SxhFilterForm);




















// import { reduxForm, Field } from 'redux-form';
// export const fields = [ 'dateto' ];
//
// class SxhFilterForm extends Component {
//     static propTypes = {
//         handleSubmit: PropTypes.func.isRequired,
//     };
//
//     componentDidMount(){
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
//
//     render() {
//         const { handleSubmit, fields: {dateto} } = this.props;
//
//         return (
//             <form onSubmit={handleSubmit}>
//                 <div className="panel-group">
//                     <div className="panel panel-white">
//                         <div className="panel-heading">
//                             <h6 className="panel-title">
//                                 <a data-toggle="collapse" href="#collapse-group1" aria-expanded="true"><i className="icon-filter4"></i> <span>Lọc ca bệnh</span></a>
//                             </h6>
//                         </div>
//                         <div id="collapse-group1" className="panel-collapse collapse in">
//                             <div className="panel-body">
//                                 <label className="col-lg-12 control-label">Thời gian:</label>
//                                 <div className="col-lg-6">
//                                     <div className="form-group">
//                                         <Field name="datefrom" component="input" type="text" className="form-control i-datepicker" placeholder="Từ ngày"/>
//                                     </div>
//                                 </div>
//                                 <div className="col-lg-6">
//                                     <div className="form-group">
//                                         <input type="text" {...dateto} className="form-control i-datepicker" placeholder="Đến ngày" />
//                                     </div>
//                                 </div>
//                                 <div className="col-lg-6">
//                                     <div className="form-group">
//                                         <label className="display-block">Loại bệnh:</label>
//                                         <label className="checkbox-inline">
//                                             <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sxh'}/> SXH
//                                         </label>
//                                         <label className="checkbox-inline">
//                                             <input type="checkbox" name="loaibenh[]" defaultChecked="checked" value={'sxv'}/> SXV
//                                         </label>
//                                         <label className="checkbox-inline">
//                                             <input type="checkbox" name="loaibenh[]" value={'khac'}/> Khác
//                                         </label>
//                                     </div>
//                                 </div>
//                                 <div className="col-lg-6">
//                                     <div className="form-group">
//                                         <label className="display-block">Bệnh nhân:</label>
//                                         <label className="checkbox-inline">
//                                             <input type="checkbox" name="benhnhan[]" defaultChecked="checked" value={'on'}/> Có
//                                         </label>
//                                         <label className="checkbox-inline">
//                                             <input type="checkbox" name="benhnhan[]" value={'off'}/> Không
//                                         </label>
//                                     </div>
//                                 </div>
//                                 <div style={{margin: 15, float: 'right'}}>
//                                     <button type="submit" className="btn border-primary text-primary-800 btn-flat">Lọc ca</button>
//                                 </div>
//                                 <div className="clearfix"></div>
//                             </div>
//                         </div>
//                     </div>
//                     <div className="panel panel-white">
//                         <div className="panel-heading">
//                             <h6 className="panel-title">
//                                 <a className="collapsed" data-toggle="collapse" href="#collapse-settings"><i className="icon-gear"></i> <span>Thiết lập</span></a>
//                             </h6>
//                         </div>
//                         <div id="collapse-settings" className="panel-collapse collapse">
//                             <div className="panel-body">
//                                 <div className="col-lg-6">
//                                     <div className="form-group">
//                                         <label>Bán kính:</label>
//                                         <input id="radiusKV" type="text" className="form-control" defaultValue={200} placeholder="Nhập bán kính" />
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </form>
//         )
//     }
// }
//
// export default reduxForm({
//     form: 'SxhFilterForm',
//     fields
// })(SxhFilterForm)