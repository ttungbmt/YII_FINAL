import React, {Component, PropTypes} from 'react';
import axios from 'axios';

export default class Dichte extends Component {
    constructor(props){
        super(props);
    }

    componentDidMount() {
        const {actionType, dispatch, url, htmlContainer} = this.props;

        if(!htmlContainer) {
            axios.get(url).then(res => dispatch({type: actionType, payload: res.data}));
        } else {
            this.showPartial(htmlContainer);
        }
    }

}