import React, {Component, PropTypes} from 'react';
import axios from 'axios';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {filter, pick} from 'lodash';
import { render } from 'react-dom';

import {cir2poly} from  '../../utils/geom';

import Dichte from './Dichte';
import Progress from '../../views/progress';

var initDatepicker = () => {
    $('.i-datepicker').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "vi",
        calendarWeeks: true,
        todayHighlight: true,
        autoclose: true,
    });
}

var rvCabenh = function () {
    $('.rvCabenh').click(function () {
        if ($('.rvCabenh').length < 3) {
            alert('Không được phép xóa tất cả ca bệnh. Vui lòng xóa Ổ dịch');
            return;
        }
        $(this).closest('tr').remove();
    })
}

class OdichSXH extends Dichte {
    constructor(props) {
        super(props);
    }

    componentWillReceiveProps(nextProps){
        const {htmlContainer} = nextProps;
        if(htmlContainer && nextProps.htmlContainer !== this.props.htmlContainer){
            this.showPartial(htmlContainer);
        }
    }

    showPartial(htmlContainer){
        let el = $(this.refs.odichSXH);
        el.html(htmlContainer)

        this.odichReady();
        $('#ajaxCrudModal').appendTo('body');
        $('#crud-datatable-odich-pjax').on('pjax:end', ::this.odichReady);
    }

    odichReady() {

        $('#ajaxCrudModal').on('show.bs.modal', () => setTimeout(::this.showModal));
        $('#crud-datatable-odich-pjax tbody > tr a.linkOdichSxh').click(::this.linkOdich)


        $('#delShowOdichSxh').click(e =>  {
            this.props.dispatch({type: 'ODICH_SXH_DELETE'})
        });
    }

    showModal() {
        initDatepicker();
        rvCabenh();


        $('#openOdSxh').click(() => {
            let el = $('#odichsxh-status')
            el.val() == true ? el.val(0) : el.val(1);
            $('#btnSaveOdSxh').trigger('click');
        });

        $('#btnLoadCabenh').click(::this.loadSXH);
    }

    loadSXH() {
        const {kvSXH} = this.props;

        let dataSXH = filter(kvSXH, {chosen: true})
            .map(val => { return val.model })

        let tpl = Handlebars.compile ($("#tpl-cabenh").html()  );
        $('#tbCabenh tbody').append(tpl({cabenh: dataSXH}));

        rvCabenh();
    }

    linkOdich(e) {
        const {currentTarget: self} = e;
        let model = JSON.parse($(self).attr('data-model'));

        axios.get('dichte/odich-sxh/view?onmap=true&id='+model.id).then(res => {
            const {sxhs} = res.data;

            let bounds = L.featureGroup(sxhs.map(val => cir2poly([val.lat, val.lng], 200))).getBounds();

            this.props.dispatch({type: 'ODICH_SXH_FLYTO', payload: bounds });
            this.props.dispatch({type: 'ODICH_SXH_ADD', payload: res.data });
        });
    }

    render() {

        return (
            <div id="odichSXH" ref="odichSXH">
                <Progress.L02 />
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        htmlContainer: state.sxhOdich.html,
        kvSXH: state.sxh.khoanhvung,
    };
}

const mapDispatchToProps = (dispatch) => {
    return {...bindActionCreators({ dispatch }, dispatch), dispatch};
}

export default connect(mapStateToProps, mapDispatchToProps)(OdichSXH);
