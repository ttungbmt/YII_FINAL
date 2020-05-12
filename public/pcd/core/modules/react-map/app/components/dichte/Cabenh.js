import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {pick} from 'lodash';

import {updateSxhModel} from '../../actions/sxhActions';
import Dichte from './Dichte';
import Progress from '../../views/progress';

class Cabenh extends Dichte {
    constructor(props) {
        super(props);
    }

    // componentDidMount(){
    //     if(this.props.htmlContainer){
    //         this.showPartial(this.props.htmlContainer);
    //     }
    // }

    componentWillReceiveProps(nextProps){
        const {htmlContainer} = nextProps;

        if(htmlContainer && nextProps.htmlContainer !== this.props.htmlContainer){
            this.showPartial(htmlContainer);
        }
    }

    showPartial = (htmlContainer) => {
        let el = $(this.refs.sxh);
        el.html(htmlContainer)

        this.cabenhReady();
        $('#kv-pjax-container').on('pjax:end', ::this.cabenhReady);
    }


    cabenhReady() {
        $('#kv-pjax-container tbody > tr a').click(::this.linkCabenh);
    }

    linkCabenh(e) {
        const {currentTarget: self} = e;
        let model = JSON.parse($(self).attr('data-model'));
        if($(window).width() < 768) appLayout.main.toggle('west');

        this.props.updateSxhModel({...model, from: 'sidebar'});
    }

    render() {
        return (
            <div ref="sxh">
                <Progress.L02 />
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        htmlContainer: state.sxh.html
    };
}

const mapDispatchToProps = (dispatch) => {
    return {...bindActionCreators({ updateSxhModel }, dispatch), dispatch};
}

export default connect(mapStateToProps, mapDispatchToProps)(Cabenh);